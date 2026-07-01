# Entity Relationship Diagram (ERD)

> **Project Name:** SIABSEN (Sistem Informasi Presensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Final Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Overview

Dokumen Entity Relationship Diagram (ERD) mendefinisikan struktur basis data SIABSEN beserta hubungan antar entitas yang digunakan dalam sistem.

ERD menjadi dasar dalam proses:

- Perancangan database
- Pembuatan Laravel Migration
- Pembuatan Eloquent Model
- Implementasi Relationship
- Penyusunan Query
- Pengembangan fitur aplikasi

---

# 2. Scope

ERD SIABSEN dirancang untuk mendukung proses bisnis presensi mahasiswa di lingkungan Universitas PGRI Ronggolawe.

Versi 1.0 mencakup:

- Autentikasi pengguna
- Pengelolaan data master
- Pengelolaan jadwal kuliah
- Pembukaan sesi presensi
- Presensi menggunakan QR Code
- Presensi manual oleh dosen
- Rekap data presensi

Versi ini tidak mencakup:

- Sistem KRS
- Program Studi
- Fakultas
- Nilai
- Materi Perkuliahan
- Jadwal Ujian

---

# 3. Entities

## 3.1 Users

Digunakan sebagai autentikasi seluruh pengguna sistem.

Role yang tersedia:

- Administrator
- Dosen
- Mahasiswa

---

## 3.2 Mahasiswa

Menyimpan identitas mahasiswa yang melakukan presensi.

---

## 3.3 Dosen

Menyimpan identitas dosen yang mengajar mata kuliah.

---

## 3.4 Mata Kuliah

Menyimpan informasi mata kuliah yang tersedia.

---

## 3.5 Kelas

Menyimpan data kelas mahasiswa.

Contoh:

- TI-2A
- TI-2B
- TI-3A

---

## 3.6 Jadwal

Menghubungkan:

- Mata Kuliah
- Dosen
- Kelas

Serta menyimpan informasi:

- Hari
- Jam
- Semester
- Tahun Ajaran
- Ruangan

---

## 3.7 Sesi Presensi

Merepresentasikan setiap kegiatan presensi pada suatu jadwal.

Setiap sesi memiliki:

- Nomor pertemuan
- Token QR
- Tanggal
- Status sesi

---

## 3.8 Presensi

Menyimpan data kehadiran mahasiswa pada setiap sesi presensi.

---

# 4. Entity Relationship Diagram

```text
                     USERS
                       │
          ┌────────────┴────────────┐
          │                         │
          ▼                         ▼
     MAHASISWA                  DOSEN
          │                         │
          │                         │
          ▼                         ▼
        KELAS -----------------> JADWAL <---------------- MATA_KULIAH
                                    │
                                    ▼
                            SESI_PRESENSI
                                    │
                                    ▼
                               PRESENSI
                                    ▲
                                    │
                               MAHASISWA
```

---

# 5. Cardinality

| Parent | Child | Cardinality |
|---------|-------|-------------|
| Users | Mahasiswa | 1 : 1 |
| Users | Dosen | 1 : 1 |
| Kelas | Mahasiswa | 1 : N |
| Dosen | Jadwal | 1 : N |
| Mata Kuliah | Jadwal | 1 : N |
| Kelas | Jadwal | 1 : N |
| Jadwal | Sesi Presensi | 1 : N |
| Sesi Presensi | Presensi | 1 : N |
| Mahasiswa | Presensi | 1 : N |

---

# 6. Relationship Description

## Users → Mahasiswa

Satu akun pengguna hanya dimiliki oleh satu mahasiswa.

Relationship:

One to One

---

## Users → Dosen

Satu akun pengguna hanya dimiliki oleh satu dosen.

Relationship:

One to One

---

## Kelas → Mahasiswa

Satu kelas dapat memiliki banyak mahasiswa.

Relationship:

One to Many

---

## Dosen → Jadwal

Satu dosen dapat mengajar lebih dari satu jadwal.

Relationship:

One to Many

---

## Mata Kuliah → Jadwal

Satu mata kuliah dapat diajarkan pada banyak jadwal.

Relationship:

One to Many

---

## Kelas → Jadwal

Satu kelas memiliki banyak jadwal perkuliahan.

Relationship:

One to Many

---

## Jadwal → Sesi Presensi

Setiap jadwal dapat memiliki banyak sesi presensi.

Contoh:

- Pertemuan 1
- Pertemuan 2
- Pertemuan 3

Relationship:

One to Many

---

## Sesi Presensi → Presensi

Satu sesi presensi menghasilkan banyak data presensi mahasiswa.

Relationship:

One to Many

---

## Mahasiswa → Presensi

Seorang mahasiswa dapat memiliki banyak riwayat presensi.

Relationship:

One to Many

---

# 7. Database Normalization

Struktur basis data dirancang mengikuti prinsip normalisasi hingga Third Normal Form (3NF).

Tujuan normalisasi:

- Mengurangi redundansi data.
- Menjaga konsistensi data.
- Menghindari anomali Insert.
- Menghindari anomali Update.
- Menghindari anomali Delete.
- Mempermudah pemeliharaan database.

---

# 8. Primary Keys

| Entity | Primary Key | Type |
|----------|-------------|------|
| users | id | BIGINT |
| mahasiswa | id | BIGINT |
| dosen | id | BIGINT |
| kelas | id | BIGINT |
| mata_kuliah | id | BIGINT |
| jadwal | id | BIGINT |
| sesi_presensi | id | BIGINT |
| presensi | id | BIGINT |

---

# 9. Foreign Keys

| Table | Foreign Key | References |
|---------|------------|------------|
| mahasiswa | user_id | users.id |
| mahasiswa | kelas_id | kelas.id |
| dosen | user_id | users.id |
| jadwal | dosen_id | dosen.id |
| jadwal | kelas_id | kelas.id |
| jadwal | mata_kuliah_id | mata_kuliah.id |
| sesi_presensi | jadwal_id | jadwal.id |
| presensi | sesi_presensi_id | sesi_presensi.id |
| presensi | mahasiswa_id | mahasiswa.id |

---

# 10. Design Decisions

Untuk menjaga ruang lingkup proyek tetap sederhana namun tetap sesuai praktik pengembangan perangkat lunak, diterapkan keputusan desain berikut.

- Mahasiswa hanya memiliki satu kelas aktif.
- Semester dan tahun ajaran disimpan pada tabel Jadwal.
- Nomor pertemuan disimpan pada tabel Sesi Presensi melalui atribut `pertemuan_ke`.
- QR Code dihasilkan dari token unik setiap sesi presensi.
- Setiap sesi presensi hanya dapat memiliki satu QR Code aktif.
- Mahasiswa hanya dapat melakukan satu kali presensi pada setiap sesi.
- Presensi dapat dilakukan melalui QR Code maupun input manual oleh dosen.
- Sistem tidak menggunakan tabel Enrollment agar implementasi tetap sederhana dan sesuai ruang lingkup proyek UAS.

---

# 11. Future Improvements

Versi berikutnya dapat menambahkan fitur:

- Program Studi
- Fakultas
- Tahun Akademik
- Enrollment / KRS
- Master Ruangan
- Notifikasi Email
- Export PDF
- Export Excel
- REST API
- Mobile Application
- Integrasi Single Sign-On (SSO)

---

# 12. Laravel Eloquent Relationship

| Model | Relationship |
|---------|-------------|
| User | hasOne(Mahasiswa), hasOne(Dosen) |
| Mahasiswa | belongsTo(User), belongsTo(Kelas), hasMany(Presensi) |
| Dosen | belongsTo(User), hasMany(Jadwal) |
| Kelas | hasMany(Mahasiswa), hasMany(Jadwal) |
| MataKuliah | hasMany(Jadwal) |
| Jadwal | belongsTo(Dosen), belongsTo(Kelas), belongsTo(MataKuliah), hasMany(SesiPresensi) |
| SesiPresensi | belongsTo(Jadwal), hasMany(Presensi) |
| Presensi | belongsTo(SesiPresensi), belongsTo(Mahasiswa) |

---

# 13. Conclusion

ERD SIABSEN terdiri dari delapan entitas utama yang saling berhubungan untuk mendukung proses autentikasi, pengelolaan data master, pengelolaan jadwal perkuliahan, pembukaan sesi presensi, serta pencatatan kehadiran mahasiswa.

Struktur ini dirancang agar mudah diimplementasikan menggunakan Laravel Eloquent, memenuhi prinsip normalisasi hingga Third Normal Form (3NF), serta tetap sederhana sehingga sesuai dengan ruang lingkup proyek UAS tanpa mengurangi peluang pengembangan pada versi berikutnya.