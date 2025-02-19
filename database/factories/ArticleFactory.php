<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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
        return [
            'title' => fake()->realText(50), // Gunakan $this->faker untuk konsistensi
            'description' => fake()->realText(100),
        ];
    }
}