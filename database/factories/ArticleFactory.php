<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->realText(64);
        return [
            'slug' => implode('-', explode(' ', $title)),
            'title' => $title,
            'description' => fake()->realText(64),
            'body' => fake()->realText(1024),
            'user_id' => random_int(1, 2),
        ];
    }
}