# Activity Diagram

> **Project Name:** SIABSEN (Sistem Informasi Presensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Overview

Activity Diagram menggambarkan alur aktivitas pada setiap proses utama di dalam SIABSEN.

Diagram ini digunakan untuk memahami proses bisnis sebelum dilakukan implementasi sistem.

---

# 2. Login

```text
Start
  │
  ▼
Buka Halaman Login
  │
  ▼
Input Email & Password
  │
  ▼
Validasi
  │
 ┌───────────────┐
 │               │
 ▼               ▼
Valid         Tidak Valid
 │               │
 ▼               ▼
Dashboard     Pesan Error
 │
 ▼
End
```

---

# 3. CRUD Mahasiswa

```text
Start
 │
 ▼
Pilih Menu Mahasiswa
 │
 ▼
Tampilkan Data
 │
 ▼
Pilih Aksi
 │
 ├────────────┬──────────────┬───────────────┐
 ▼            ▼              ▼               ▼
Tambah      Detail         Edit           Hapus
 │            │              │               │
 ▼            ▼              ▼               ▼
Validasi     Tampil        Validasi      Konfirmasi
 │                           │               │
 ▼                           ▼               ▼
Simpan                     Update         Delete
 │                           │               │
 └──────────────┬────────────┴───────────────┘
                ▼
              End
```

---

# 4. Membuka Sesi Presensi

```text
Start
 │
 ▼
Login Dosen
 │
 ▼
Dashboard
 │
 ▼
Pilih Jadwal
 │
 ▼
Klik "Buka Presensi"
 │
 ▼
Buat Sesi Presensi
 │
 ▼
Generate Token
 │
 ▼
Generate QR Code
 │
 ▼
QR Ditampilkan
 │
 ▼
End
```

---

# 5. Presensi Mahasiswa

```text
Start
 │
 ▼
Login
 │
 ▼
Menu Presensi
 │
 ▼
Aktifkan Kamera
 │
 ▼
Scan QR
 │
 ▼
Validasi QR
 │
 ┌──────────────┐
 │              │
 ▼              ▼
Valid        Tidak Valid
 │              │
 ▼              ▼
Cek Presensi  Pesan Error
 │
 ┌──────────────┐
 │              │
 ▼              ▼
Belum      Sudah Presensi
 │              │
 ▼              ▼
Simpan Data  Notifikasi
 │
 ▼
Berhasil
 │
 ▼
End
```

---

# 6. Presensi Manual

```text
Start
 │
 ▼
Login Dosen
 │
 ▼
Pilih Jadwal
 │
 ▼
Daftar Mahasiswa
 │
 ▼
Pilih Status
 │
 ▼
Simpan
 │
 ▼
End
```

---

# 7. Laporan

```text
Start
 │
 ▼
Pilih Menu Laporan
 │
 ▼
Pilih Filter
 │
 ▼
Generate Rekap
 │
 ▼
Tampilkan Hasil
 │
 ▼
End
```

---

# 8. Logout

```text
Start
 │
 ▼
Klik Logout
 │
 ▼
Hapus Session
 │
 ▼
Landing Page
 │
 ▼
End
```