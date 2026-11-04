<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class KostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => 'Kost ' . fake()->lastName(),
            'address' => fake()->streetAddress(),
            'city' => fake()->randomElement(['Banjarmasin', 'Banjarbaru', 'Martapura']),
            'description' => fake()->sentence(12),
        ];
    }
}