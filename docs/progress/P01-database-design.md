# Progress Report: P01 Database Design

| | |
|---|---|
| **Student** | Luchyana Desi Safitri |
| **NPM** | 2410010230 |
| **Class** | TI 5D REG BJB |
| **Assignment** | Assignment 1: Table Relationships: Kost Area |
| **Phase** | P01: Database Design |
| **Fork / branch** | [Luchyana-Desi/laravel5d](https://github.com/Luchyana-Desi/laravel5d) / `feature/p01-database-design` |
| **Last updated** | 1 November 2026 |
| **Status** | Done |

## Ringkasan

Fase P01 mengerjakan desain database untuk proyek **Kost Area**, yaitu platform manajemen dan booking kos. Pekerjaan mencakup perancangan ERD dan aturan bisnis, pembuatan migration, model Eloquent beserta relasinya, dan dokumentasi relasi tabel.

## Status job

| Job | Description | Status | Commit |
|---|---|---|---|
| J1 | Membuat README project berisi desain database (ERD diagram) dan aturan bisnis Kost Area | Done | [`2736dd5`](https://github.com/Luchyana-Desi/laravel5d/commit/2736dd5) |
| J2 | Migration 7 tabel (kosts, rooms, facilities, facility_room, tenants, bookings, payments) dengan foreign key dan unique constraint | Done | [`5159adf`](https://github.com/Luchyana-Desi/laravel5d/commit/5159adf) |
| J3 | Model Eloquent beserta relasi (`hasMany`, `belongsTo`, `belongsToMany`) dan relasi `kosts()` di `User` | Done | [`5159adf`](https://github.com/Luchyana-Desi/laravel5d/commit/5159adf) |
| J4 | Dokumentasi relasi tabel (`docs/erd.md`) dan progress report | Done | [`5159adf`](https://github.com/Luchyana-Desi/laravel5d/commit/5159adf) |

## Detail J1

- Menambahkan `README.md` di root project dengan bagian **Desain Database** yang memuat ERD diagram.
- Menuliskan bagian **Aturan Bisnis** yang menjelaskan alur booking dan pembayaran:
  - Saat booking dibuat, tarif kamar disalin ke `bookings.price_per_unit`, lalu `total_price = price_per_unit x duration` dan `end_date = start_date + duration` (satuan hari atau bulan).
  - Sewa bulanan: sistem membuat satu pembayaran `deposit` dan satu pembayaran `rent` per bulan, masing-masing dengan `due_date` sendiri.
  - Sewa harian: tanpa deposit, sistem membuat satu pembayaran `rent` senilai `total_price` yang jatuh tempo pada `start_date`.
  - Untuk transfer dan QRIS, penghuni mengunggah bukti bayar.

## Detail J2-J4

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
- `app/Models/` : Kost, Room, Facility, Tenant, Booking, Payment
- `app/Models/User.php` (ditambah relasi `kosts()`)
- `docs/erd.md`

## Cara verifikasi

```bash
php artisan migrate:fresh --seed
```
Semua migration berstatus `DONE` tanpa error.

## Kendala dan solusi

| Kendala | Solusi |
|---|---|
| Saat menyalin file, satu folder di-drag dan memilih Replace sehingga isi folder bawaan project (`app`, `database`, `docs`) tertimpa dan terhapus | Dipulihkan dengan `git restore .`, lalu file baru disalin satu per satu |
| `use HasMany` di `User.php` salah posisi (sebelum `namespace`) sehingga muncul error | Dipindahkan ke bawah `namespace` bersama import lainnya |
| `package-lock.json` hasil `npm install` ikut terdeteksi sebagai perubahan | Tidak di-commit karena bukan bagian tugas |

## Langkah berikutnya

- Seeder dan factory data Kost Area
- Controller, route, dan tampilan (fase berikutnya)
- Validasi input dan autentikasi/otorisasi
- Memperbarui progress report ini setiap ada job yang selesai.

## Bukti

- README dengan ERD: [README.md](https://github.com/Luchyana-Desi/laravel5d/blob/feature/p01-database-design/README.md)
- Dokumentasi relasi tabel: [docs/erd.md](https://github.com/Luchyana-Desi/laravel5d/blob/feature/p01-database-design/docs/erd.md)
- Migrations: [database/migrations](https://github.com/Luchyana-Desi/laravel5d/tree/feature/p01-database-design/database/migrations)
- Models: [app/Models](https://github.com/Luchyana-Desi/laravel5d/tree/feature/p01-database-design/app/Models)
- Riwayat commit branch: [commits/feature/p01-database-design](https://github.com/Luchyana-Desi/laravel5d/commits/feature/p01-database-design)