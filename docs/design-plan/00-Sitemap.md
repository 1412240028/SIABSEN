# Sitemap

> **Project Name:** SIABSEN (Sistem Informasi Presensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Final Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Overview

Sitemap menggambarkan struktur halaman (pages) pada aplikasi SIABSEN berdasarkan hak akses pengguna. Dokumen ini menjadi acuan dalam perancangan navigasi, routing Laravel, dan antarmuka pengguna.

---

# 2. User Roles

SIABSEN memiliki tiga jenis pengguna:

- Administrator
- Dosen
- Mahasiswa

Masing-masing role memiliki halaman dan fitur yang berbeda sesuai hak aksesnya.

---

# 3. Public Pages

```text
Landing Page
│
├── Login
├── Tentang SIABSEN
└── Kontak
```

### Deskripsi

| Halaman | Fungsi |
|----------|--------|
| Landing Page | Halaman utama aplikasi |
| Login | Autentikasi pengguna |
| Tentang | Informasi mengenai SIABSEN |
| Kontak | Informasi kontak administrator |

---

# 4. Administrator Sitemap

```text
Dashboard
│
├── Dashboard
│
├── Master Data
│   ├── Users
│   ├── Mahasiswa
│   ├── Dosen
│   ├── Kelas
│   └── Mata Kuliah
│
├── Akademik
│   └── Jadwal
│
├── Laporan
│   ├── Rekap Presensi
│   ├── Export PDF
│   └── Export Excel
│
├── Profil
│   ├── Profil Saya
│   ├── Ubah Password
│   └── Logout
```

---

# 5. Dosen Sitemap

```text
Dashboard
│
├── Dashboard
│
├── Jadwal Mengajar
│
├── Sesi Presensi
│   ├── Buka Sesi
│   ├── QR Code
│   ├── Presensi Manual
│   ├── Daftar Kehadiran
│   └── Tutup Sesi
│
├── Laporan
│   └── Rekap Presensi
│
├── Profil
│   ├── Profil Saya
│   ├── Ubah Password
│   └── Logout
```

---

# 6. Mahasiswa Sitemap

```text
Dashboard
│
├── Dashboard
│
├── Presensi
│   ├── Scan QR Code
│   └── Status Presensi
│
├── Riwayat Presensi
│
├── Jadwal Kuliah
│
├── Profil
│   ├── Profil Saya
│   ├── Ubah Password
│   └── Logout
```

---

# 7. Navigation Structure

```text
Public
│
├── Login
│
└── Dashboard
    │
    ├── Administrator
    │   ├── Master Data
    │   ├── Akademik
    │   ├── Laporan
    │   └── Profil
    │
    ├── Dosen
    │   ├── Jadwal Mengajar
    │   ├── Sesi Presensi
    │   ├── Laporan
    │   └── Profil
    │
    └── Mahasiswa
        ├── Presensi
        ├── Riwayat Presensi
        ├── Jadwal Kuliah
        └── Profil
```

---

# 8. Sidebar Menu

## Administrator

```text
🏠 Dashboard

📁 Master Data
   ├── Users
   ├── Mahasiswa
   ├── Dosen
   ├── Kelas
   └── Mata Kuliah

📅 Jadwal

📊 Laporan

👤 Profil

🚪 Logout
```

---

## Dosen

```text
🏠 Dashboard

📅 Jadwal Mengajar

🟢 Sesi Presensi

📊 Laporan

👤 Profil

🚪 Logout
```

---

## Mahasiswa

```text
🏠 Dashboard

📲 Presensi

📅 Jadwal Kuliah

📖 Riwayat Presensi

👤 Profil

🚪 Logout
```

---

# 9. Route Group (Laravel)

```text
/

├── login

├── dashboard

├── admin
│   ├── users
│   ├── mahasiswa
│   ├── dosen
│   ├── kelas
│   ├── mata-kuliah
│   ├── jadwal
│   └── laporan
│
├── dosen
│   ├── jadwal
│   ├── sesi-presensi
│   └── laporan
│
└── mahasiswa
    ├── presensi
    ├── jadwal
    ├── riwayat
    └── profil
```

---

# 10. Conclusion

Struktur navigasi SIABSEN dirancang berdasarkan role pengguna sehingga setiap aktor hanya dapat mengakses halaman yang sesuai dengan hak aksesnya. Sitemap ini menjadi acuan dalam pembuatan wireframe, routing Laravel, middleware, dan implementasi antarmuka aplikasi.