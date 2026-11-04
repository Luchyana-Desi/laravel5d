<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Facility;
use App\Models\Kost;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class KostAreaSeeder extends Seeder
{
    public function run(): void
    {
        // Pemilik kost
        $owner = User::factory()->create([
            'name' => 'Pemilik Kost',
            'email' => 'pemilik@kostarea.test',
        ]);

        // Fasilitas (data tetap)
        $facilities = collect([
            'AC',
            'WiFi',
            'Kamar Mandi Dalam',
            'Kasur',
            'Lemari',
            'Parkir Motor',
        ])->map(fn ($name) => Facility::create(['name' => $name]));

        // 2 kost, masing-masing 5 kamar, tiap kamar punya 3 fasilitas
        $kosts = Kost::factory()->count(2)->create(['user_id' => $owner->id]);

        foreach ($kosts as $kost) {
            foreach (range(1, 5) as $i) {
                $room = Room::factory()->create([
                    'kost_id' => $kost->id,
                    'room_number' => (string) (100 + $i),
                ]);

                $room->facilities()->attach($facilities->random(3)->pluck('id'));
            }
        }

        // 6 penyewa, masing-masing 1 booking aktif dan 3 pembayaran
        $rooms = Room::all();

        Tenant::factory()->count(6)->create()->each(function ($tenant, $i) use ($rooms) {
            $booking = Booking::factory()->create([
                'room_id' => $rooms[$i]->id,
                'tenant_id' => $tenant->id,
                'status' => 'active',
            ]);

            Payment::factory()->count(3)->create([
                'booking_id' => $booking->id,
                'amount' => $rooms[$i]->price_per_month,
            ]);
        });
    }
}