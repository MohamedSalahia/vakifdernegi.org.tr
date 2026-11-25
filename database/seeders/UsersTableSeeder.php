<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'phone' => '1234',
            'email' => 'admin@admin.com',
            'password' => bcrypt('1234'),
        ]);

        $user->attachRole('super_admin');

        $user1 = User::create([
            'name' => 'user',
            'phone' => '12345',
            'email' => 'user@user.com',
            'password' => bcrypt('12345'),
        ]);
        $user1->attachRole('user');

    }//end of run

}//end of seeder
