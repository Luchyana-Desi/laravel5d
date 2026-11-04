# Progress Report: P01 Database Design

| | |
|---|---|
| **Student** | Luchyana Desi Safitri |
| **NPM** | 2410010230 |
| **Class** | TI 5D REG BJB |
| **Assignment** | Assignment 1: Table Relationships: Kost Area |
| **Phase** | P01: Database Design |
| **Fork / branch** | [Luchyana-Desi/laravel5d](https://github.com/Luchyana-Desi/laravel5d) / `feature/p01-database-design` |
| **Pull request** | [#53](https://github.com/mirzayogy/laravel5d/pull/53) |
| **Started** | 1 November 2026 |
| **Completed** | 4 November 2026 |
| **Status** | Done |

## Ringkasan

Fase P01 mengerjakan desain database untuk proyek **Kost Area**, yaitu platform manajemen dan booking kos. Pekerjaan mencakup perancangan ERD, pembuatan migration, model Eloquent beserta relasinya, factory, seeder, dan dokumentasi relasi tabel.

## Status job

| Job | Description | Status | Completed | Commit |
|---|---|---|---|---|
| J1 | README project berisi desain database (ERD diagram) dan aturan bisnis Kost Area | Done | 4 Nov 2026 | [`2736dd5`](https://github.com/Luchyana-Desi/laravel5d/commit/2736dd5) |
| J2 | Migration 7 tabel (kosts, rooms, facilities, facility_room, tenants, bookings, payments) dengan foreign key dan unique constraint | Done | 1 Nov 2026 | [`5159adf`](https://github.com/Luchyana-Desi/laravel5d/commit/5159adf) |
| J3 | Model Eloquent beserta relasi (`hasMany`, `belongsTo`, `belongsToMany`) dan relasi `kosts()` di `User` | Done | 1 Nov 2026 | [`5159adf`](https://github.com/Luchyana-Desi/laravel5d/commit/5159adf) |
| J4 | Dokumentasi relasi tabel (`docs/erd.md`) dan progress report | Done | 1 Nov 2026 | [`6e6e430`](https://github.com/Luchyana-Desi/laravel5d/commit/6e6e430) |
| J5 | Factory untuk 6 model dan `KostAreaSeeder`, didaftarkan di `DatabaseSeeder` | Done | 4 Nov 2026 | [`95ba176`](https://github.com/Luchyana-Desi/laravel5d/commit/95ba176) |

## Detail J1

- `README.md` di root project berisi bagian **Desain Database** dengan ERD diagram, tabel jenis relasi, dan **Aturan Bisnis**.
- Pada 4 November 2026, isi README disesuaikan dengan migration yang sebenarnya, supaya dokumen dan database sama.

## Detail J2 sampai J4

**Relasi antar tabel** (diagram lengkap di [docs/erd.md](../erd.md)):

| Relasi | Jenis | Implementasi |
|---|---|---|
| User -> Kost | one-to-many | `kosts.user_id` |
| Kost -> Room | one-to-many | `rooms.kost_id` |
| Room <-> Facility | many-to-many | pivot `facility_room` |
| Room -> Booking | one-to-many | `bookings.room_id` |
| Tenant -> Booking | one-to-many | `bookings.tenant_id` |
| Booking -> Payment | one-to-many | `payments.booking_id` |

**File yang dibuat:**
- `database/migrations/2026_11_01_100001` sampai `100007` (7 file)
- `app/Models/`: Kost, Room, Facility, Tenant, Booking, Payment
- `app/Models/User.php` (ditambah relasi `kosts()`)
- `docs/erd.md`

## Detail J5

**File yang dibuat:**
- `database/factories/`: KostFactory, RoomFactory, FacilityFactory, TenantFactory, BookingFactory, PaymentFactory
- `database/seeders/KostAreaSeeder.php`
- `database/seeders/DatabaseSeeder.php` (memanggil `KostAreaSeeder`)

**Data yang dihasilkan seeder:**

| Tabel | Jumlah |
|---|---|
| users | 1 (pemilik) |
| facilities | 6 |
| kosts | 2 |
| rooms | 10 (5 per kost) |
| facility_room | 30 (3 fasilitas per kamar) |
| tenants | 6 |
| bookings | 6 |
| payments | 18 (3 per booking) |

Nilai kolom `enum` pada factory sama dengan pilihan `enum` di migration.

## Cara verifikasi

```bash
php artisan migrate:fresh --seed
```

Semua migration berstatus `DONE`, lalu `Database\Seeders\KostAreaSeeder` berstatus `DONE` tanpa error.

## Kendala dan solusi

| Kendala | Solusi |
|---|---|
| Saat menyalin file, satu folder di-drag dan memilih Replace sehingga isi folder bawaan project (`app`, `database`, `docs`) tertimpa dan terhapus | Dipulihkan dengan `git restore .`, lalu file baru disalin satu per satu |
| `use HasMany` di `User.php` salah posisi (sebelum `namespace`) sehingga muncul error | Dipindahkan ke bawah `namespace` bersama import lainnya |
| `package-lock.json` hasil `npm install` ikut terdeteksi sebagai perubahan | Tidak di-commit karena bukan bagian tugas |
| README awal menjelaskan tabel dan kolom yang tidak ada di migration | README ditulis ulang agar sama dengan migration yang dijalankan |

## Langkah berikutnya

- Assignment 2: CRUD dengan template AdminLTE (branch terpisah)
- Controller, route, dan tampilan
- Validasi input dan autentikasi/otorisasi

## Bukti

- README dengan ERD: [README.md](https://github.com/Luchyana-Desi/laravel5d/blob/feature/p01-database-design/README.md)
- Dokumentasi relasi tabel: [docs/erd.md](https://github.com/Luchyana-Desi/laravel5d/blob/feature/p01-database-design/docs/erd.md)
- Migrations: [database/migrations](https://github.com/Luchyana-Desi/laravel5d/tree/feature/p01-database-design/database/migrations)
- Models: [app/Models](https://github.com/Luchyana-Desi/laravel5d/tree/feature/p01-database-design/app/Models)
- Factories: [database/factories](https://github.com/Luchyana-Desi/laravel5d/tree/feature/p01-database-design/database/factories)
- Seeders: [database/seeders](https://github.com/Luchyana-Desi/laravel5d/tree/feature/p01-database-design/database/seeders)
- Riwayat commit branch: [commits/feature/p01-database-design](https://github.com/Luchyana-Desi/laravel5d/commits/feature/p01-database-design)