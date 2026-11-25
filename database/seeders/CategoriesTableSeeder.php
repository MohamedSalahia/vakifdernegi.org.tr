<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $categories = ['التصنيف رقم 1', 'التصنيف رقم 2', 'التصنيف رقم 3','التصنيف رقم 4', 'التصنيف رقم 5', 'التصنيف رقم 6'];

        foreach ($categories as $category) {

            Category::create([
                'parent_id' => '0',
                'ar' => ['name' => $category],
                'en' => ['name' => $category],
                'tr' => ['name' => $category],
            ]);

        }//end of foreach
    }
}
