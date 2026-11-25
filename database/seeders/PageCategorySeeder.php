<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PageCategory;

class PageCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PageCategory::create(['ar' => ['name' => 'من نحن'], 'en' => ['name' => 'about us']]);
        PageCategory::create(['ar' => ['name' => 'محاورنا'], 'en' => ['name' => 'our interlocutor']]);
        PageCategory::create(['ar' => ['name' => 'دوراتنا'], 'en' => ['name' => 'our services']]);
        PageCategory::create(['ar' => ['name' => 'آليات التقييم والجودة'], 'en' => ['name' => 'evaluation and quality mechanisms']]);
        PageCategory::create(['ar' => ['name' => 'كيف أنضم'], 'en' => ['name' => 'how join']]);
    }
}
