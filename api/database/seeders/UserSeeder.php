<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            "first_name"=> 'isaque',
            "last_name"=> 'menezes',
            "email"=>'isaque@admin.com',
            "password"=> bcrypt('admin')

        ]);

        // $user::create(
        //     [
        //         'name' => 'admin',
        //         'email' => 'admin@gmail.com',
        //         'email_verified_at' => now(),
        //         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //         //'remember_token' => Str::random(10),
        //     ]
        // );

        \App\Models\User::factory(11)->create();


    }
}
