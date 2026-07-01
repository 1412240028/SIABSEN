# Data Dictionary (Database Schema)

> **Project Name:** SIABSEN (Sistem Informasi Presensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Final Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Overview

Dokumen Data Dictionary mendefinisikan struktur setiap tabel pada basis data SIABSEN, meliputi nama kolom, tipe data, panjang data, constraint, nilai default, serta deskripsi setiap atribut.

Dokumen ini menjadi acuan utama dalam implementasi database menggunakan Laravel Migration dan MySQL.

---

# 2. Database Information

| Item | Value |
|------|-------|
| DBMS | MySQL 8.x / MariaDB 11.x |
| Framework | Laravel 12 |
| Character Set | utf8mb4 |
| Collation | utf8mb4_unicode_ci |
| Engine | InnoDB |
| Primary Key | BIGINT UNSIGNED |
| Foreign Key | BIGINT UNSIGNED |
| Soft Delete | Ya (Master Data) |
| Timestamp | created_at, updated_at |

---

# 3. Naming Convention

## Table

Menggunakan format:

snake_case

Contoh:

- users
- mahasiswa
- mata_kuliah
- sesi_presensi

---

## Column

Menggunakan snake_case.

Contoh:

- user_id
- kelas_id
- tahun_ajaran
- jam_mulai

---

## Foreign Key

Format:

nama_tabel_id

Contoh:

- user_id
- dosen_id
- jadwal_id

---

## Primary Key

Seluruh tabel menggunakan:

id

---

# 4. Table Structure
TABLE 1 — USERS
## 4.1 users

Deskripsi:

Menyimpan data akun pengguna.

| Column | Type | Length | Constraint | Default | Description |
|---------|------|---------|------------|----------|-------------|
| id | BIGINT | - | PK AI | - | Primary Key |
| name | VARCHAR | 100 | NOT NULL | - | Nama pengguna |
| email | VARCHAR | 100 | UNIQUE | - | Email login |
| email_verified_at | TIMESTAMP | - | NULL | NULL | Verifikasi email |
| password | VARCHAR | 255 | NOT NULL | - | Password hash |
| role | ENUM | - | NOT NULL | mahasiswa | admin, dosen, mahasiswa |
| avatar | VARCHAR | 255 | NULL | NULL | Foto profil |
| remember_token | VARCHAR | 100 | NULL | NULL | Remember login |
| created_at | TIMESTAMP | - | - | CURRENT_TIMESTAMP | Dibuat |
| updated_at | TIMESTAMP | - | - | CURRENT_TIMESTAMP | Diubah |
TABLE 2 — MAHASISWA
## 4.2 mahasiswa

| Column | Type | Constraint |
|---------|------|------------|
| id | BIGINT | PK AI |
| user_id | BIGINT | FK |
| kelas_id | BIGINT | FK |
| nim | VARCHAR(20) | UNIQUE |
| nama | VARCHAR(100) | NOT NULL |
| jenis_kelamin | ENUM('L','P') | NOT NULL |
| tanggal_lahir | DATE | NULL |
| no_hp | VARCHAR(20) | NULL |
| alamat | TEXT | NULL |
| angkatan | YEAR | NOT NULL |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |
| deleted_at | TIMESTAMP | Soft Delete |
TABLE 3 — DOSEN
## 4.3 dosen

| Column | Type | Constraint |
|---------|------|------------|
| id | BIGINT | PK AI |
| user_id | BIGINT | FK |
| nidn | VARCHAR(20) | UNIQUE |
| nama | VARCHAR(100) | NOT NULL |
| jenis_kelamin | ENUM('L','P') | NOT NULL |
| no_hp | VARCHAR(20) | NULL |
| alamat | TEXT | NULL |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |
| deleted_at | TIMESTAMP | Soft Delete |
TABLE 4 — KELAS
## 4.4 kelas

| Column | Type | Constraint |
|---------|------|------------|
| id | BIGINT | PK AI |
| nama_kelas | VARCHAR(30) | UNIQUE |
| angkatan | YEAR | NOT NULL |
| kapasitas | INT | DEFAULT 40 |
| status | BOOLEAN | DEFAULT TRUE |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |
| deleted_at | TIMESTAMP | Soft Delete |
TABLE 5 — MATA_KULIAH
## 4.5 mata_kuliah

| Column | Type | Constraint |
|---------|------|------------|
| id | BIGINT | PK AI |
| kode | VARCHAR(20) | UNIQUE |
| nama | VARCHAR(100) | NOT NULL |
| sks | TINYINT | NOT NULL |
| status | BOOLEAN | DEFAULT TRUE |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |
| deleted_at | TIMESTAMP | Soft Delete |
TABLE 6 — JADWAL
## 4.6 jadwal

| Column | Type | Constraint |
|---------|------|------------|
| id | BIGINT | PK AI |
| dosen_id | BIGINT | FK |
| kelas_id | BIGINT | FK |
| mata_kuliah_id | BIGINT | FK |
| semester | ENUM('Ganjil','Genap') | NOT NULL |
| tahun_ajaran | VARCHAR(20) | NOT NULL |
| hari | ENUM | NOT NULL |
| jam_mulai | TIME | NOT NULL |
| jam_selesai | TIME | NOT NULL |
| ruangan | VARCHAR(50) | NULL |
| status | BOOLEAN | DEFAULT TRUE |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |
| deleted_at | TIMESTAMP | Soft Delete |
TABLE 7 — SESI_PRESENSI
## 4.7 sesi_presensi

| Column | Type | Constraint |
|---------|------|------------|
| id | BIGINT | PK AI |
| jadwal_id | BIGINT | FK |
| pertemuan_ke | TINYINT | NOT NULL |
| tanggal | DATE | NOT NULL |
| token | VARCHAR(100) | UNIQUE |
| opened_at | DATETIME | NOT NULL |
| expired_at | DATETIME | NOT NULL |
| closed_at | DATETIME | NULL |
| status | ENUM('OPEN','CLOSED','CANCELLED') | NOT NULL |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |
TABLE 8 — PRESENSI
## 4.8 presensi

| Column | Type | Constraint |
|---------|------|------------|
| id | BIGINT | PK AI |
| sesi_presensi_id | BIGINT | FK |
| mahasiswa_id | BIGINT | FK |
| status | ENUM('HADIR','TERLAMBAT','IZIN','SAKIT','ALPHA') | NOT NULL |
| metode | ENUM('QR','MANUAL') | NOT NULL |
| waktu_presensi | DATETIME | NULL |
| catatan | TEXT | NULL |
| created_at | TIMESTAMP | - |
| updated_at | TIMESTAMP | - |
5. Index Recommendation
| Table | Index |
|---------|------|
| users | email |
| mahasiswa | nim |
| dosen | nidn |
| mata_kuliah | kode |
| jadwal | hari, semester |
| sesi_presensi | token |
| presensi | mahasiswa_id, sesi_presensi_id |
6. Foreign Key Rules
| Child | Parent | On Update | On Delete |
|---------|---------|-----------|-----------|
| mahasiswa.user_id | users.id | CASCADE | CASCADE |
| dosen.user_id | users.id | CASCADE | CASCADE |
| mahasiswa.kelas_id | kelas.id | CASCADE | RESTRICT |
| jadwal.kelas_id | kelas.id | CASCADE | RESTRICT |
| jadwal.dosen_id | dosen.id | CASCADE | RESTRICT |
| jadwal.mata_kuliah_id | mata_kuliah.id | CASCADE | RESTRICT |
| sesi_presensi.jadwal_id | jadwal.id | CASCADE | CASCADE |
| presensi.sesi_presensi_id | sesi_presensi.id | CASCADE | CASCADE |
| presensi.mahasiswa_id | mahasiswa.id | CASCADE | RESTRICT |