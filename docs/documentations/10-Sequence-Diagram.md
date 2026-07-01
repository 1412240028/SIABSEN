# Sequence Diagram

> **Project Name:** SIABSEN (Sistem Informasi Presensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Overview

Sequence Diagram menggambarkan urutan komunikasi antar aktor dan komponen sistem dalam menjalankan suatu proses.

Diagram ini digunakan untuk memahami bagaimana request diproses mulai dari pengguna hingga database dan kembali ke pengguna.

---

# 2. Login

## Participants

- User
- Login Page
- Auth Controller
- Database

---

```text
User
 │
 │ Buka Login
 ▼
Login Page
 │
 │ Input Email & Password
 ▼
Auth Controller
 │
 │ Validasi
 ▼
Database
 │
 │ Cari User
 ▲
 │
Auth Controller
 │
 ├──────────────┐
 │              │
 ▼              ▼
Dashboard    Login Gagal
```

---

# 3. CRUD Mahasiswa

## Participants

- Administrator
- Mahasiswa Page
- Mahasiswa Controller
- Database

---

```text
Admin
 │
 ▼
Mahasiswa Page
 │
 │ Tambah/Edit/Hapus
 ▼
Mahasiswa Controller
 │
 │ Validasi
 ▼
Database
 │
 │ Insert / Update / Delete
 ▲
 │
Mahasiswa Controller
 │
 ▼
Mahasiswa Page
 │
 ▼
Notifikasi Berhasil
```

---

# 4. Membuka Sesi Presensi

## Participants

- Dosen
- Jadwal Page
- Presensi Controller
- Database

---

```text
Dosen
 │
 ▼
Jadwal
 │
 │ Klik Buka Presensi
 ▼
Presensi Controller
 │
 │ Membuat Sesi
 ▼
Database
 │
 │ Simpan Sesi
 ▲
 │
Presensi Controller
 │
 │ Generate Token
 │
 │ Generate QR
 ▼
Jadwal Page
 │
 ▼
QR Ditampilkan
```

---

# 5. Presensi Mahasiswa

## Participants

- Mahasiswa
- Presensi Page
- Presensi Controller
- Database

---

```text
Mahasiswa
 │
 ▼
Presensi
 │
 │ Scan QR
 ▼
Presensi Controller
 │
 │ Validasi Token
 ▼
Database
 │
 │ Cari Sesi
 ▲
 │
Presensi Controller
 │
 │ Cek Sudah Presensi?
 ▼
Database
 │
 ├─────────────┐
 │             │
 ▼             ▼
Belum       Sudah
 │             │
 ▼             ▼
Insert     Kirim Error
 │
 ▼
Database
 │
 ▼
Notifikasi Berhasil
```

---

# 6. Presensi Manual

## Participants

- Dosen
- Presensi Page
- Presensi Controller
- Database

---

```text
Dosen
 │
 ▼
Presensi Manual
 │
 │ Pilih Mahasiswa
 ▼
Presensi Controller
 │
 │ Simpan Status
 ▼
Database
 │
 ▼
Berhasil
```

---

# 7. Laporan Presensi

## Participants

- Admin / Dosen
- Laporan Page
- Laporan Controller
- Database

---

```text
User
 │
 ▼
Laporan
 │
 │ Pilih Filter
 ▼
Laporan Controller
 │
 │ Query
 ▼
Database
 │
 │ Data Rekap
 ▲
 │
Laporan Controller
 │
 ▼
Laporan Page
```

---

# 8. Logout

## Participants

- User
- Auth Controller

---

```text
User
 │
 ▼
Klik Logout
 │
 ▼
Auth Controller
 │
 │ Destroy Session
 ▼
Landing Page
```

---

# 9. Sequence Summary

| Sequence | Actor | Controller | Database |
|----------|-------|------------|----------|
| Login | User | AuthController | Users |
| CRUD Mahasiswa | Admin | MahasiswaController | Mahasiswa |
| CRUD Dosen | Admin | DosenController | Dosen |
| CRUD Mata Kuliah | Admin | MataKuliahController | Mata Kuliah |
| CRUD Kelas | Admin | KelasController | Kelas |
| CRUD Jadwal | Admin | JadwalController | Jadwal |
| Buka Presensi | Dosen | PresensiController | Sesi Presensi |
| Scan QR | Mahasiswa | PresensiController | Presensi |
| Laporan | Admin/Dosen | LaporanController | Presensi |
| Logout | User | AuthController | Session |

---

# 10. Design Notes

- Seluruh request menggunakan autentikasi Laravel Breeze.
- Validasi data dilakukan sebelum proses penyimpanan.
- Setiap proses CRUD memberikan respons sukses atau gagal kepada pengguna.
- Hak akses setiap controller dibatasi menggunakan middleware sesuai role pengguna.