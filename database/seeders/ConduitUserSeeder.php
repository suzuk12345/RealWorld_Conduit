<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ConduitUser;

class ConduitUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConduitUser::create([
            'username' => 'test',
            'email' => 'test@examle.com',
            'password' => bcrypt('password'),
        ]);

        ConduitUser::create([
            'username' => 'suzuki',
            'email' => 'suzuki@examle.com',
            'password' => bcrypt('password'),
        ]);
    }
}