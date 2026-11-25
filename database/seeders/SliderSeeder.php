<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create(['image' => '2.jpg','image_background' => 'background.jpg',
            'ar' => [
            'subhead' => 'الصدقة الجارية',
            'name' => 'الصدقة الجارية',
            'image_alt' => 'الصدقة الجارية',
            'button_name' => 'اتصل بنا',
            'button_url' => '#',
            'description' => 'لمصارف الزكاة الشرعية'],
            'en' => [
                'subhead' => 'الصدقة الجارية',
                'name' => 'الصدقة الجارية',
                'image_alt' => 'الصدقة الجارية',
                'button_name' => 'اتصل بنا',
                'button_url' => '#',
                'description' => 'لمصارف الزكاة الشرعية'],
            'tr' => [
                'subhead' => 'Sürekli Sadaka',
                'name' => 'Sürekli Sadaka',
                'image_alt' => 'Sürekli Sadaka',
                'button_name' => 'Bizimle İletişime Geçin',
                'button_url' => '#',
                'description' => 'Şer‘i zekât harcama alanları için'
            ],

        ]);

        Slider::create(['image' => '3.jpg','image_background' => 'background.jpg',
            'ar' => [
                'subhead' => 'وقفية الأيتام',
                'name' => 'وقفية الأيتام',
                'image_alt' => 'وقفية الأيتام',
                'button_name' => 'اتصل بنا',
                'button_url' => '#',
                'description' => 'ساهم معنا'],
            'en' => [
                'subhead' => 'وقفية الأيتام',
                'name' => 'وقفية الأيتام',
                'image_alt' => 'وقفية الأيتام',
                'button_name' => 'اتصل بنا',
                'button_url' => '#',
                'description' => 'ساهم معنا'],
            'tr' => [
                'subhead' => 'Yetimler Vakfı',
                'name' => 'Yetimler Vakfı',
                'image_alt' => 'Yetimler Vakfı',
                'button_name' => 'Bizimle İletişime Geçin',
                'button_url' => '#',
                'description' => 'Bizimle katkıda bulunun'
            ],

        ]);

        Slider::create(['image' => '4.jpg','image_background' => 'background.jpg',
            'ar' => [
                'subhead' => 'وقفية التعليم والدعوة',
                'name' => 'وقفية التعليم والدعوة',
                'image_alt' => 'وقفية التعليم والدعوة',
                'button_name' => 'اتصل بنا',
                'button_url' => '#',
                'description' => 'ساهم معنا'],
            'en' => [
                'subhead' => 'وقفية التعليم والدعوة',
                'name' => 'وقفية التعليم والدعوة',
                'image_alt' => 'وقفية التعليم والدعوة',
                'button_name' => 'اتصل بنا',
                'button_url' => '#',
                'description' => 'ساهم معنا'],
            'tr' => [
                'subhead' => 'Eğitim ve Davet Vakfı',
                'name' => 'Eğitim ve Davet Vakfı',
                'image_alt' => 'Eğitim ve Davet Vakfı',
                'button_name' => 'Bizimle İletişime Geçin',
                'button_url' => '#',
                'description' => 'Bizimle katkıda bulunun'
            ],

        ]);
    }
}
