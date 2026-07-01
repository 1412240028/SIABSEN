# Project Overview

> **Project Name:** SIABSEN (Sistem Informasi Absensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Project Summary

SIABSEN (Sistem Informasi Absensi Mahasiswa) merupakan aplikasi berbasis web yang dirancang untuk membantu proses pencatatan dan pengelolaan presensi mahasiswa secara digital di lingkungan Universitas PGRI Ronggolawe (UNIROW).

Sistem menyediakan mekanisme presensi menggunakan QR Code maupun input manual oleh dosen, sehingga proses kehadiran menjadi lebih cepat, akurat, dan terdokumentasi dengan baik.

SIABSEN dikembangkan sebagai proyek Ujian Akhir Semester (UAS) Mata Kuliah Pemrograman Web menggunakan framework Laravel.

---

# 2. Problem Statement

Proses presensi mahasiswa yang masih dilakukan secara manual memiliki beberapa kelemahan, antara lain:

- Membutuhkan waktu yang cukup lama pada awal perkuliahan.
- Rekapitulasi kehadiran masih dilakukan secara manual.
- Sulit memantau tingkat kehadiran mahasiswa secara real-time.
- Data presensi rentan hilang atau tidak terdokumentasi dengan baik.
- Dosen membutuhkan cara yang lebih praktis dalam melakukan presensi.

---

# 3. Solution

SIABSEN menyediakan sistem presensi berbasis web yang memungkinkan:

- Administrator mengelola seluruh data sistem.
- Dosen membuka sesi presensi dan mengelola kehadiran mahasiswa.
- Mahasiswa melakukan presensi menggunakan QR Code.
- Sistem menghasilkan laporan presensi secara otomatis.

---

# 4. Project Objectives

## Tujuan Utama

Membangun sistem informasi presensi mahasiswa yang sederhana, mudah digunakan, dan mampu menggantikan proses presensi manual.

## Tujuan Khusus

- Mempermudah proses presensi mahasiswa.
- Mempermudah pengelolaan data presensi.
- Mempermudah monitoring kehadiran mahasiswa.
- Menyediakan laporan presensi secara otomatis.
- Mengurangi penggunaan media presensi berbasis kertas.

---

# 5. Scope

## In Scope

### Authentication

- Login
- Logout
- Profile

### Master Data

- Mahasiswa
- Dosen
- Mata Kuliah
- Kelas

### Academic

- Jadwal Perkuliahan

### Attendance

- Buka sesi presensi
- QR Code presensi
- Presensi manual
- Riwayat presensi

### Reporting

- Rekap presensi
- Statistik kehadiran

---

## Out of Scope

Fitur berikut **tidak** termasuk dalam ruang lingkup SIABSEN.

- Sistem KRS
- Penilaian Mahasiswa
- Transkrip Nilai
- Pembayaran UKT
- Sistem Akademik Lengkap
- Face Recognition
- Fingerprint
- RFID
- Mobile Application

---

# 6. Target Users

## Administrator

Mengelola seluruh data sistem.

---

## Dosen

Mengelola proses presensi mahasiswa.

---

## Mahasiswa

Melakukan presensi dan melihat riwayat kehadiran.

---

# 7. User Roles

| Role | Responsibility |
|-------|----------------|
| Administrator | Mengelola data master dan laporan |
| Dosen | Mengelola sesi presensi |
| Mahasiswa | Melakukan presensi |

---

# 8. Technology Stack

| Layer | Technology |
|--------|------------|
| Backend | Laravel 13 |
| Language | PHP 8.3 |
| Database | MySQL |
| Frontend | Blade |
| CSS Framework | Bootstrap 5 |
| JavaScript | Vanilla JavaScript |
| Authentication | Laravel Breeze |
| QR Code | Simple QrCode Package |
| Hosting | Shared Hosting |
| Domain | Domain Pribadi |

---

# 9. Core Features

## Administrator

- Login
- Dashboard
- CRUD Mahasiswa
- CRUD Dosen
- CRUD Mata Kuliah
- CRUD Kelas
- CRUD Jadwal
- Melihat laporan

---

## Dosen

- Login
- Dashboard
- Melihat jadwal
- Membuka sesi presensi
- Generate QR Code
- Input presensi manual
- Melihat rekap presensi

---

## Mahasiswa

- Login
- Dashboard
- Scan QR Code
- Melihat riwayat presensi
- Mengubah profil

---

# 10. Success Criteria

Project dianggap berhasil apabila:

- Seluruh fitur CRUD berjalan dengan baik.
- Login multi-role berfungsi.
- Presensi QR Code berjalan dengan baik.
- Presensi manual berjalan dengan baik.
- Laporan presensi dapat ditampilkan.
- Sistem berhasil di-deploy ke hosting.
- Sistem dapat diakses menggunakan domain publik.

---

# 11. Business Boundary

SIABSEN hanya berfokus pada **manajemen presensi mahasiswa**.

Sistem **bukan** merupakan Sistem Informasi Akademik (SIAKAD), sehingga fitur yang berkaitan dengan proses akademik di luar presensi tidak dikembangkan pada versi ini.

---

# 12. Future Development

- Export PDF
- Export Excel
- Notifikasi Email
- Notifikasi WhatsApp
- Progressive Web App (PWA)
- Integrasi dengan Sistem Akademik (SIAKAD)

---

# 13. Project Roadmap

```text
Project Overview
        │
        ▼
Product Vision
        │
        ▼
Product Requirements Document (PRD)
        │
        ▼
Software Requirements Specification (SRS)
        │
        ▼
Business Rules
        │
        ▼
Information Architecture
        │
        ▼
User Persona
        │
        ▼
User Flow
        │
        ▼
Use Case
        │
        ▼
ERD
        │
        ▼
Database Schema
        │
        ▼
Wireframe
        │
        ▼
Development
```