<?php

namespace Database\Seeders;

use App\Models\CampaignCategory;
use App\Models\Campaign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campaign::create(['c_category_id'=>1,
            'image'=> 'campaign1.jpg',
            'complete' => 'yes',
            'goal'=> 10000,
            'ar' => [
            'name' => 'زكاة المال',
            'country' => 'سوريا',
            'name_slug' => 'زكاة المال',
            'meta_title' => 'زكاة المال',
            'meta_description' => 'زكاة المال',
            'keywords' => 'زكاة المال',
            'image_alt' => 'زكاة المال',
            'description' => 'زكاة المال'],
            'en' => [
                'name' => 'زكاة المال',
                'country' => 'سوريا',
                'name_slug' => 'زكاة المال',
                'meta_title' => 'زكاة المال',
                'meta_description' => 'زكاة المال',
                'keywords' => 'زكاة المال',
                'image_alt' => 'زكاة المال',
                'description' => 'زكاة المال'],
            'tr' => [
                'name' => 'Mal Zekâtı',
                'country' => 'Halep Kırsalı',
                'name_slug' => 'mal-zekati',
                'meta_title' => 'Mal Zekâtı',
                'meta_description' => 'Mal Zekâtı',
                'keywords' => 'Mal Zekâtı',
                'image_alt' => 'Mal Zekâtı',
                'description' => 'Mal Zekâtı'
            ],


        ]);

        Campaign::create(['c_category_id'=>2,
            'image'=> 'campaign2.jpeg',
            'goal'=> 20000,
            'ar' => [
                'name' => 'توزيع اللحوم',
                'country' => 'لبنان',
                'name_slug' => 'توزيع اللحوم',
                'meta_title' => 'توزيع اللحوم',
                'meta_description' => 'توزيع اللحوم',
                'keywords' => 'توزيع اللحوم',
                'image_alt' => 'توزيع اللحوم',
                'description' => 'توزيع اللحوم'],
            'en' => [
                'name' => 'توزيع اللحوم',
                'country' => 'لبنان',
                'name_slug' => 'توزيع اللحوم',
                'meta_title' => 'توزيع اللحوم',
                'meta_description' => 'توزيع اللحوم',
                'keywords' => 'توزيع اللحوم',
                'image_alt' => 'توزيع اللحوم',
                'description' => 'توزيع اللحوم'],
            'tr' => [
                'name' => 'Et Dağıtımı',
                'country' => 'Halep Kırsalı',
                'name_slug' => 'et-dagitimi',
                'meta_title' => 'Et Dağıtımı',
                'meta_description' => 'Et Dağıtımı',
                'keywords' => 'Et Dağıtımı',
                'image_alt' => 'Et Dağıtımı',
                'description' => 'Et Dağıtımı'
            ],


        ]);

        Campaign::create(['c_category_id'=>3,
            'image'=> 'campaign3.jpeg',
            'goal'=> 30000,
            'ar' => [
                'name' => 'الإسناد القانوني للمعتقلين',
                'country' => 'مخيم اللاجئين في سوريا',
                'name_slug' => 'الإسناد القانوني للمعتقلين',
                'meta_title' => 'الإسناد القانوني للمعتقلين',
                'meta_description' => 'الإسناد القانوني للمعتقلين',
                'keywords' => 'الإسناد القانوني للمعتقلين',
                'image_alt' => 'الإسناد القانوني للمعتقلين',
                'description' => 'الإسناد القانوني للمعتقلين'],
            'en' => [
                'name' => 'الإسناد القانوني للمعتقلين',
                'country' => 'مخيم اللاجئين في سوريا',
                'name_slug' => 'الإسناد القانوني للمعتقلين',
                'meta_title' => 'الإسناد القانوني للمعتقلين',
                'meta_description' => 'الإسناد القانوني للمعتقلين',
                'keywords' => 'الإسناد القانوني للمعتقلين',
                'image_alt' => 'الإسناد القانوني للمعتقلين',
                'description' => 'الإسناد القانوني للمعتقلين'],
            'tr' => [
                'name' => 'Tutuklular İçin Hukuki Destek',
                'country' => 'Halep Kırsalı',
                'name_slug' => 'tutuklular-icin-hukuki-destek',
                'meta_title' => 'Tutuklular İçin Hukuki Destek',
                'meta_description' => 'Tutuklular İçin Hukuki Destek',
                'keywords' => 'Tutuklular İçin Hukuki Destek',
                'image_alt' => 'Tutuklular İçin Hukuki Destek',
                'description' => 'Tutuklular İçin Hukuki Destek'
            ],


        ]);

        Campaign::create(['c_category_id'=>1,
            'image'=> 'campaign4.jpg',
            'goal'=> 90000,
            'ar' => [
                'name' => 'مشروع افطار صائم',
                'country' => 'ريف حلب',
                'name_slug' => 'مشروع افطار صائم',
                'meta_title' => 'مشروع افطار صائم',
                'meta_description' => 'مشروع افطار صائم',
                'keywords' => 'مشروع افطار صائم',
                'image_alt' => 'مشروع افطار صائم',
                'description' => 'مشروع افطار صائم'],
            'en' => [
                'name' => 'مشروع افطار صائم',
                'country' => 'ريف حلب',
                'name_slug' => 'مشروع افطار صائم',
                'meta_title' => 'مشروع افطار صائم',
                'meta_description' => 'مشروع افطار صائم',
                'keywords' => 'مشروع افطار صائم',
                'image_alt' => 'مشروع افطار صائم',
                'description' => 'مشروع افطار صائم'],
            'tr' => [
                'name' => 'İftar Projesi',
                'country' => 'Halep Kırsalı',
                'name_slug' => 'iftar-projesi',
                'meta_title' => 'İftar Projesi',
                'meta_description' => 'İftar Projesi',
                'keywords' => 'İftar Projesi',
                'image_alt' => 'İftar Projesi',
                'description' => 'İftar Projesi'
            ],


        ]);
    }
}
