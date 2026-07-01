# Business Rules

> **Project Name:** SIABSEN (Sistem Informasi Presensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Overview

Dokumen ini mendefinisikan seluruh aturan bisnis yang harus dipatuhi oleh sistem SIABSEN. Business Rule digunakan sebagai dasar implementasi validasi, pembatasan akses, serta proses bisnis aplikasi.

---

# 2. Authentication Rules

## BR-001

Setiap pengguna wajib memiliki akun untuk mengakses sistem.

---

## BR-002

Setiap akun hanya boleh memiliki satu role.

Role yang tersedia:

- Administrator
- Dosen
- Mahasiswa

---

## BR-003

Email harus unik.

---

## BR-004

Password disimpan menggunakan hashing Laravel.

---

## BR-005

Pengguna hanya dapat mengakses menu sesuai role.

---

# 3. Mahasiswa Rules

## BR-006

Setiap mahasiswa memiliki NIM yang unik.

---

## BR-007

Satu akun hanya dapat terhubung dengan satu data mahasiswa.

---

## BR-008

Mahasiswa hanya dapat melihat data miliknya sendiri.

---

## BR-009

Mahasiswa tidak diperbolehkan mengubah data akademik.

---

# 4. Dosen Rules

## BR-010

Setiap dosen memiliki NIDN yang unik.

---

## BR-011

Satu akun hanya dapat terhubung dengan satu data dosen.

---

## BR-012

Dosen hanya dapat mengakses jadwal yang diampunya.

---

## BR-013

Dosen hanya dapat membuka sesi presensi pada jadwal yang menjadi tanggung jawabnya.

---

# 5. Mata Kuliah Rules

## BR-014

Kode mata kuliah harus unik.

---

## BR-015

Satu mata kuliah dapat memiliki lebih dari satu jadwal.

---

# 6. Kelas Rules

## BR-016

Nama kelas harus unik.

Contoh:

- TI-2A
- TI-2B
- TI-3A

---

## BR-017

Satu kelas dapat memiliki banyak mahasiswa.

---

# 7. Jadwal Rules

## BR-018

Satu jadwal hanya dimiliki oleh:

- satu dosen
- satu mata kuliah
- satu kelas

---

## BR-019

Tidak boleh ada bentrok jadwal pada kombinasi:

- Hari
- Jam
- Kelas

---

## BR-020

Jadwal yang sudah memiliki data presensi tidak dapat dihapus.

---

# 8. Sesi Presensi Rules

## BR-021

Sesi presensi hanya dapat dibuka oleh dosen.

---

## BR-022

Satu jadwal hanya boleh memiliki satu sesi aktif pada waktu yang sama.

---

## BR-023

Saat sesi dibuka, sistem membuat token unik.

---

## BR-024

Token digunakan untuk menghasilkan QR Code.

---

## BR-025

QR Code hanya berlaku selama sesi masih aktif.

---

## BR-026

Dosen dapat menutup sesi kapan saja.

---

## BR-027

Setelah sesi ditutup, QR Code tidak dapat digunakan kembali.

---

# 9. Presensi Rules

## BR-028

Mahasiswa hanya dapat melakukan presensi satu kali pada setiap sesi.

---

## BR-029

Presensi hanya dapat dilakukan jika sesi masih aktif.

---

## BR-030

Presensi dicatat secara otomatis beserta:

- tanggal
- waktu
- status

---

## BR-031

Status presensi terdiri dari:

- Hadir
- Terlambat
- Izin
- Sakit
- Alpha

---

## BR-032

Dosen dapat mengubah status presensi apabila terjadi kesalahan pencatatan.

---

## BR-033

Mahasiswa tidak dapat mengubah data presensi.

---

# 10. Reporting Rules

## BR-034

Rekap presensi dihitung secara otomatis berdasarkan data presensi.

---

## BR-035

Mahasiswa hanya dapat melihat riwayat presensi miliknya.

---

## BR-036

Dosen hanya dapat melihat laporan kelas yang diampunya.

---

## BR-037

Administrator dapat melihat seluruh laporan.

---

# 11. Audit Rules

## BR-038

Setiap data memiliki informasi:

- created_at
- updated_at

---

## BR-039

Soft Delete digunakan pada data master:

- Mahasiswa
- Dosen
- Mata Kuliah
- Kelas
- Jadwal

---

# 12. General Rules

## BR-040

Seluruh input wajib divalidasi sebelum disimpan.

---

## BR-041

Pesan kesalahan harus informatif dan mudah dipahami pengguna.

---

## BR-042

Sistem hanya dapat diakses oleh pengguna yang telah login.

---

# 13. Future Rules

Aturan berikut belum diterapkan pada versi 1.0, namun dipersiapkan untuk pengembangan berikutnya.

- Notifikasi email setelah presensi.
- Export PDF.
- Export Excel.
- REST API.