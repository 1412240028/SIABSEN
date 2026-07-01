# Use Case Specification

> **Project Name:** SIABSEN (Sistem Informasi Presensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Overview

Dokumen ini mendefinisikan seluruh use case yang tersedia pada SIABSEN beserta aktor, tujuan, alur utama, alur alternatif, dan kondisi akhir.

Dokumen ini menjadi acuan dalam pembuatan:

- Use Case Diagram
- Activity Diagram
- Sequence Diagram
- Implementasi Controller
- Pengujian Sistem

---

# 2. Actors

| Actor | Deskripsi |
|--------|-----------|
| Administrator | Mengelola data master dan jadwal |
| Dosen | Mengelola proses presensi |
| Mahasiswa | Melakukan presensi dan melihat riwayat |

---

# 3. Use Case List

| ID | Use Case | Actor |
|----|----------|-------|
| UC-001 | Login | Semua |
| UC-002 | Logout | Semua |
| UC-003 | Melihat Dashboard | Semua |
| UC-004 | Kelola Mahasiswa | Admin |
| UC-005 | Kelola Dosen | Admin |
| UC-006 | Kelola Mata Kuliah | Admin |
| UC-007 | Kelola Kelas | Admin |
| UC-008 | Kelola Jadwal | Admin |
| UC-009 | Membuka Sesi Presensi | Dosen |
| UC-010 | Menampilkan QR Presensi | Dosen |
| UC-011 | Presensi Manual | Dosen |
| UC-012 | Melakukan Presensi | Mahasiswa |
| UC-013 | Melihat Riwayat Presensi | Mahasiswa |
| UC-014 | Melihat Laporan Presensi | Admin, Dosen |
| UC-015 | Mengelola Profil | Semua |

---

# UC-001 Login

## Actor

- Administrator
- Dosen
- Mahasiswa

## Tujuan

Masuk ke sistem sesuai hak akses.

## Preconditions

- Akun telah terdaftar.
- Akun aktif.

## Main Flow

1. Pengguna membuka halaman login.
2. Memasukkan email.
3. Memasukkan password.
4. Sistem melakukan validasi.
5. Sistem membuat session.
6. Dashboard sesuai role ditampilkan.

## Alternative Flow

### AF-1

Email atau password salah.

→ Sistem menampilkan pesan kesalahan.

---

### AF-2

Akun tidak aktif.

→ Login ditolak.

---

## Postconditions

Session aktif.

---

# UC-002 Logout

## Actor

Semua pengguna.

## Main Flow

1. Klik Logout.
2. Session dihapus.
3. Kembali ke Landing Page.

---

# UC-003 Dashboard

## Actor

Semua pengguna.

## Main Flow

1. Login berhasil.
2. Sistem menampilkan dashboard sesuai role.
3. Pengguna memilih menu.

---

# UC-004 Kelola Mahasiswa

## Actor

Administrator

## Tujuan

Mengelola data mahasiswa.

## Main Flow

1. Membuka menu Mahasiswa.
2. Sistem menampilkan daftar mahasiswa.
3. Admin dapat:
   - Tambah
   - Detail
   - Edit
   - Hapus
4. Sistem memvalidasi data.
5. Data disimpan.

## Alternative Flow

NIM sudah digunakan.

→ Penyimpanan dibatalkan.

---

## Postconditions

Data mahasiswa diperbarui.

---

# UC-005 Kelola Dosen

Flow sama seperti UC-004 namun objeknya adalah data dosen.

---

# UC-006 Kelola Mata Kuliah

Flow sama seperti CRUD Mahasiswa.

Validasi:

- Kode Mata Kuliah harus unik.

---

# UC-007 Kelola Kelas

Flow CRUD.

Validasi:

Nama kelas harus unik.

---

# UC-008 Kelola Jadwal

## Actor

Administrator

## Main Flow

1. Membuka menu Jadwal.
2. Klik Tambah.
3. Memilih:
   - Mata Kuliah
   - Dosen
   - Kelas
   - Hari
   - Jam Mulai
   - Jam Selesai
   - Ruangan
4. Sistem memvalidasi bentrok jadwal.
5. Jadwal disimpan.

---

## Alternative Flow

Terjadi bentrok jadwal.

→ Sistem menolak penyimpanan.

---

# UC-009 Membuka Sesi Presensi

## Actor

Dosen

## Preconditions

- Jadwal tersedia.
- Waktu sesuai jadwal.

## Main Flow

1. Membuka menu Jadwal.
2. Memilih jadwal hari ini.
3. Klik **Buka Presensi**.
4. Sistem membuat sesi presensi.
5. Status menjadi **Aktif**.

---

## Postconditions

Mahasiswa dapat melakukan presensi.

---

# UC-010 Menampilkan QR Presensi

## Actor

Dosen

## Preconditions

Sesi presensi aktif.

## Main Flow

1. Klik **Tampilkan QR**.
2. Sistem membuat token unik.
3. QR Code ditampilkan.
4. QR siap dipindai mahasiswa.

---

# UC-011 Presensi Manual

## Actor

Dosen

## Main Flow

1. Membuka daftar mahasiswa.
2. Memilih status.
3. Klik Simpan.

---

## Status

- Hadir
- Terlambat
- Izin
- Sakit
- Alpha

---

# UC-012 Melakukan Presensi

## Actor

Mahasiswa

## Preconditions

- Login.
- Memiliki jadwal aktif.
- Sesi masih aktif.

## Main Flow

1. Membuka menu Presensi.
2. Mengaktifkan kamera.
3. Scan QR.
4. Sistem memvalidasi token.
5. Sistem menyimpan data presensi.
6. Sistem menampilkan notifikasi berhasil.

---

## Alternative Flow

QR tidak valid.

↓

Pesan kesalahan.

---

QR kedaluwarsa.

↓

Presensi ditolak.

---

Mahasiswa sudah presensi.

↓

Sistem menampilkan informasi bahwa presensi sudah tercatat.

---

## Postconditions

Data presensi tersimpan.

---

# UC-013 Melihat Riwayat Presensi

## Actor

Mahasiswa

## Main Flow

1. Membuka menu Riwayat Presensi.
2. Sistem menampilkan:
   - Mata Kuliah
   - Tanggal
   - Status
   - Jam Presensi

---

# UC-014 Melihat Laporan Presensi

## Actor

Administrator

Dosen

## Main Flow

1. Membuka menu Laporan.
2. Memilih filter:
   - Mata Kuliah
   - Kelas
   - Rentang Tanggal
3. Sistem menghasilkan laporan.

---

# UC-015 Mengelola Profil

## Actor

Semua pengguna

## Main Flow

1. Membuka halaman Profil.
2. Mengubah informasi akun.
3. Klik Simpan.
4. Sistem memperbarui data.

---

# 4. Traceability Matrix

| Functional Requirement | Use Case |
|------------------------|----------|
| FR-001 | UC-001 |
| FR-002 | UC-002 |
| FR-003 | UC-003 |
| FR-007 | UC-004 |
| FR-008 | UC-005 |
| FR-009 | UC-006 |
| FR-010 | UC-007 |
| FR-011 | UC-008 |
| FR-012 | UC-009 |
| FR-013 | UC-010 |
| FR-014 | UC-012 |
| FR-015 | UC-011 |
| FR-016 | UC-013 |
| FR-017 | UC-014 |