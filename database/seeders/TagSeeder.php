<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tagEx = ['aaa', 'bbb', 'ccc', 'ddd', 'eee'];
        for ($i = 1; $i <= 50; $i++) {
            $tagNum = rand(1, 5);
            shuffle($tagEx);
            for ($j = 0; $j < $tagNum; $j++) {
                Tag::create([
                    'article_id' => $i,
                    'tag_name' => $tagEx[$j],
                ]);
            }
        }
    }
}