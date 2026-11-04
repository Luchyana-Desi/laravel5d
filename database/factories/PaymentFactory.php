<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        $paid = fake()->boolean(70);

        return [
            'booking_id' => Booking::factory(),
            'amount' => fake()->randomElement([500000, 650000, 800000, 1000000]),
            'period_month' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m'),
            'paid_at' => $paid ? fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d') : null,
            'method' => fake()->randomElement(['cash', 'transfer', 'ewallet']),
            'status' => $paid ? 'paid' : 'unpaid',
        ];
    }
}