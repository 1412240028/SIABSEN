# Functional Module Specification (FMS)

> **Project Name:** SIABSEN (Sistem Informasi Presensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Final Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Overview

Functional Module Specification (FMS) mendefinisikan seluruh modul yang akan dikembangkan pada aplikasi SIABSEN beserta fungsi, aktor, hak akses, dan fitur yang tersedia.

Dokumen ini menjadi acuan utama selama proses implementasi sistem menggunakan Laravel.

---

# 2. Module List

| No | Module | Description |
|----|---------|-------------|
| 1 | Authentication | Login, Logout, Profile |
| 2 | Dashboard | Dashboard sesuai role |
| 3 | User Management | Manajemen akun |
| 4 | Mahasiswa Management | CRUD Mahasiswa |
| 5 | Dosen Management | CRUD Dosen |
| 6 | Kelas Management | CRUD Kelas |
| 7 | Mata Kuliah Management | CRUD Mata Kuliah |
| 8 | Jadwal Management | CRUD Jadwal Kuliah |
| 9 | Sesi Presensi | Membuka dan menutup sesi presensi |
| 10 | Presensi Mahasiswa | Scan QR & Presensi Manual |
| 11 | Riwayat Presensi | Riwayat kehadiran mahasiswa |
| 12 | Laporan | Rekap presensi |
| 13 | Profile | Pengelolaan profil pengguna |

---

# 3. Module Specification

---

# Module 1 — Authentication

## Actor

- Administrator
- Dosen
- Mahasiswa

## Features

- Login
- Logout
- Remember Me
- Session Management

## Input

- Email
- Password

## Output

- Dashboard sesuai role

---

# Module 2 — Dashboard

## Administrator

Menampilkan:

- Total Mahasiswa
- Total Dosen
- Total Mata Kuliah
- Total Kelas
- Total Jadwal
- Total Presensi Hari Ini

---

## Dosen

Menampilkan:

- Jadwal Hari Ini
- Sesi Presensi Aktif
- Total Mahasiswa Hadir
- Riwayat Presensi

---

## Mahasiswa

Menampilkan:

- Jadwal Hari Ini
- Status Presensi Hari Ini
- Riwayat Kehadiran
- Persentase Kehadiran

---

# Module 3 — User Management

## Actor

Administrator

## Features

- Tambah User
- Edit User
- Reset Password
- Aktivasi Akun
- Nonaktifkan Akun

---

# Module 4 — Mahasiswa Management

## Actor

Administrator

## Features

- Tambah Mahasiswa
- Edit Mahasiswa
- Detail Mahasiswa
- Hapus Mahasiswa
- Pencarian
- Filter Kelas

---

# Module 5 — Dosen Management

## Actor

Administrator

## Features

- Tambah Dosen
- Edit Dosen
- Detail Dosen
- Hapus Dosen
- Pencarian

---

# Module 6 — Kelas Management

## Actor

Administrator

## Features

- CRUD Kelas
- Pencarian
- Filter Angkatan

---

# Module 7 — Mata Kuliah Management

## Actor

Administrator

## Features

- CRUD Mata Kuliah
- Pencarian
- Filter Status

---

# Module 8 — Jadwal Management

## Actor

Administrator

## Features

- Tambah Jadwal
- Edit Jadwal
- Hapus Jadwal
- Filter Semester
- Filter Tahun Ajaran
- Filter Hari
- Pencarian

---

# Module 9 — Sesi Presensi

## Actor

Dosen

## Features

- Buka Sesi Presensi
- Generate QR Code
- Generate Token
- Lihat Daftar Mahasiswa
- Presensi Manual
- Tutup Sesi

---

# Module 10 — Presensi Mahasiswa

## Actor

Mahasiswa

## Features

- Scan QR Code
- Validasi Token
- Validasi Status Sesi
- Simpan Presensi
- Notifikasi Berhasil

---

# Module 11 — Riwayat Presensi

## Actor

Mahasiswa

## Features

- Melihat Riwayat
- Filter Mata Kuliah
- Filter Semester
- Detail Presensi

---

# Module 12 — Laporan

## Actor

Administrator

Dosen

## Features

- Rekap Kehadiran
- Filter Kelas
- Filter Mata Kuliah
- Filter Semester
- Filter Rentang Tanggal
- Export PDF
- Export Excel

---

# Module 13 — Profile

## Actor

Semua User

## Features

- Edit Profil
- Upload Foto
- Ganti Password

---

# 4. Access Matrix

| Module | Admin | Dosen | Mahasiswa |
|---------|:----:|:------:|:---------:|
| Authentication | ✅ | ✅ | ✅ |
| Dashboard | ✅ | ✅ | ✅ |
| User Management | ✅ | ❌ | ❌ |
| Mahasiswa | ✅ | ❌ | ❌ |
| Dosen | ✅ | ❌ | ❌ |
| Kelas | ✅ | ❌ | ❌ |
| Mata Kuliah | ✅ | ❌ | ❌ |
| Jadwal | ✅ | ❌ | ❌ |
| Sesi Presensi | ❌ | ✅ | ❌ |
| Presensi Mahasiswa | ❌ | ❌ | ✅ |
| Riwayat Presensi | ❌ | ❌ | ✅ |
| Laporan | ✅ | ✅ | ❌ |
| Profile | ✅ | ✅ | ✅ |

---

# 5. Development Priority

## Phase 1

- Authentication
- Dashboard
- User Management

---

## Phase 2

- Mahasiswa
- Dosen
- Kelas
- Mata Kuliah

---

## Phase 3

- Jadwal

---

## Phase 4

- Sesi Presensi
- QR Code

---

## Phase 5

- Presensi Mahasiswa

---

## Phase 6

- Laporan

---

## Phase 7

- Profile

---

# 6. Dependencies

Authentication
↓
Dashboard
↓
Master Data
↓
Jadwal
↓
Sesi Presensi
↓
Presensi
↓
Laporan

---

# 7. Conclusion

Seluruh modul pada SIABSEN dirancang agar saling terintegrasi dengan alur pengembangan bertahap. Setiap modul memiliki aktor, hak akses, dan fitur yang jelas sehingga implementasi menggunakan Laravel dapat dilakukan secara terstruktur, mudah diuji, dan mudah dikembangkan pada versi berikutnya.