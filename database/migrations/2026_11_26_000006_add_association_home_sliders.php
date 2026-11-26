<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Home page sliders for the association's work (children, food baskets, camps).
 * Images are illustrations without people (no real photos were provided yet); each
 * slide links to a real page. Idempotent; down() removes them.
 * Real photos can replace the images from the admin panel (Sliders).
 */
return new class extends Migration
{
    private function slides(): array
    {
        return [
            [
                'image' => 'slider-children.jpg',
                'tr' => ['name' => 'Çocukların Yüzü Gülsün', 'subhead' => 'Yetim ve ihtiyaç sahibi çocuklar', 'description' => 'Zekât ve sadakalarınızla ihtiyaç sahibi çocuklara ve ailelerine destek oluyoruz.', 'button_name' => 'Bağış Yap', 'button_url' => '/zakat'],
                'ar' => ['name' => 'لنرسم البسمة على وجوه الأطفال', 'subhead' => 'الأيتام والأطفال المحتاجون', 'description' => 'بزكاتكم وصدقاتكم ندعم الأطفال المحتاجين وأسرهم.', 'button_name' => 'تبرع الآن', 'button_url' => '/ar/zakat'],
            ],
            [
                'image' => 'slider-food-baskets.jpg',
                'tr' => ['name' => 'Gıda Kolisi Yardımı', 'subhead' => 'Suriye', 'description' => 'Bağışçılarımızın desteğiyle ihtiyaç sahibi ailelere gıda kolisi ulaştırıyoruz.', 'button_name' => 'Çalışmalarımız', 'button_url' => '/completed-campaigns'],
                'ar' => ['name' => 'السلال الغذائية', 'subhead' => 'سوريا', 'description' => 'بدعم متبرعينا نوصل السلال الغذائية إلى الأسر المحتاجة.', 'button_name' => 'أعمالنا', 'button_url' => '/ar/completed-campaigns'],
            ],
            [
                'image' => 'slider-camps.jpg',
                'tr' => ['name' => 'Kamplardaki Ailelerin Yanındayız', 'subhead' => 'Türkiye ve Suriye', 'description' => 'Kamplarda yaşayan ailelere temel ihtiyaç yardımı ulaştırıyoruz.', 'button_name' => 'Kampanyalar', 'button_url' => '/campaigns'],
                'ar' => ['name' => 'مع الأسر في المخيمات', 'subhead' => 'تركيا وسوريا', 'description' => 'نوصل المساعدات الأساسية إلى الأسر المقيمة في المخيمات.', 'button_name' => 'الحملات', 'button_url' => '/ar/campaigns'],
            ],
        ];
    }

    public function up()
    {
        foreach ($this->slides() as $slide) {
            if (DB::table('sliders')->where('image', $slide['image'])->exists()) {
                continue;
            }
            $id = DB::table('sliders')->insertGetId([
                'image' => $slide['image'], 'image_background' => null,
                'created_at' => now(), 'updated_at' => now(),
            ]);
            foreach (['tr' => $slide['tr'], 'en' => $slide['tr'], 'ar' => $slide['ar']] as $locale => $t) {
                DB::table('slider_translations')->insert($t + ['slider_id' => $id, 'locale' => $locale, 'image_alt' => $t['name']]);
            }
        }
    }

    public function down()
    {
        $ids = DB::table('sliders')->whereIn('image', array_column($this->slides(), 'image'))->pluck('id');
        DB::table('slider_translations')->whereIn('slider_id', $ids)->delete();
        DB::table('sliders')->whereIn('id', $ids)->delete();
    }
};
