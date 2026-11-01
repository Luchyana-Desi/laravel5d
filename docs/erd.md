# ERD: Kost Area

Diagram relasi antar tabel (Mermaid; otomatis tampil di GitHub).

```mermaid
erDiagram
    USERS ||--o{ KOSTS : "memiliki"
    KOSTS ||--o{ ROOMS : "punya"
    ROOMS }o--o{ FACILITIES : "facility_room"
    ROOMS ||--o{ BOOKINGS : "dipesan"
    TENANTS ||--o{ BOOKINGS : "melakukan"
    BOOKINGS ||--o{ PAYMENTS : "dibayar lewat"

    USERS {
        bigint id PK
        string name
        string email
    }
    KOSTS {
        bigint id PK
        bigint user_id FK
        string name
        string address
        string city
        text description
    }
    ROOMS {
        bigint id PK
        bigint kost_id FK
        string room_number
        enum type
        int price_per_month
        enum status
    }
    FACILITIES {
        bigint id PK
        string name
    }
    FACILITY_ROOM {
        bigint id PK
        bigint room_id FK
        bigint facility_id FK
    }
    TENANTS {
        bigint id PK
        string name
        string phone
        string id_number
        string occupation
    }
    BOOKINGS {
        bigint id PK
        bigint room_id FK
        bigint tenant_id FK
        date start_date
        date end_date
        enum status
    }
    PAYMENTS {
        bigint id PK
        bigint booking_id FK
        int amount
        string period_month
        date paid_at
        enum method
        enum status
    }
```

## Ringkasan relasi

| Tabel A | Relasi | Tabel B | Keterangan |
|---|---|---|---|
| users | one-to-many | kosts | satu pemilik bisa punya banyak kost |
| kosts | one-to-many | rooms | satu kost punya banyak kamar |
| rooms | many-to-many | facilities | pivot `facility_room` |
| rooms | one-to-many | bookings | satu kamar bisa dipesan berkali-kali (periode berbeda) |
| tenants | one-to-many | bookings | satu penyewa bisa punya banyak booking |
| bookings | one-to-many | payments | pembayaran bulanan per booking |

## Aturan integritas

- Semua foreign key memakai `cascadeOnDelete`.
- `rooms`: kombinasi `kost_id` + `room_number` unik.
- `facility_room`: kombinasi `room_id` + `facility_id` unik (tidak ada duplikat).
- `tenants.id_number` dan `facilities.name` unik.
