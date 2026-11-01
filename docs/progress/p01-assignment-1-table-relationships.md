# Progress Report: Assignment 1 - Table Relationships: Kost Area

| | |
|---|---|
| **Student** | Luchyana Desi Safitri |
| **NPM** | 2410010230 |
| **Class** | TI 5D REG BJB |
| **Phase** | P01: Database Design |
| **Branch** | `feature/p01-database-design` |
| **Date** | 1 November 2026 |
| **Status** | Done |

## 1. Tujuan

Merancang struktur database untuk sistem **Kost Area** beserta relasi antar tabelnya (one-to-many dan many-to-many), lalu mengimplementasikannya dalam migration dan model Eloquent Laravel.

## 2. Analisis Kebutuhan

Sistem Kost Area perlu mencatat:

- siapa pemilik dan kost apa saja yang dikelola,
- kamar di setiap kost beserta harga dan statusnya,
- fasilitas yang dimiliki tiap kamar (satu fasilitas bisa dipakai banyak kamar),
- data penyewa,
- pemesanan/sewa kamar oleh penyewa,
- pembayaran sewa bulanan.

Dari kebutuhan tersebut ditentukan 6 entitas baru di luar tabel `users` bawaan Laravel: `kosts`, `rooms`, `facilities`, `tenants`, `bookings`, dan `payments`, ditambah 1 tabel pivot `facility_room`.

## 3. Desain Tabel dan Relasi

ERD lengkap ada di [docs/erd.md](../erd.md).

| Relasi | Jenis | Implementasi |
|---|---|---|
| User -> Kost | one-to-many | `kosts.user_id` |
| Kost -> Room | one-to-many | `rooms.kost_id` |
| Room <-> Facility | many-to-many | pivot `facility_room` |
| Room -> Booking | one-to-many | `bookings.room_id` |
| Tenant -> Booking | one-to-many | `bookings.tenant_id` |
| Booking -> Payment | one-to-many | `payments.booking_id` |

Keputusan desain:

- `bookings` dipisah dari `rooms` dan `tenants` agar riwayat sewa tersimpan dan satu kamar bisa disewa oleh penyewa berbeda di periode berbeda.
- `payments` dipisah dari `bookings` karena pembayaran terjadi tiap bulan (satu booking banyak pembayaran).
- Fasilitas dibuat tabel sendiri dengan pivot supaya tidak ada data fasilitas yang berulang di tiap kamar.
- Unique constraint dipakai untuk mencegah data ganda (nomor kamar per kost, pasangan kamar-fasilitas, NIK penyewa).

## 4. Pekerjaan yang Dilakukan

| Job | Deskripsi | Status |
|---|---|---|
| J1 | Analisis kebutuhan data dan penentuan entitas | Done |
| J2 | Perancangan relasi, PK, dan FK, dibuat dalam ERD | Done |
| J3 | Migration 7 tabel (kosts, rooms, facilities, facility_room, tenants, bookings, payments) | Done |
| J4 | Model Eloquent beserta relasi (`hasMany`, `belongsTo`, `belongsToMany`) | Done |
| J5 | Dokumentasi ERD (`docs/erd.md`) | Done |
| J6 | Progress report ini | Done |

## 5. File yang Dibuat / Diubah

```
app/Models/Kost.php
app/Models/Room.php
app/Models/Facility.php
app/Models/Tenant.php
app/Models/Booking.php
app/Models/Payment.php
app/Models/User.php                  (ditambah relasi kosts())
database/migrations/2026_11_01_100001_create_kosts_table.php
database/migrations/2026_11_01_100002_create_rooms_table.php
database/migrations/2026_11_01_100003_create_facilities_table.php
database/migrations/2026_11_01_100004_create_facility_room_table.php
database/migrations/2026_11_01_100005_create_tenants_table.php
database/migrations/2026_11_01_100006_create_bookings_table.php
database/migrations/2026_11_01_100007_create_payments_table.php
docs/erd.md
docs/progress/p01-assignment-1-table-relationships.md
```

## 6. Cara Verifikasi

```bash
php artisan migrate:fresh
php artisan tinker
```

Di dalam tinker:

```php
$user = App\Models\User::factory()->create();
$kost = $user->kosts()->create(['name' => 'Kost Area A', 'address' => 'Jl. Contoh 1', 'city' => 'Banjarmasin']);
$room = $kost->rooms()->create(['room_number' => 'A1', 'type' => 'putri', 'price_per_month' => 800000]);
$wifi = App\Models\Facility::create(['name' => 'WiFi']);
$room->facilities()->attach($wifi->id);
$tenant = App\Models\Tenant::create(['name' => 'Budi', 'phone' => '08123456789', 'id_number' => '6371000000000001']);
$booking = $room->bookings()->create(['tenant_id' => $tenant->id, 'start_date' => '2026-11-01', 'status' => 'active']);
$booking->payments()->create(['amount' => 800000, 'period_month' => '2026-11', 'status' => 'unpaid']);

$kost->load('rooms.facilities', 'rooms.bookings.payments');
```

Hasil yang diharapkan: semua query berjalan tanpa error dan relasi terbaca (`$kost->rooms`, `$room->facilities`, `$booking->payments`).

## 7. Kendala dan Solusi

| Kendala | Solusi |
|---|---|
| Urutan migration harus mengikuti ketergantungan FK | Timestamp migration diurutkan: kosts, rooms, facilities, facility_room, tenants, bookings, payments |
| Nama pivot harus sesuai konvensi Laravel | Memakai `facility_room` (urut alfabet, singular) agar `belongsToMany` jalan tanpa konfigurasi tambahan |

## 8. Belum Dikerjakan

- Seeder dan factory data dummy
- Controller, route, dan tampilan (fase berikutnya)
- Validasi input dan autentikasi/otorisasi per peran
