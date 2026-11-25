<?php

namespace Database\Seeders;

use App\Models\CampaignCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LaratrustSeeder::class,
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            PageCategorySeeder::class,
            PageSeeder::class,
            BlogSeeder::class,
            SliderSeeder::class,
            VideoSeeder::class,
            PhotoSeeder::class,
            CampaignCategorySeeder::class,
            CampaignSeeder::class,
        ]);
    }
}
