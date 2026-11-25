<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Photo::create(['image'=> 'photo1.jpg']);
        Photo::create(['image'=> 'photo2.jpg']);
        Photo::create(['image'=> 'photo3.jpg']);
        Photo::create(['image'=> 'photo4.jpg']);
        Photo::create(['image'=> 'photo5.jpg']);
        Photo::create(['image'=> 'photo6.jpg']);
        Photo::create(['image'=> 'photo7.jpg']);
        Photo::create(['image'=> 'photo8.jpg']);


    }
}
