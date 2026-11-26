<?php

namespace Tests\Feature;

use App\Models\AnnualReport;
use App\Models\Donation;
use App\Models\Expense;
use App\Models\Faq;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/** Transparency page, annual reports, help centre and their admin screens. Rolled back after each test. */
class TransparencyTest extends TestCase
{
    use DatabaseTransactions;

    private function admin(): User
    {
        return User::whereHas('roles', fn ($q) => $q->where('name', 'super_admin'))->firstOrFail();
    }

    private function makeCampaign(): int
    {
        $id = DB::table('campaigns')->insertGetId([
            'c_category_id' => DB::table('campaign_categories')->whereNull('deleted_at')->value('id'),
            'goal' => 1000, 'status' => 'active', 'complete' => 'no', 'created_at' => now(), 'updated_at' => now(),
        ]);
        foreach (['tr', 'ar', 'en'] as $l) {
            DB::table('campaign_translations')->insert(['campaign_id' => $id, 'locale' => $l, 'name' => "Seffaf Kampanya $id",
                'name_slug' => "seffaf-$id-$l", 'description' => 'x', 'country' => 'Nizip']);
        }

        return $id;
    }

    public function test_transparency_shows_confirmed_totals_and_public_expenses_without_donor_names()
    {
        $c = $this->makeCampaign();
        $d = Donation::create(['reference' => Donation::newReference(), 'amount' => 300, 'donor_name' => 'Gizli Bagisci',
            'status' => Donation::CONFIRMED, 'confirmed_at' => now(), 'is_zakat' => true]);
        $d->items()->create(['campaign_id' => $c, 'donation_type' => 'campaign', 'label' => 'x', 'amount' => 300]);
        Donation::create(['reference' => Donation::newReference(), 'amount' => 9999, 'donor_name' => 'Bekleyen', 'status' => Donation::PENDING]);
        Expense::create(['spent_at' => now(), 'amount' => 120, 'title_tr' => 'Gida kolisi alimi', 'campaign_id' => $c, 'is_public' => true]);
        Expense::create(['spent_at' => now(), 'amount' => 50, 'title_tr' => 'Gizli ic harcama', 'is_public' => false]);

        $html = $this->get('/transparency')->assertOk()->getContent();

        $this->assertStringContainsString('Gida kolisi alimi', $html);
        $this->assertStringContainsString("Seffaf Kampanya $c", $html);
        $this->assertStringNotContainsString('Gizli ic harcama', $html);
        $this->assertStringNotContainsString('Gizli Bagisci', $html);
        $this->assertStringNotContainsString('9.999', $html);
    }

    public function test_transparency_can_be_switched_off()
    {
        setting()->set('donation', array_merge(\App\Support\DonationSettings::DEFAULTS, ['transparency_enabled' => false]));
        $this->get('/transparency')->assertNotFound();
        $this->get('/')->assertOk()->assertDontSee(route('transparency'), false);
    }

    public function test_reports_page_lists_only_published_reports()
    {
        $this->get('/reports')->assertOk();
        AnnualReport::create(['year' => 2025, 'title_tr' => 'Yayinda Rapor', 'file' => 'a.pdf', 'is_published' => true]);
        AnnualReport::create(['year' => 2024, 'title_tr' => 'Taslak Rapor', 'file' => 'b.pdf', 'is_published' => false]);

        $this->get('/reports')->assertOk()->assertSee('Yayinda Rapor')->assertDontSee('Taslak Rapor');
    }

    public function test_help_center_shows_active_questions()
    {
        Faq::create(['category' => 'general', 'question_tr' => 'Aktif test sorusu?', 'answer_tr' => 'Evet', 'is_active' => true]);
        Faq::create(['category' => 'general', 'question_tr' => 'Pasif test sorusu?', 'answer_tr' => 'Hayir', 'is_active' => false]);

        $this->get('/help')->assertOk()->assertSee('Nasıl bağış yapabilirim?')->assertSee('Aktif test sorusu?')->assertDontSee('Pasif test sorusu?');
    }

    public function test_admin_manages_expenses_reports_and_faqs()
    {
        Storage::fake('public');
        $admin = $this->admin();
        $c = $this->makeCampaign();

        foreach (['admin.expenses.index', 'admin.expenses.create', 'admin.annual_reports.index', 'admin.annual_reports.create',
                  'admin.faqs.index', 'admin.faqs.create', 'admin.settings.donations'] as $page) {
            $this->actingAs($admin)->get(route($page))->assertOk()->assertSee('form-control', false);
        }
        $this->actingAs($admin)->get(route('admin.faqs.edit', Faq::firstOrFail()))->assertOk()->assertSee('name="answer_tr"', false);
        $this->actingAs($admin)->post(route('admin.expenses.store'), [
            'spent_at' => now()->format('Y-m-d'), 'amount' => '450.50', 'campaign_id' => $c, 'title_tr' => 'Ilac alimi',
            'is_public' => '1', 'document' => UploadedFile::fake()->create('fatura.pdf', 100, 'application/pdf'),
        ])->assertRedirect(route('admin.expenses.index'));
        $e = Expense::where('title_tr', 'Ilac alimi')->firstOrFail();
        $this->assertEquals(450.50, (float) $e->amount);
        Storage::disk('public')->assertExists('expense_documents/' . $e->document);
        $this->actingAs($admin)->delete(route('admin.expenses.destroy', $e))->assertRedirect();
        $this->assertNull($e->fresh());

        $this->actingAs($admin)->post(route('admin.annual_reports.store'), [
            'year' => 2025, 'title_tr' => '2025 Faaliyet Raporu', 'is_published' => '1',
            'file' => UploadedFile::fake()->create('rapor.pdf', 200, 'application/pdf'),
        ])->assertRedirect(route('admin.annual_reports.index'));
        $this->assertSame(1, AnnualReport::where('title_tr', '2025 Faaliyet Raporu')->count());

        $this->actingAs($admin)->post(route('admin.faqs.store'), [
            'category' => 'zakat', 'question_tr' => 'Yeni soru?', 'answer_tr' => 'Yeni cevap', 'is_active' => '1',
        ])->assertRedirect(route('admin.faqs.index'));
        $faq = Faq::where('question_tr', 'Yeni soru?')->firstOrFail();
        $this->actingAs($admin)->put(route('admin.faqs.update', $faq), ['category' => 'zakat', 'question_tr' => 'Duzenlendi?', 'answer_tr' => 'x'])->assertRedirect();
        $this->assertSame('Duzenlendi?', $faq->fresh()->question_tr);
        $this->assertFalse($faq->fresh()->is_active); // unchecked -> hidden
    }

    public function test_regular_users_cannot_open_the_admin_screens()
    {
        $user = User::whereHas('roles', fn ($q) => $q->where('name', 'user'))->first();
        if (!$user) {
            $this->markTestSkipped('No regular user in this database.');
        }
        $this->actingAs($user)->get(route('admin.expenses.index'))->assertStatus(403);
    }
}
