# Information Architecture

> **Project Name:** SIABSEN (Sistem Informasi Presensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Overview

Dokumen ini mendefinisikan struktur informasi, navigasi, serta hierarki halaman pada aplikasi SIABSEN.

Tujuan utama Information Architecture adalah memastikan pengguna dapat menemukan fitur yang dibutuhkan dengan mudah sesuai hak aksesnya.

---

# 2. Global Navigation

Sebelum login, pengguna hanya dapat mengakses halaman publik berikut.

```text
Landing Page
│
├── Home
├── Tentang
├── Panduan
├── Kontak
└── Login
```

Setelah login, sistem akan mengarahkan pengguna ke dashboard berdasarkan role.

---

# 3. Navigation Structure

## Administrator

```text
Dashboard
│
├── Dashboard
│
├── Master Data
│   ├── Mahasiswa
│   ├── Dosen
│   ├── Mata Kuliah
│   └── Kelas
│
├── Jadwal
│
├── Laporan
│
├── Profil
│
└── Logout
```

---

## Dosen

```text
Dashboard
│
├── Dashboard
│
├── Jadwal Mengajar
│
├── Presensi
│   ├── Buka Sesi
│   ├── QR Code
│   ├── Presensi Manual
│   └── Riwayat Presensi
│
├── Laporan
│
├── Profil
│
└── Logout
```

---

## Mahasiswa

```text
Dashboard
│
├── Dashboard
│
├── Presensi
│   ├── Scan QR
│   └── Riwayat Presensi
│
├── Jadwal Kuliah
│
├── Profil
│
└── Logout
```

---

# 4. Sitemap

```text
Landing Page
        │
        ▼
      Login
        │
        ▼
 Authentication
        │
        ▼
 Role Checking
        │
 ┌──────┼─────────┐
 │      │         │
 ▼      ▼         ▼
Admin  Dosen  Mahasiswa
```

---

# 5. Page Hierarchy

## Landing Page

```text
Landing Page
│
├── Hero Section
├── Tentang SIABSEN
├── Fitur
├── Cara Kerja
├── FAQ
├── Kontak
└── Footer
```

---

## Dashboard

```text
Dashboard
│
├── Welcome Card
├── Statistik
├── Aktivitas Terbaru
├── Shortcut Menu
└── Jadwal Hari Ini
```

---

## Master Data

```text
Master Data
│
├── Mahasiswa
│   ├── List
│   ├── Tambah
│   ├── Detail
│   ├── Edit
│   └── Hapus
│
├── Dosen
│   ├── List
│   ├── Tambah
│   ├── Detail
│   ├── Edit
│   └── Hapus
│
├── Mata Kuliah
│   ├── List
│   ├── Tambah
│   ├── Detail
│   ├── Edit
│   └── Hapus
│
└── Kelas
    ├── List
    ├── Tambah
    ├── Detail
    ├── Edit
    └── Hapus
```

---

## Jadwal

```text
Jadwal
│
├── Daftar Jadwal
├── Tambah Jadwal
├── Detail Jadwal
├── Edit Jadwal
└── Hapus Jadwal
```

---

## Presensi

### Dosen

```text
Presensi
│
├── Pilih Jadwal
├── Buka Sesi
├── Generate QR Code
├── Presensi Manual
├── Tutup Sesi
└── Riwayat Presensi
```

### Mahasiswa

```text
Presensi
│
├── Scan QR
├── Status Presensi
└── Riwayat Presensi
```

---

## Laporan

```text
Laporan
│
├── Rekap Presensi
├── Statistik Kehadiran
└── Filter Berdasarkan
    ├── Mata Kuliah
    ├── Kelas
    └── Dosen
```

---

# 6. Navigation Principles

SIABSEN menerapkan prinsip navigasi sebagai berikut.

## Consistency

Posisi menu tetap pada seluruh halaman.

---

## Simplicity

Menu dibatasi hanya pada fitur yang benar-benar diperlukan.

---

## Role-Based Navigation

Setiap pengguna hanya dapat melihat menu sesuai hak aksesnya.

---

## Maximum Three-Level Navigation

Struktur menu maksimal terdiri dari tiga tingkat agar tetap mudah dipahami.

---

# 7. Page Access Matrix

| Halaman | Admin | Dosen | Mahasiswa |
|----------|:-----:|:------:|:---------:|
| Dashboard | ✅ | ✅ | ✅ |
| Mahasiswa | ✅ | ❌ | ❌ |
| Dosen | ✅ | ❌ | ❌ |
| Mata Kuliah | ✅ | ❌ | ❌ |
| Kelas | ✅ | ❌ | ❌ |
| Jadwal | ✅ | ✅ (Lihat) | ✅ (Lihat) |
| Buka Sesi Presensi | ❌ | ✅ | ❌ |
| QR Code | ❌ | ✅ | ❌ |
| Presensi Manual | ❌ | ✅ | ❌ |
| Scan QR | ❌ | ❌ | ✅ |
| Riwayat Presensi | ❌ | ✅ | ✅ |
| Laporan | ✅ | ✅ | ❌ |
| Profil | ✅ | ✅ | ✅ |

---

# 8. Breadcrumb Structure

Contoh breadcrumb yang digunakan.

```text
Dashboard

Dashboard > Mahasiswa

Dashboard > Mahasiswa > Tambah

Dashboard > Jadwal > Edit

Dashboard > Presensi > Buka Sesi
```

---

# 9. Route Groups (Laravel)

```text
/

/login

/admin
/admin/dashboard
/admin/mahasiswa
/admin/dosen
/admin/mata-kuliah
/admin/kelas
/admin/jadwal
/admin/laporan

/dosen
/dosen/dashboard
/dosen/jadwal
/dosen/presensi
/dosen/laporan

/mahasiswa
/mahasiswa/dashboard
/mahasiswa/presensi
/mahasiswa/jadwal
```

---

# 10. Future Navigation

Versi berikutnya dapat menambahkan menu:

- Notifikasi
- Export Data
- Pengaturan Akun
- API Access