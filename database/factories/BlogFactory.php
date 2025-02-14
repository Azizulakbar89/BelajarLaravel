<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Blog::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->realText(50), // Gunakan $this->faker untuk konsistensi
            'description' => $this->faker->realText(100),
            'created_at' => now(), // Tambahkan timestamp
            'updated_at' => now(), // Tambahkan timestamp
        ];
    }
}
