<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price' => fake()->numberBetween(10000, 100000),
            'category' => fake()->randomElement(['Women', 'Men']),
            'image' => fake()->imageUrl(),
            'stock' => fake()->numberBetween(1, 100),
        ];
    }
}
