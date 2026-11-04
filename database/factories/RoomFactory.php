<?php

namespace Database\Factories;

use App\Models\Kost;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'kost_id' => Kost::factory(),
            'room_number' => (string) fake()->unique()->numberBetween(101, 599),
            'type' => fake()->randomElement(['putra', 'putri', 'campur']),
            'price_per_month' => fake()->randomElement([500000, 650000, 800000, 1000000]),
            'status' => fake()->randomElement(['available', 'occupied', 'maintenance']),
        ];
    }
}