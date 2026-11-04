<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TenantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => '08' . fake()->numerify('##########'),
            'id_number' => fake()->unique()->numerify('################'),
            'occupation' => fake()->randomElement(['Mahasiswa', 'Karyawan', 'Wiraswasta', 'Guru']),
        ];
    }
}