# Wireframe Low Fidelity

> **Project Name:** SIABSEN (Sistem Informasi Presensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Final Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Overview

Dokumen Wireframe Low Fidelity mendeskripsikan rancangan awal tata letak (layout) antarmuka pengguna SIABSEN tanpa memperhatikan elemen visual seperti warna, ikon, maupun tipografi.

Wireframe berfungsi sebagai acuan dalam proses perancangan UI/UX sebelum memasuki tahap High Fidelity Design dan implementasi menggunakan Laravel.

---

# 2. Design Principles

Perancangan wireframe SIABSEN mengikuti prinsip berikut:

- Sederhana dan mudah dipahami.
- Konsisten pada setiap halaman.
- Meminimalkan jumlah klik pengguna.
- Responsif untuk desktop dan perangkat mobile.
- Mengutamakan pengalaman pengguna (User Experience).

---

# 3. Global Layout

Seluruh halaman dashboard menggunakan struktur layout yang sama.

```text
+--------------------------------------------------------------------------------------+
|                                     TOP NAVBAR                                       |
| Logo SIABSEN                               Search                     Avatar Profile  |
+----------------------+---------------------------------------------------------------+
|                      |                                                               |
|                      |                                                               |
|                      |                                                               |
|      SIDEBAR         |                         CONTENT AREA                          |
|                      |                                                               |
| Dashboard            |                                                               |
| Master Data          |                                                               |
| Jadwal               |                                                               |
| Laporan              |                                                               |
| Profil               |                                                               |
| Logout               |                                                               |
|                      |                                                               |
+----------------------+---------------------------------------------------------------+
```

---

# 4. Public Pages

## 4.1 Landing Page

```text
+-------------------------------------------------------------+
| Logo SIABSEN                                Login Button    |
+-------------------------------------------------------------+

           Sistem Informasi Presensi Mahasiswa

      [ Ilustrasi ]

      Presensi Mahasiswa Berbasis QR Code

               [ Masuk ke Sistem ]
```

Komponen:

- Logo
- Judul aplikasi
- Deskripsi singkat
- Ilustrasi
- Tombol Login

---

## 4.2 Login

```text
+--------------------------------------+
|              LOGIN                   |
|--------------------------------------|
| Email                                |
| [___________________________]         |
|                                      |
| Password                             |
| [___________________________]         |
|                                      |
| [ ] Remember Me                      |
|                                      |
|        [ Login ]                     |
+--------------------------------------+
```

---

# 5. Administrator Pages

## 5.1 Dashboard

```text
+--------------------------------------------------------------+
| Dashboard Admin                                               |
+--------------------------------------------------------------+

+------------+ +------------+ +------------+ +------------+
| Mahasiswa  | | Dosen      | | Jadwal     | | Presensi   |
+------------+ +------------+ +------------+ +------------+

--------------------------------------------------------------

Grafik Presensi

--------------------------------------------------------------

Aktivitas Terbaru
```

---

## 5.2 Mahasiswa

```text
+--------------------------------------------------------------+
| Mahasiswa                                    [+ Tambah]      |
+--------------------------------------------------------------+

Search _______________________

--------------------------------------------------------------

| NIM | Nama | Kelas | Status | Aksi |

--------------------------------------------------------------
```

---

## 5.3 Form Mahasiswa

```text
Nama

[________________________]

NIM

[________________________]

Kelas

[ Dropdown ]

Jenis Kelamin

( ) Laki-laki
( ) Perempuan

No HP

[________________________]

Alamat

[________________________]

[ Simpan ]
```

---

## 5.4 Dosen

Layout sama seperti halaman Mahasiswa.

---

## 5.5 Kelas

```text
Nama Kelas

[___________]

Angkatan

[___________]

Kapasitas

[___________]

Status

[ Aktif ]

[ Simpan ]
```

---

## 5.6 Mata Kuliah

```text
Kode MK

[__________]

Nama Mata Kuliah

[___________________]

SKS

[__]

Status

[ Aktif ]

[ Simpan ]
```

---

## 5.7 Jadwal

```text
Dosen

[ Dropdown ]

Mata Kuliah

[ Dropdown ]

Kelas

[ Dropdown ]

Hari

[ Dropdown ]

Jam Mulai

[ Time ]

Jam Selesai

[ Time ]

Ruangan

[__________]

[ Simpan ]
```

---

## 5.8 Laporan

```text
Filter

Semester

[ Dropdown ]

Kelas

[ Dropdown ]

Mata Kuliah

[ Dropdown ]

Rentang Tanggal

[ Date ]

-------------------------------------------------------

| Rekap Presensi |

-------------------------------------------------------

[ Export PDF ]

[ Export Excel ]
```

---

# 6. Dosen Pages

## 6.1 Dashboard

```text
+--------------------------------------------------------------+

Jadwal Hari Ini

--------------------------------------------------------------

Sesi Presensi Aktif

--------------------------------------------------------------

Riwayat Presensi
```

---

## 6.2 Jadwal Mengajar

```text
-------------------------------------------------------------

| Mata Kuliah | Kelas | Hari | Jam | Aksi |

-------------------------------------------------------------

                [ Detail ]
```

---

## 6.3 Detail Jadwal

```text
Mata Kuliah

Kelas

Hari

Jam

Ruangan

----------------------------------------

[ Buka Sesi Presensi ]
```

---

## 6.4 Sesi Presensi

```text
Pertemuan ke

[ 8 ]

-------------------------------------

QR CODE

████████████████

-------------------------------------

TOKEN

482913

-------------------------------------

[ Tutup Presensi ]
```

---

## 6.5 Daftar Kehadiran

```text
-------------------------------------------------------

| NIM | Nama | Status | Waktu |

-------------------------------------------------------
```

---

# 7. Mahasiswa Pages

## 7.1 Dashboard

```text
Jadwal Hari Ini

-------------------------------------

Status Presensi Hari Ini

-------------------------------------

Persentase Kehadiran
```

---

## 7.2 Jadwal Kuliah

```text
-------------------------------------------------------

| Mata Kuliah | Hari | Jam | Ruangan |

-------------------------------------------------------
```

---

## 7.3 Scan QR

```text
+------------------------------------+

Kamera

██████████████████████████████

--------------------------------------

Arahkan kamera ke QR Code

--------------------------------------
```

---

## 7.4 Input Token

```text
Masukkan Token

[______]

[ Validasi ]
```

---

## 7.5 Presensi Berhasil

```text
✔

Presensi Berhasil

Mata Kuliah

Pemrograman Web

08.15 WIB

Status

Hadir
```

---

## 7.6 Riwayat Presensi

```text
------------------------------------------------------

| Mata Kuliah | Tanggal | Status |

------------------------------------------------------
```

---

## 7.7 Profil

```text
Foto Profil

Nama

Email

No HP

Password

[ Simpan ]
```

---

# 8. Responsive Layout

## Desktop

- Sidebar tetap di sisi kiri.
- Navbar berada di bagian atas.
- Content menggunakan lebar maksimal.

## Tablet

- Sidebar dapat diperkecil (collapsed).
- Card menyesuaikan menjadi dua kolom.

## Mobile

- Sidebar berubah menjadi hamburger menu.
- Semua card menjadi satu kolom.
- Form menggunakan lebar penuh.

---

# 9. Navigation Flow

```text
Landing Page
      │
      ▼
Login
      │
      ▼
Dashboard
      │
      ├── Master Data
      ├── Jadwal
      ├── Presensi
      ├── Laporan
      └── Profil
```

---

# 10. Notes

Wireframe ini hanya menggambarkan struktur tata letak halaman dan alur navigasi. Seluruh elemen visual seperti warna, ikon, tipografi, ilustrasi, dan identitas merek akan ditentukan pada dokumen **Design System** dan **High Fidelity Mockup**.

---

# 11. Conclusion

Wireframe Low Fidelity SIABSEN menjadi acuan awal dalam perancangan antarmuka pengguna dengan menitikberatkan pada struktur halaman, penempatan komponen, serta alur interaksi pengguna. Dokumen ini memastikan proses desain visual dan implementasi sistem dapat dilakukan secara konsisten, efisien, dan sesuai kebutuhan pengguna.