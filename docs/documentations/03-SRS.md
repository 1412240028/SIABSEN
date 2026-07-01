# Software Requirements Specification (SRS)

> **Project Name:** SIABSEN (Sistem Informasi Presensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Introduction

## 1.1 Purpose

Dokumen Software Requirements Specification (SRS) mendefinisikan seluruh kebutuhan perangkat lunak SIABSEN sebagai acuan dalam proses analisis, perancangan, implementasi, pengujian, dan pemeliharaan sistem.

---

## 1.2 Scope

SIABSEN merupakan aplikasi berbasis web yang digunakan untuk mengelola proses presensi mahasiswa secara digital menggunakan QR Code maupun presensi manual.

Sistem memiliki tiga jenis pengguna:

- Administrator
- Dosen
- Mahasiswa

---

## 1.3 Definitions

| Istilah | Penjelasan |
|----------|------------|
| Presensi | Pencatatan kehadiran mahasiswa |
| QR Code | Media digital untuk melakukan presensi |
| Sesi Presensi | Periode presensi yang dibuka oleh dosen |
| Jadwal | Informasi waktu pelaksanaan mata kuliah |

---

# 2. Overall Description

## 2.1 Product Perspective

SIABSEN merupakan aplikasi mandiri berbasis web yang berjalan pada browser modern.

Sistem menggunakan database MySQL dan framework Laravel.

---

## 2.2 Product Functions

Sistem menyediakan fungsi berikut.

### Administrator

- Login
- Dashboard
- Mengelola Mahasiswa
- Mengelola Dosen
- Mengelola Mata Kuliah
- Mengelola Kelas
- Mengelola Jadwal
- Melihat Rekap Presensi

---

### Dosen

- Login
- Dashboard
- Melihat Jadwal Mengajar
- Membuka Sesi Presensi
- Generate QR Code
- Presensi Manual
- Melihat Rekap Presensi

---

### Mahasiswa

- Login
- Dashboard
- Scan QR Code
- Melihat Riwayat Presensi
- Mengelola Profil

---

## 2.3 User Characteristics

### Administrator

Memiliki hak akses penuh terhadap sistem.

---

### Dosen

Mengelola proses presensi pada kelas yang diampu.

---

### Mahasiswa

Melakukan presensi dan melihat riwayat kehadiran.

---

## 2.4 Constraints

- Laravel 13
- PHP 8.3
- MySQL
- Bootstrap 5
- Shared Hosting

---

## 2.5 Assumptions

- Seluruh pengguna memiliki akun.
- Perangkat memiliki akses internet.
- Kamera tersedia untuk scan QR Code.

---

# 3. Functional Requirements

## Authentication

| ID | Requirement |
|----|-------------|
| FR-001 | Sistem harus menyediakan halaman login. |
| FR-002 | Sistem harus memvalidasi email dan password. |
| FR-003 | Sistem harus mengarahkan pengguna ke dashboard sesuai role. |
| FR-004 | Sistem harus menyediakan fitur logout. |

---

## Dashboard

| ID | Requirement |
|----|-------------|
| FR-005 | Dashboard Admin menampilkan ringkasan data sistem. |
| FR-006 | Dashboard Dosen menampilkan jadwal mengajar hari ini. |
| FR-007 | Dashboard Mahasiswa menampilkan riwayat dan persentase presensi. |

---

## Master Data

| ID | Requirement |
|----|-------------|
| FR-008 | Sistem harus menyediakan CRUD Mahasiswa. |
| FR-009 | Sistem harus menyediakan CRUD Dosen. |
| FR-010 | Sistem harus menyediakan CRUD Mata Kuliah. |
| FR-011 | Sistem harus menyediakan CRUD Kelas. |
| FR-012 | Sistem harus menyediakan CRUD Jadwal. |

---

## Presensi

| ID | Requirement |
|----|-------------|
| FR-013 | Dosen dapat membuka sesi presensi. |
| FR-014 | Sistem menghasilkan QR Code unik pada setiap sesi. |
| FR-015 | Mahasiswa dapat melakukan presensi menggunakan QR Code. |
| FR-016 | Dosen dapat melakukan presensi manual. |
| FR-017 | Mahasiswa hanya dapat melakukan satu kali presensi pada setiap sesi. |
| FR-018 | Sistem menyimpan waktu presensi secara otomatis. |

---

## Reporting

| ID | Requirement |
|----|-------------|
| FR-019 | Sistem menampilkan riwayat presensi mahasiswa. |
| FR-020 | Sistem menghasilkan rekap presensi berdasarkan kelas dan mata kuliah. |

---

# 4. Non-Functional Requirements

## Performance

| ID | Requirement |
|----|-------------|
| NFR-001 | Waktu respon halaman kurang dari 3 detik pada kondisi normal. |
| NFR-002 | Sistem mampu menangani minimal 100 pengguna aktif secara bersamaan. |

---

## Security

| ID | Requirement |
|----|-------------|
| NFR-003 | Password harus disimpan dalam bentuk hash. |
| NFR-004 | Seluruh halaman harus dilindungi autentikasi. |
| NFR-005 | Hak akses dibatasi berdasarkan role pengguna. |

---

## Reliability

| ID | Requirement |
|----|-------------|
| NFR-006 | Sistem harus menjaga konsistensi data presensi. |
| NFR-007 | Sistem harus mencatat waktu pembuatan dan perubahan data. |

---

## Usability

| ID | Requirement |
|----|-------------|
| NFR-008 | Antarmuka mudah dipahami oleh pengguna baru. |
| NFR-009 | Navigasi konsisten pada seluruh halaman. |

---

## Compatibility

| ID | Requirement |
|----|-------------|
| NFR-010 | Sistem berjalan pada browser modern (Chrome, Edge, Firefox). |

---

# 5. External Interface Requirements

## User Interface

- Responsive layout.
- Sidebar navigation.
- Dashboard berbasis kartu statistik.
- Tabel data dengan pencarian dan pagination.

---

## Database

Menggunakan MySQL.

---

## Software Interface

- Laravel Breeze Authentication
- Simple QrCode Package

---

# 6. Business Rules

- Mahasiswa hanya dapat melakukan satu kali presensi pada setiap sesi.
- QR Code hanya berlaku untuk satu sesi presensi.
- QR Code otomatis tidak berlaku setelah sesi ditutup.
- Dosen hanya dapat membuka sesi untuk jadwal yang diampunya.
- Administrator memiliki akses penuh terhadap seluruh data.

---

# 7. Acceptance Criteria

Sistem dinyatakan memenuhi spesifikasi apabila:

- Seluruh fitur CRUD berjalan dengan baik.
- Login multi-role berfungsi.
- QR Code dapat digunakan untuk presensi.
- Data presensi tersimpan dengan benar.
- Rekap presensi dapat ditampilkan.
- Sistem berhasil di-deploy pada shared hosting.