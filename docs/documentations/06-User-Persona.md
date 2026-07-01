# User Persona

> **Project Name:** SIABSEN (Sistem Informasi Presensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Overview

Dokumen ini mendefinisikan karakteristik pengguna utama SIABSEN. User Persona digunakan sebagai acuan dalam merancang alur kerja, antarmuka, dan pengalaman pengguna agar sesuai dengan kebutuhan masing-masing role.

---

# 2. User Persona

---

# Persona 1 — Administrator

## Profile

| Atribut | Keterangan |
|----------|------------|
| Nama | Budi Santoso |
| Usia | 35 Tahun |
| Jabatan | Administrator Akademik |
| Instansi | Universitas PGRI Ronggolawe |
| Pengalaman | 8 Tahun |

---

## Background

Administrator bertanggung jawab mengelola seluruh data yang diperlukan agar proses presensi dapat berjalan dengan baik. Aktivitas utama dilakukan melalui komputer kantor.

---

## Goals

- Mengelola data mahasiswa dengan cepat.
- Mengelola data dosen.
- Mengatur jadwal perkuliahan.
- Memastikan data selalu valid.
- Melihat rekap presensi.

---

## Pain Points

- Terlalu banyak data yang harus dikelola.
- Kesalahan input menyebabkan jadwal tidak valid.
- Sulit mencari data jika jumlahnya banyak.

---

## Needs

- Dashboard yang informatif.
- Form input yang sederhana.
- Pencarian data yang cepat.
- Validasi data otomatis.

---

## Devices

- Desktop
- Laptop

---

## Digital Skills

★★★★★ (Sangat Baik)

---

# Persona 2 — Dosen

## Profile

| Atribut | Keterangan |
|----------|------------|
| Nama | Siti Rahmawati |
| Usia | 42 Tahun |
| Jabatan | Dosen |
| Instansi | Universitas PGRI Ronggolawe |
| Pengalaman | 15 Tahun |

---

## Background

Dosen menggunakan SIABSEN untuk membuka sesi presensi, menampilkan QR Code, serta memantau kehadiran mahasiswa selama proses perkuliahan berlangsung.

---

## Goals

- Membuka presensi dengan cepat.
- Menampilkan QR Code.
- Mengelola presensi manual jika diperlukan.
- Melihat rekap kehadiran mahasiswa.

---

## Pain Points

- Presensi manual memakan waktu.
- Sulit merekap kehadiran setiap pertemuan.
- Kesalahan pencatatan presensi.

---

## Needs

- Proses membuka presensi yang sederhana.
- QR Code yang langsung siap digunakan.
- Rekap kehadiran otomatis.

---

## Devices

- Laptop
- Proyektor

---

## Digital Skills

★★★★☆ (Baik)

---

# Persona 3 — Mahasiswa

## Profile

| Atribut | Keterangan |
|----------|------------|
| Nama | Andi Prasetyo |
| Usia | 20 Tahun |
| Status | Mahasiswa |
| Universitas | Universitas PGRI Ronggolawe |
| Semester | 4 |

---

## Background

Mahasiswa menggunakan SIABSEN untuk melakukan presensi dengan memindai QR Code yang ditampilkan dosen serta melihat riwayat kehadiran.

---

## Goals

- Presensi berlangsung cepat.
- Tidak perlu tanda tangan manual.
- Melihat riwayat kehadiran.
- Mengetahui persentase kehadiran.

---

## Pain Points

- Lupa apakah sudah melakukan presensi.
- Sulit mengetahui jumlah kehadiran.
- Takut presensi tidak tercatat.

---

## Needs

- Scan QR yang cepat.
- Konfirmasi presensi berhasil.
- Riwayat presensi yang mudah diakses.

---

## Devices

- Smartphone Android
- Smartphone iPhone

---

## Digital Skills

★★★★★ (Sangat Baik)

---

# 3. Persona Comparison

| Aspek | Administrator | Dosen | Mahasiswa |
|--------|--------------|--------|-----------|
| Perangkat Utama | Desktop/Laptop | Laptop | Smartphone |
| Frekuensi Penggunaan | Tinggi | Sedang | Tinggi |
| Fokus | Kelola Data | Kelola Presensi | Melakukan Presensi |
| Menu Utama | Master Data | Sesi Presensi | Scan QR |
| Kebutuhan Utama | Data Akurat | Presensi Cepat | Presensi Mudah |

---

# 4. Design Implications

## Administrator

- Dashboard dengan statistik.
- Tabel data lengkap.
- Fitur pencarian, filter, dan pagination.

---

## Dosen

- Tombol **Buka Presensi** mudah ditemukan.
- QR Code tampil besar dan jelas.
- Rekap presensi mudah diakses.

---

## Mahasiswa

- Tampilan mobile-first.
- Scan QR dalam satu langkah.
- Status presensi langsung ditampilkan setelah berhasil.

---

# 5. User Journey Summary

## Administrator

Login → Dashboard → Kelola Data → Kelola Jadwal → Logout

---

## Dosen

Login → Dashboard → Pilih Jadwal → Buka Sesi → Tampilkan QR → Tutup Sesi → Logout

---

## Mahasiswa

Login → Dashboard → Scan QR → Presensi Berhasil → Lihat Riwayat → Logout

---

# 6. Conclusion

SIABSEN dirancang untuk memenuhi kebutuhan tiga kelompok pengguna utama dengan karakteristik yang berbeda. Administrator berfokus pada pengelolaan data, dosen berfokus pada proses presensi, sedangkan mahasiswa berfokus pada kemudahan melakukan presensi dan memantau kehadiran.