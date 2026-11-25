<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::create(['image'=> 'video1.png','url'=> 'https://www.youtube.com/embed/tlhHQtrHvE0', 'ar' => [
            'name' => 'تقويم الأسنان (التقويم الثابت والتقويم المتحرك)',
            'meta_title' => 'هذا النص هو مثال',
            'meta_description' => 'هذا النص هو مثال',
            'keywords' => 'هذا النص هو مثال',
            'image_alt' => 'هذا النص هو مثال'], 'en' => [
            'name' => 'هذا النص هو مثال',
            'meta_title' => 'هذا النص هو مثال',
            'meta_description' => 'هذا النص هو مثال',
            'keywords' => 'هذا النص هو مثال',
            'image_alt' => 'هذا النص هو مثال']]);
        Video::create(['image'=> 'video2.png','url'=> 'https://www.youtube.com/embed/L4VnV6aFUls', 'ar' => [
            'name' => 'مفهوم نقص التغذية',
            'meta_title' => 'هذا النص هو مثال',
            'meta_description' => 'هذا النص هو مثال',
            'keywords' => 'هذا النص هو مثال',
            'image_alt' => 'هذا النص هو مثال'], 'en' => [
            'name' => 'هذا النص هو مثال',
            'meta_title' => 'هذا النص هو مثال',
            'meta_description' => 'هذا النص هو مثال',
            'keywords' => 'هذا النص هو مثال',
            'image_alt' => 'هذا النص هو مثال']]);
        Video::create(['image'=> 'video3.png','url'=> 'https://www.youtube.com/embed/wRU2jCOWVXo', 'ar' => [
            'name' => 'حكاية ابتسامة',
            'meta_title' => 'هذا النص هو مثال',
            'meta_description' => 'هذا النص هو مثال',
            'keywords' => 'هذا النص هو مثال',
            'image_alt' => 'هذا النص هو مثال'], 'en' => [
            'name' => 'هذا النص هو مثال',
            'meta_title' => 'هذا النص هو مثال',
            'meta_description' => 'هذا النص هو مثال',
            'keywords' => 'هذا النص هو مثال',
            'image_alt' => 'هذا النص هو مثال']]);
        Video::create(['image'=> 'video4.png','url'=> 'https://www.youtube.com/embed/ZdakK51g6hc', 'ar' => [
            'name' => 'لأسنان صحية - نصائح وتوجيهات - ابتسامة هوليوود',
            'meta_title' => 'هذا النص هو مثال',
            'meta_description' => 'هذا النص هو مثال',
            'keywords' => 'هذا النص هو مثال',
            'image_alt' => 'هذا النص هو مثال'], 'en' => [
            'name' => 'هذا النص هو مثال',
            'meta_title' => 'هذا النص هو مثال',
            'meta_description' => 'هذا النص هو مثال',
            'keywords' => 'هذا النص هو مثال',
            'image_alt' => 'هذا النص هو مثال']]);
    }
}
