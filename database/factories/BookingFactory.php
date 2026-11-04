<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-6 months', 'now');

        return [
            'room_id' => Room::factory(),
            'tenant_id' => Tenant::factory(),
            'start_date' => $start->format('Y-m-d'),
            'end_date' => (clone $start)->modify('+6 months')->format('Y-m-d'),
            'status' => fake()->randomElement(['pending', 'active', 'finished', 'cancelled']),
        ];
    }
}