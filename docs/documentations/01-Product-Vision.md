# Product Vision

> **Project Name:** SIABSEN (Sistem Informasi Absensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Vision Statement

Mewujudkan sistem presensi mahasiswa berbasis web yang modern, efisien, dan mudah digunakan untuk membantu proses pencatatan kehadiran mahasiswa secara digital di lingkungan Universitas PGRI Ronggolawe (UNIROW).

---

# 2. Product Vision Board

## Target Users

SIABSEN ditujukan untuk seluruh civitas akademika yang terlibat dalam proses presensi perkuliahan.

### Administrator

Bertanggung jawab mengelola seluruh data master dan memonitor aktivitas presensi.

### Dosen

Melaksanakan proses presensi mahasiswa pada setiap sesi perkuliahan.

### Mahasiswa

Melakukan presensi secara mandiri menggunakan QR Code serta memantau riwayat kehadiran.

---

## User Needs

### Administrator

- Mengelola data dengan mudah.
- Memiliki dashboard monitoring.
- Melihat laporan presensi.

### Dosen

- Membuka sesi presensi dengan cepat.
- Menghasilkan QR Code secara otomatis.
- Mengelola presensi manual apabila diperlukan.

### Mahasiswa

- Melakukan presensi secara cepat.
- Melihat riwayat presensi.
- Mengetahui persentase kehadiran.

---

## Product

SIABSEN merupakan aplikasi web yang menyediakan proses presensi digital menggunakan QR Code dan pencatatan manual sebagai alternatif apabila terjadi kendala teknis.

---

## Business Value

Implementasi SIABSEN memberikan manfaat berupa:

- Mengurangi proses presensi manual.
- Mempercepat proses pencatatan kehadiran.
- Meningkatkan akurasi data presensi.
- Mempermudah rekapitulasi kehadiran.
- Menyediakan data presensi yang terdokumentasi dengan baik.

---

# 3. Vision Goals

## Goal 1

Menyederhanakan proses presensi di kelas.

### Success Indicator

Waktu presensi menjadi lebih singkat dibanding metode manual.

---

## Goal 2

Menyediakan data presensi yang akurat.

### Success Indicator

Seluruh data presensi tersimpan secara otomatis pada database.

---

## Goal 3

Mempermudah monitoring kehadiran.

### Success Indicator

Dosen dan administrator dapat melihat laporan presensi kapan saja.

---

## Goal 4

Meningkatkan pengalaman pengguna.

### Success Indicator

Sistem mudah dipahami oleh administrator, dosen, maupun mahasiswa tanpa memerlukan pelatihan khusus.

---

# 4. Design Principles

Pengembangan SIABSEN mengikuti prinsip berikut.

## Simplicity

Fitur yang dikembangkan hanya berhubungan dengan proses presensi.

---

## Consistency

Antarmuka dan navigasi dibuat konsisten pada seluruh halaman.

---

## Efficiency

Setiap proses dibuat sesingkat mungkin agar pengguna dapat menyelesaikan tugas dengan cepat.

---

## Accessibility

Sistem dapat diakses menggunakan browser modern tanpa instalasi aplikasi tambahan.

---

## Reliability

Data presensi harus tersimpan secara aman dan konsisten.

---

# 5. Product Scope

## Included

- Authentication
- Dashboard
- Data Mahasiswa
- Data Dosen
- Data Mata Kuliah
- Data Kelas
- Data Jadwal
- Sesi Presensi
- QR Code Presensi
- Presensi Manual
- Riwayat Presensi
- Rekap Presensi
- Profil Pengguna

---

## Excluded

Fitur berikut tidak termasuk dalam pengembangan versi 1.0.

- Sistem Penilaian
- KRS
- Transkrip Nilai
- Sistem Pembayaran
- Sistem Akademik Lengkap
- Mobile Application
- Face Recognition
- Fingerprint
- RFID

---

# 6. Product Success Metrics

| Metric | Target |
|---------|--------|
| Login berhasil | ≥99% |
| Waktu membuka dashboard | <2 detik |
| Waktu membuat sesi presensi | <5 detik |
| Waktu scan QR Code | <3 detik |
| Akurasi pencatatan presensi | 100% |
| Sistem dapat berjalan di shared hosting | Ya |

---

# 7. Constraints

Pengembangan dilakukan dengan batasan berikut.

- Framework Laravel.
- Database MySQL.
- Antarmuka berbasis Blade.
- Menggunakan Bootstrap 5.
- Dikerjakan sebagai proyek UAS Mata Kuliah Pemrograman Web.
- Deployment menggunakan shared hosting dan domain publik.

---

# 8. Future Vision

Pada versi berikutnya, SIABSEN dapat dikembangkan menjadi sistem yang lebih lengkap melalui penambahan fitur seperti:

- Export PDF dan Excel.
- Notifikasi Email.
- Notifikasi WhatsApp.
- Progressive Web App (PWA).
- REST API.
- Integrasi dengan Sistem Akademik (SIAKAD).