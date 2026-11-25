<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::create(['category_id'=>1, 'image'=> 'blog1.jpg',
            'ar' => [
            'name' => 'ذكرى ال53 حادثة احراق المسجد الاقصى',
            'name_slug' => 'ذكرى ال53 حادثة احراق المسجد الاقصى',
            'meta_title' => 'ذكرى ال53 حادثة احراق المسجد الاقصى',
            'meta_description' => 'ذكرى ال53 حادثة احراق المسجد الاقصى',
            'keywords' => 'ذكرى ال53 حادثة احراق المسجد الاقصى',
            'image_alt' => 'ذكرى ال53 حادثة احراق المسجد الاقصى',
            'description' => 'ذكرى ال53 حادثة احراق المسجد الاقصى'],
            'en' => [
                'name' => 'ذكرى ال53 حادثة احراق المسجد الاقصى',
                'name_slug' => 'ذكرى ال53 حادثة احراق المسجد الاقصى',
                'meta_title' => 'ذكرى ال53 حادثة احراق المسجد الاقصى',
                'meta_description' => 'ذكرى ال53 حادثة احراق المسجد الاقصى',
                'keywords' => 'ذكرى ال53 حادثة احراق المسجد الاقصى',
                'image_alt' => 'ذكرى ال53 حادثة احراق المسجد الاقصى',
                'description' => 'ذكرى ال53 حادثة احراق المسجد الاقصى'],
            'tr' => [
                'name' => 'Mescid-i Aksa Yangınının 53. Yıl Dönümü',
                'name_slug' => 'mescid-i-aksa-yangininin-53-yil-donumu',
                'meta_title' => 'Mescid-i Aksa Yangınının 53. Yıl Dönümü',
                'meta_description' => 'Mescid-i Aksa yangınının 53. yıl dönümü anısına',
                'keywords' => 'Mescid-i Aksa, yangın, 53. yıl dönümü',
                'image_alt' => 'Mescid-i Aksa Yangınının 53. Yıl Dönümü',
                'description' => 'Mescid-i Aksa’nın yakılmasının 53. yıl dönümü'
            ],

        ]);

        Blog::create(['category_id'=>1, 'image'=> 'blog2.jpg',
            'ar' => [
                'name' => 'مؤسسة منبر الأقصى تطلق حملة دولية "عبادا لنا"',
                'name_slug' => 'مؤسسة منبر الأقصى تطلق حملة دولية "عبادا لنا"',
                'meta_title' => 'مؤسسة منبر الأقصى تطلق حملة دولية "عبادا لنا"',
                'meta_description' => 'مؤسسة منبر الأقصى تطلق حملة دولية "عبادا لنا"',
                'keywords' => 'مؤسسة منبر الأقصى تطلق حملة دولية "عبادا لنا"',
                'image_alt' => 'مؤسسة منبر الأقصى تطلق حملة دولية "عبادا لنا"',
                'description' => 'مؤسسة منبر الأقصى تطلق حملة دولية "عبادا لنا"'],
            'en' => [
                'name' => 'مؤسسة منبر الأقصى تطلق حملة دولية "عبادا لنا"',
                'name_slug' => 'مؤسسة منبر الأقصى تطلق حملة دولية "عبادا لنا"',
                'meta_title' => 'مؤسسة منبر الأقصى تطلق حملة دولية "عبادا لنا"',
                'meta_description' => 'مؤسسة منبر الأقصى تطلق حملة دولية "عبادا لنا"',
                'keywords' => 'مؤسسة منبر الأقصى تطلق حملة دولية "عبادا لنا"',
                'image_alt' => 'مؤسسة منبر الأقصى تطلق حملة دولية "عبادا لنا"',
                'description' => 'مؤسسة منبر الأقصى تطلق حملة دولية "عبادا لنا"'],
            'tr' => [
                'name' => 'Mescid-i Aksa Minberi Vakfı “İbadâ Lenâ” Uluslararası Kampanyasını Başlattı',
                'name_slug' => 'mescid-i-aksa-minberi-vakfi-ibada-lena-uluslararasi-kampanya',
                'meta_title' => 'Mescid-i Aksa Minberi Vakfı “İbadâ Lenâ” Uluslararası Kampanyasını Başlattı',
                'meta_description' => 'Mescid-i Aksa Minberi Vakfı tarafından başlatılan “İbadâ Lenâ” uluslararası kampanyası',
                'keywords' => 'Mescid-i Aksa Minberi Vakfı, İbadâ Lenâ, uluslararası kampanya',
                'image_alt' => 'Mescid-i Aksa Minberi Vakfı “İbadâ Lenâ” Uluslararası Kampanyasını Başlattı',
                'description' => 'Mescid-i Aksa Minberi Vakfı “İbadâ Lenâ” adlı uluslararası kampanyayı başlattı'
            ],

        ]);

        Blog::create(['category_id'=>1, 'image'=> 'blog3.jpg',
            'ar' => [
                'name' => 'مؤسسة منبر الأقصى تطلق مشروعا استراتيجيا "عبادا لنا"',
                'name_slug' => 'مؤسسة منبر الأقصى تطلق مشروعا استراتيجيا "عبادا لنا"',
                'meta_title' => 'مؤسسة منبر الأقصى تطلق مشروعا استراتيجيا "عبادا لنا"',
                'meta_description' => 'مؤسسة منبر الأقصى تطلق مشروعا استراتيجيا "عبادا لنا"',
                'keywords' => 'مؤسسة منبر الأقصى تطلق مشروعا استراتيجيا "عبادا لنا"',
                'image_alt' => 'مؤسسة منبر الأقصى تطلق مشروعا استراتيجيا "عبادا لنا"',
                'description' => 'مؤسسة منبر الأقصى تطلق مشروعا استراتيجيا "عبادا لنا"'],
            'en' => [
                'name' => 'مؤسسة منبر الأقصى تطلق مشروعا استراتيجيا "عبادا لنا"',
                'name_slug' => 'مؤسسة منبر الأقصى تطلق مشروعا استراتيجيا "عبادا لنا"',
                'meta_title' => 'مؤسسة منبر الأقصى تطلق مشروعا استراتيجيا "عبادا لنا"',
                'meta_description' => 'مؤسسة منبر الأقصى تطلق مشروعا استراتيجيا "عبادا لنا"',
                'keywords' => 'مؤسسة منبر الأقصى تطلق مشروعا استراتيجيا "عبادا لنا"',
                'image_alt' => 'مؤسسة منبر الأقصى تطلق مشروعا استراتيجيا "عبادا لنا"',
                'description' => 'مؤسسة منبر الأقصى تطلق مشروعا استراتيجيا "عبادا لنا"'],
            'tr' => [
                'name' => 'Mescid-i Aksa Minberi Vakfı “İbadâ Lenâ” Stratejik Projesini Başlattı',
                'name_slug' => 'mescid-i-aksa-minberi-vakfi-ibada-lena-stratejik-proje',
                'meta_title' => 'Mescid-i Aksa Minberi Vakfı “İbadâ Lenâ” Stratejik Projesini Başlattı',
                'meta_description' => 'Mescid-i Aksa Minberi Vakfı tarafından başlatılan “İbadâ Lenâ” stratejik projesi',
                'keywords' => 'Mescid-i Aksa Minberi Vakfı, İbadâ Lenâ, stratejik proje',
                'image_alt' => 'Mescid-i Aksa Minberi Vakfı “İbadâ Lenâ” Stratejik Projesini Başlattı',
                'description' => 'Mescid-i Aksa Minberi Vakfı “İbadâ Lenâ” adlı stratejik projeyi başlattı'
            ],

        ]);
    }
}
