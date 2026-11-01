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

## Ringkasan

Fase P01 mengerjakan desain database untuk proyek **Kost Area**, yaitu platform manajemen dan booking kos. Sampai tanggal di atas, job **J1** sudah selesai. Job berikutnya belum dikerjakan.

## Status job

| Job | Description | Status | Commit |
|---|---|---|---|
| J1 | Membuat README project berisi desain database (ERD diagram) dan aturan bisnis Kost Area | Done | [`2736dd5`](https://github.com/Luchyana-Desi/laravel5d/commit/2736dd5) |
| J2 dst. | Migration, model, dan relasi antar tabel | Not started | - |

## Detail J1

- Menambahkan `README.md` di root project dengan bagian **Desain Database** yang memuat ERD diagram.
- Menuliskan bagian **Aturan Bisnis** yang menjelaskan alur booking dan pembayaran:
  - Saat booking dibuat, tarif kamar disalin ke `bookings.price_per_unit`, lalu `total_price = price_per_unit x duration` dan `end_date = start_date + duration` (satuan hari atau bulan).
  - Sewa bulanan: sistem membuat satu pembayaran `deposit` dan satu pembayaran `rent` per bulan, masing-masing dengan `due_date` sendiri.
  - Sewa harian: tanpa deposit, sistem membuat satu pembayaran `rent` senilai `total_price` yang jatuh tempo pada `start_date`.
  - Untuk transfer dan QRIS, penghuni mengunggah bukti bayar.

## Kendala

Tidak ada.

## Langkah berikutnya

- Membuat migration untuk tabel-tabel pada ERD.
- Membuat model Eloquent beserta relasinya (`hasMany`, `belongsTo`, dan sejenisnya).
- Memperbarui progress report ini setiap ada job yang selesai.

## Bukti

- README dengan ERD: [README.md](https://github.com/Luchyana-Desi/laravel5d/blob/feature/p01-database-design/README.md)
- Riwayat commit branch: [commits/feature/p01-database-design](https://github.com/Luchyana-Desi/laravel5d/commits/feature/p01-database-design)
