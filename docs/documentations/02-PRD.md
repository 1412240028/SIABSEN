# Product Requirements Document (PRD)

> **Project Name:** SIABSEN (Sistem Informasi Absensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Document Information

| Item | Value |
|------|-------|
| Product | SIABSEN |
| Platform | Web Application |
| Framework | Laravel 13 |
| Database | MySQL |
| Frontend | Blade + Bootstrap 5 |
| Authentication | Laravel Breeze |
| Project Type | Final Exam Project |

---

# 2. Product Overview

SIABSEN merupakan aplikasi berbasis web yang digunakan untuk mengelola proses presensi mahasiswa secara digital.

Sistem memungkinkan administrator mengelola data master, dosen membuka sesi presensi, dan mahasiswa melakukan presensi menggunakan QR Code maupun metode manual apabila diperlukan.

---

# 3. Problem Statement

Proses presensi manual masih memiliki beberapa kendala, seperti:

- Membutuhkan waktu yang lama.
- Rekap presensi dilakukan secara manual.
- Sulit mengetahui riwayat kehadiran mahasiswa.
- Rentan terjadi kesalahan pencatatan.
- Sulit membuat laporan kehadiran.

---

# 4. Goals

## Business Goals

- Digitalisasi proses presensi.
- Mengurangi penggunaan media kertas.
- Mempermudah monitoring kehadiran.

---

## User Goals

Administrator

- Mengelola data sistem dengan mudah.

Dosen

- Membuka sesi presensi dengan cepat.

Mahasiswa

- Melakukan presensi secara praktis.

---

# 5. Stakeholders

| Stakeholder | Responsibility |
|-------------|----------------|
| Administrator | Mengelola sistem |
| Dosen | Mengelola presensi |
| Mahasiswa | Melakukan presensi |
| Developer | Mengembangkan aplikasi |

---

# 6. User Roles

## Administrator

### Permissions

- Login
- Dashboard
- CRUD Mahasiswa
- CRUD Dosen
- CRUD Mata Kuliah
- CRUD Kelas
- CRUD Jadwal
- Laporan

---

## Dosen

### Permissions

- Login
- Dashboard
- Jadwal Mengajar
- Membuka Sesi Presensi
- Generate QR Code
- Input Presensi Manual
- Laporan

---

## Mahasiswa

### Permissions

- Login
- Dashboard
- Scan QR
- Riwayat Presensi
- Profil

---

# 7. Functional Requirements

## Authentication

| ID | Requirement | Priority |
|----|-------------|----------|
| FR-001 | Login | High |
| FR-002 | Logout | High |
| FR-003 | Edit Profil | Medium |

---

## Dashboard

| ID | Requirement | Priority |
|----|-------------|----------|
| FR-004 | Dashboard Admin | High |
| FR-005 | Dashboard Dosen | High |
| FR-006 | Dashboard Mahasiswa | High |

---

## Master Data

| ID | Requirement | Priority |
|----|-------------|----------|
| FR-007 | CRUD Mahasiswa | High |
| FR-008 | CRUD Dosen | High |
| FR-009 | CRUD Mata Kuliah | High |
| FR-010 | CRUD Kelas | High |
| FR-011 | CRUD Jadwal | High |

---

## Presensi

| ID | Requirement | Priority |
|----|-------------|----------|
| FR-012 | Membuka Sesi Presensi | High |
| FR-013 | Generate QR Code | High |
| FR-014 | Scan QR Code | High |
| FR-015 | Presensi Manual | Medium |
| FR-016 | Riwayat Presensi | High |

---

## Reporting

| ID | Requirement | Priority |
|----|-------------|----------|
| FR-017 | Rekap Presensi | High |
| FR-018 | Statistik Kehadiran | Medium |

---

# 8. Non Functional Requirements

| ID | Requirement |
|----|-------------|
| NFR-001 | Responsive Design |
| NFR-002 | Multi Role Authentication |
| NFR-003 | Password Hashing |
| NFR-004 | Data Validation |
| NFR-005 | Soft Delete |
| NFR-006 | Session Security |
| NFR-007 | Clean UI |
| NFR-008 | Browser Compatibility |

---

# 9. User Stories

---

## Administrator

### US-001

Sebagai Administrator,

Saya ingin mengelola data mahasiswa,

Sehingga data mahasiswa selalu diperbarui.

---

### US-002

Sebagai Administrator,

Saya ingin mengelola jadwal,

Sehingga dosen dapat membuka sesi presensi.

---

## Dosen

### US-003

Sebagai Dosen,

Saya ingin membuka sesi presensi,

Sehingga mahasiswa dapat melakukan presensi.

---

### US-004

Sebagai Dosen,

Saya ingin menghasilkan QR Code,

Sehingga proses presensi lebih cepat.

---

## Mahasiswa

### US-005

Sebagai Mahasiswa,

Saya ingin melakukan scan QR Code,

Sehingga kehadiran saya tercatat otomatis.

---

### US-006

Sebagai Mahasiswa,

Saya ingin melihat riwayat presensi,

Sehingga saya mengetahui tingkat kehadiran.

---

# 10. Acceptance Criteria

## Login

- Email wajib diisi.
- Password wajib diisi.
- Login berhasil jika data valid.
- Login gagal jika data salah.

---

## CRUD Mahasiswa

- Tambah berhasil.
- Edit berhasil.
- Hapus berhasil.
- Validasi NIM unik.

---

## QR Code

- QR hanya berlaku pada sesi aktif.
- QR otomatis kedaluwarsa saat sesi ditutup.
- QR tidak dapat digunakan dua kali oleh mahasiswa yang sama pada sesi yang sama.

---

## Presensi

- Mahasiswa hanya dapat melakukan satu kali presensi pada setiap sesi.
- Status presensi langsung tersimpan ke database.
- Dosen dapat memperbarui status presensi jika diperlukan.

---

# 11. Assumptions

- Setiap mahasiswa memiliki akun.
- Setiap dosen memiliki akun.
- Seluruh pengguna memiliki akses internet.
- QR Code dipindai menggunakan perangkat yang memiliki kamera.

---

# 12. Constraints

- Laravel 13
- PHP 8.3
- MySQL
- Bootstrap 5
- Shared Hosting
- Domain Publik

---

# 13. MVP Scope

Fitur berikut wajib selesai pada versi 1.0.

- Authentication
- Dashboard
- CRUD Mahasiswa
- CRUD Dosen
- CRUD Mata Kuliah
- CRUD Kelas
- CRUD Jadwal
- QR Code Presensi
- Presensi Manual
- Riwayat Presensi
- Rekap Presensi

---

# 14. Future Enhancements

- Export PDF
- Export Excel
- REST API
- Progressive Web App (PWA)
- Notifikasi Email
- Integrasi dengan Sistem Akademik