# User Flow

> **Project Name:** SIABSEN (Sistem Informasi Presensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Overview

Dokumen ini mendeskripsikan alur interaksi pengguna saat menggunakan SIABSEN.

User Flow digunakan sebagai acuan dalam:

- Perancangan UI/UX
- Penyusunan Use Case
- Pembuatan Activity Diagram
- Implementasi Route Laravel
- Pengembangan Controller

---

# 2. Global User Flow

```text
Landing Page
      │
      ▼
Login
      │
      ▼
Validasi Akun
      │
      ▼
Role Checking
      │
 ┌────┼────┐
 │    │    │
 ▼    ▼    ▼
Admin Dosen Mahasiswa
```

---

# 3. Administrator Flow

## Objective

Mengelola seluruh data yang diperlukan agar proses presensi dapat berjalan.

---

```text
Login
   │
   ▼
Dashboard
   │
   ▼
Pilih Menu
   │
   ├───────────────┐
   │               │
   ▼               ▼
Master Data     Jadwal
   │               │
   ▼               ▼
CRUD Data     CRUD Jadwal
   │               │
   └──────┬────────┘
          ▼
      Dashboard
          │
          ▼
        Logout
```

---

## Administrator Tasks

- Login
- Mengelola Mahasiswa
- Mengelola Dosen
- Mengelola Mata Kuliah
- Mengelola Kelas
- Mengelola Jadwal
- Melihat Laporan
- Logout

---

# 4. Dosen Flow

## Objective

Melaksanakan proses presensi mahasiswa pada jadwal yang diampu.

---

```text
Login
   │
   ▼
Dashboard
   │
   ▼
Jadwal Mengajar
   │
   ▼
Pilih Jadwal
   │
   ▼
Buka Sesi Presensi
   │
   ▼
Generate QR Code
   │
   ▼
Mahasiswa Scan QR
   │
   ▼
Pantau Presensi
   │
   ├──────────────┐
   ▼              ▼
Edit Manual   Tutup Sesi
   │              │
   └──────┬───────┘
          ▼
      Rekap Presensi
          │
          ▼
        Logout
```

---

## Dosen Tasks

- Login
- Melihat jadwal
- Membuka sesi presensi
- Menampilkan QR Code
- Memantau mahasiswa yang hadir secara real-time
- Mengubah status presensi jika diperlukan
- Menutup sesi presensi
- Melihat laporan
- Logout

---

# 5. Mahasiswa Flow

## Objective

Melakukan presensi dan memantau riwayat kehadiran.

---

```text
Login
   │
   ▼
Dashboard
   │
   ▼
Scan QR
   │
   ▼
Validasi QR
   │
   ▼
Presensi Berhasil
   │
   ▼
Dashboard
   │
   ├─────────────┐
   ▼             ▼
Riwayat      Jadwal
   │             │
   └──────┬──────┘
          ▼
        Logout
```

---

## Mahasiswa Tasks

- Login
- Scan QR Code
- Melihat status presensi
- Melihat jadwal kuliah
- Melihat riwayat presensi
- Logout

---

# 6. Authentication Flow

```text
Landing Page
      │
      ▼
Login
      │
      ▼
Input Email & Password
      │
      ▼
Validasi
      │
 ┌────┴─────┐
 │          │
 ▼          ▼
Valid     Tidak Valid
 │          │
 ▼          ▼
Dashboard  Pesan Error
```

---

# 7. QR Attendance Flow

```text
Dosen Login
      │
      ▼
Pilih Jadwal
      │
      ▼
Buka Sesi Presensi
      │
      ▼
Generate QR Code
      │
      ▼
QR Ditampilkan
      │
      ▼
Mahasiswa Scan QR
      │
      ▼
Validasi Token
      │
 ┌────┴────┐
 │         │
 ▼         ▼
Valid   Tidak Valid
 │         │
 ▼         ▼
Simpan   Gagal
Data
 │
 ▼
Notifikasi Berhasil
```

---

# 8. Error Flow

## Login Gagal

```text
Login

↓

Email / Password Salah

↓

Tampilkan Error

↓

Kembali ke Login
```

---

## QR Kedaluwarsa

```text
Scan QR

↓

QR Expired

↓

Tampilkan Pesan

↓

Kembali ke Dashboard
```

---

## Presensi Ganda

```text
Scan QR

↓

Sudah Presensi

↓

Tampilkan Notifikasi

↓

Selesai
```

---

# 9. Navigation Summary

| Role | Primary Goal | Entry Point | Exit Point |
|------|--------------|-------------|------------|
| Administrator | Mengelola Data | Dashboard | Logout |
| Dosen | Mengelola Presensi | Dashboard | Logout |
| Mahasiswa | Melakukan Presensi | Dashboard | Logout |

---

# 10. UX Principles

SIABSEN dirancang berdasarkan prinsip berikut:

- Setiap tugas utama dapat diselesaikan dalam sesedikit mungkin langkah.
- Pengguna selalu mengetahui status proses yang sedang berlangsung.
- Kesalahan ditampilkan dengan pesan yang jelas.
- Navigasi konsisten pada seluruh halaman.
- Setiap role hanya melihat fitur yang relevan dengan tugasnya.

---

# 11. Success Flow Summary

### Administrator

```text
Login
↓
Kelola Data
↓
Kelola Jadwal
↓
Logout
```

---

### Dosen

```text
Login
↓
Pilih Jadwal
↓
Buka Presensi
↓
QR Ditampilkan
↓
Pantau Kehadiran
↓
Tutup Presensi
↓
Logout
```

---

### Mahasiswa

```text
Login
↓
Scan QR
↓
Presensi Berhasil
↓
Lihat Riwayat
↓
Logout
```