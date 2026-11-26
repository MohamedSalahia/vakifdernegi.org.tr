<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Adds the completed campaign "Food baskets distributed in Syria" (reported by the
 * association, Nov 2026). Text is deliberately free of figures that were not provided
 * (number of baskets/families, date, total); goal = 0 hides the total on the site.
 * Details and real photos can be added from the admin panel.
 */
return new class extends Migration
{
    private const SLUG = 'suriye-gida-kolisi-dagitimi';

    public function up()
    {
        if (DB::table('campaign_translations')->where('name_slug', self::SLUG)->exists()) {
            return;
        }

        $id = DB::table('campaigns')->insertGetId([
            'c_category_id' => 1, // Sadakalar
            'image' => 'campaign-gida-kolisi-suriye.jpg',
            'goal' => 0,
            'status' => 'active',
            'complete' => 'yes',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $tr = [
            'name' => 'Suriye\'de Gıda Kolisi Dağıtımı',
            'name_slug' => self::SLUG,
            'meta_title' => 'Suriye\'de Gıda Kolisi Dağıtımı',
            'meta_description' => 'Bağışçılarımızın desteğiyle Suriye\'de ihtiyaç sahibi ailelere gıda kolisi dağıttık.',
            'keywords' => null,
            'image_alt' => 'Gıda kolisi dağıtımı - Suriye',
            'country' => 'Suriye',
            'description' => <<<'HTML'
<h3>Suriye'de Gıda Kolisi Dağıtımı</h3>
<p>Bağışçılarımızın desteğiyle Suriye'de ihtiyaç sahibi ailelere temel gıda maddelerinden oluşan gıda kolileri dağıttık.</p>
<ul>
<li><strong>Nerede:</strong> Suriye</li>
<li><strong>Kimlere:</strong> İhtiyaç durumu tespit edilen aileler</li>
<li><strong>Durum:</strong> Tamamlandı</li>
</ul>
<p>Bu çalışmaya katkıda bulunan tüm bağışçılarımıza teşekkür ederiz. Benzer çalışmalarımıza destek olmak için devam eden <a href="/campaigns">kampanyalarımıza</a> göz atabilirsiniz.</p>
<p><small>Yurt dışına yapılan yardımlar, Dernekler Kanunu ve ilgili mevzuat kapsamındaki bildirim yükümlülüklerine uygun olarak gerçekleştirilir.</small></p>
HTML,
        ];

        $ar = [
            'name' => 'توزيع السلال الغذائية في سوريا',
            'name_slug' => 'tawzi-al-salal-al-ghidhaiya-suriya',
            'meta_title' => 'توزيع السلال الغذائية في سوريا',
            'meta_description' => 'بدعم من المتبرعين وزّعنا سلالاً غذائية على الأسر المحتاجة في سوريا.',
            'keywords' => null,
            'image_alt' => 'توزيع السلال الغذائية - سوريا',
            'country' => 'سوريا',
            'description' => <<<'HTML'
<h3>توزيع السلال الغذائية في سوريا</h3>
<p>بدعم من متبرعينا وزّعنا سلالاً غذائية تحتوي على المواد الغذائية الأساسية على الأسر المحتاجة في سوريا.</p>
<ul>
<li><strong>المكان:</strong> سوريا</li>
<li><strong>المستفيدون:</strong> الأسر التي ثبت احتياجها</li>
<li><strong>الحالة:</strong> مكتملة</li>
</ul>
<p>نشكر جميع المتبرعين الذين أسهموا في هذا العمل. ولدعم أعمال مماثلة يمكنكم تصفح <a href="/ar/campaigns">حملاتنا الحالية</a>.</p>
<p><small>تُنفَّذ المساعدات خارج تركيا وفق التزامات الإبلاغ المنصوص عليها في قانون الجمعيات التركي والأنظمة ذات الصلة.</small></p>
HTML,
        ];

        foreach (['tr' => $tr, 'en' => $tr, 'ar' => $ar] as $locale => $t) {
            DB::table('campaign_translations')->insert($t + ['campaign_id' => $id, 'locale' => $locale]);
        }
    }

    public function down()
    {
        $id = DB::table('campaign_translations')->where('name_slug', self::SLUG)->value('campaign_id');
        if ($id) {
            DB::table('campaign_translations')->where('campaign_id', $id)->delete();
            DB::table('campaigns')->where('id', $id)->delete();
        }
    }
};
