<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Urgent campaign: surgery for a child with burns in Syria (goal 10.000 TL),
 * as reported by the association. The child's face is pixelated in the photo
 * and no name is published (health data of a minor, KVKK art. 6).
 * Idempotent; down() removes it.
 */
return new class extends Migration
{
    private const SLUG = 'yanik-tedavisi-cocuk-acil-ameliyat';

    public function up()
    {
        if (DB::table('campaign_translations')->where('name_slug', self::SLUG)->exists()) {
            return;
        }

        $id = DB::table('campaigns')->insertGetId([
            'c_category_id' => 1, // Sadakalar
            'image' => 'campaign-burn-surgery-child.jpg',
            'goal' => 10000,
            'status' => 'active',
            'complete' => 'no',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $tr = [
            'name' => 'Yanık Tedavisi Gören Çocuğumuz İçin Acil Ameliyat',
            'name_slug' => self::SLUG,
            'meta_title' => 'Yanık Tedavisi Gören Çocuğumuz İçin Acil Ameliyat',
            'meta_description' => 'Suriye\'de ağır yanıklarla tedavi gören küçük bir kız çocuğunun acil ameliyatı için 10.000 TL destek topluyoruz.',
            'keywords' => null,
            'image_alt' => 'Yanık tedavisi gören çocuk (yüzü gizlenmiştir)',
            'country' => 'Suriye',
            'description' => <<<'HTML'
<h3>Acil Ameliyat Desteği</h3>
<p>Suriye'de küçük bir kız çocuğumuz yüzünde ve ellerinde ağır yanıklarla hastanede tedavi görüyor. Doktorların gerekli gördüğü <strong>ameliyatın bir an önce yapılabilmesi</strong> için desteğinize ihtiyacımız var.</p>
<ul>
<li><strong>Nerede:</strong> Suriye</li>
<li><strong>İhtiyaç:</strong> Ameliyat ve tedavi masrafları</li>
<li><strong>Hedef:</strong> 10.000 TL</li>
</ul>
<p><strong>Şeffaflık:</strong> Toplanan bağışlar ameliyat ve tedavi masraflarında kullanılır. Hedefin aşılması halinde fazla bağışlar, benzer tedavi ihtiyacı olan çocuklar için kullanılır. Ameliyat sonrasında bu sayfada bilgilendirme paylaşılır.</p>
<p><small>Çocuğumuzun mahremiyeti için adı paylaşılmamış ve fotoğraftaki yüzü gizlenmiştir. Yurt dışına yapılan yardımlar, Dernekler Kanunu ve ilgili mevzuat kapsamındaki bildirim yükümlülüklerine uygun olarak gerçekleştirilir.</small></p>
HTML,
        ];

        $ar = [
            'name' => 'عملية جراحية عاجلة لطفلة مصابة بحروق',
            'name_slug' => 'amaliya-ajila-li-tifla-musaba-bi-hurooq',
            'meta_title' => 'عملية جراحية عاجلة لطفلة مصابة بحروق',
            'meta_description' => 'نجمع 10.000 ليرة تركية لعملية جراحية عاجلة لطفلة صغيرة تتلقى العلاج من حروق شديدة في سوريا.',
            'keywords' => null,
            'image_alt' => 'طفلة تتلقى علاج الحروق (الوجه مخفي)',
            'country' => 'سوريا',
            'description' => <<<'HTML'
<h3>دعم عاجل لعملية جراحية</h3>
<p>طفلة صغيرة في سوريا تتلقى العلاج في المستشفى من حروق شديدة في وجهها ويديها، وتحتاج إلى <strong>عملية جراحية عاجلة</strong> قرّرها الأطباء، ونحتاج دعمكم لإجرائها في أسرع وقت.</p>
<ul>
<li><strong>المكان:</strong> سوريا</li>
<li><strong>الحاجة:</strong> تكاليف العملية الجراحية والعلاج</li>
<li><strong>المبلغ المطلوب:</strong> 10.000 ليرة تركية</li>
</ul>
<p><strong>الشفافية:</strong> تُصرف التبرعات على تكاليف العملية والعلاج، وإذا تجاوزت التبرعات المبلغ المطلوب تُصرف الزيادة لأطفال آخرين يحتاجون علاجاً مماثلاً. وسننشر في هذه الصفحة معلومات بعد إجراء العملية.</p>
<p><small>حفاظاً على خصوصية الطفلة لم يُذكر اسمها وأُخفي وجهها في الصورة. تُنفَّذ المساعدات خارج تركيا وفق التزامات الإبلاغ المنصوص عليها في قانون الجمعيات التركي.</small></p>
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
