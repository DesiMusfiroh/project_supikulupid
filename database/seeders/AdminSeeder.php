<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin12345'),
            'role'=> 'admin',
        ]);
        User::insert([
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user12345'),
            'role'=> 'penulis',
        ]);
    }
}
