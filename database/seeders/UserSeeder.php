<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'test',
            'email' => 'test@examle.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'username' => 'suzuki',
            'email' => 'suzuki@examle.com',
            'password' => bcrypt('password'),
        ]);
    }
}