<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 10),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'city' => fake()->city(),
            'address' => fake()->address(),
            'zip_code' => fake()->postcode(),
            'location' => fake()->numberBetween(1, 10),
            'sname' => fake()->name(),
            'semail' => fake()->unique()->safeEmail(),
            'scity' => fake()->city(),
            'saddress' => fake()->address(),
            'szip_code' => fake()->postcode(),
            'slocation' => fake()->numberBetween(1, 10),
        ];
    }
}
