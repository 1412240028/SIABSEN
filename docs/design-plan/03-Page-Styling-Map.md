# Page Styling Map & Progress

> **Project Name:** SIABSEN (Sistem Informasi Presensi Mahasiswa)
> **Status:** Draft / Active Tracking
> **Last Updated:** 8 Juli 2026

---

## 1. Overview
Dokumen ini digunakan untuk memetakan halaman (pages) mana saja yang sudah mengimplementasikan **Design System** (`02-Design-System.md`) dan halaman mana saja yang masih menggunakan scaffolding bawaan dari Laravel Breeze (default Tailwind colors, `indigo`, `gray`, dsb.).

## 2. Status Implementasi

### ✅ Sudah Diimplementasikan (Custom Design System)
Halaman-halaman berikut sudah mengadopsi Design System kustom (menggunakan kelas seperti `bg-primary`, `font-headline-xl`, `text-on-surface`, `shadow-soft`):

- **Layout Utama & Guest**
  - `resources/views/layouts/app.blade.php` (Sidebar, Navbar, Layout Utama)
  - `resources/views/layouts/guest.blade.php` (Auth Layout)
- **Dashboard**
  - `resources/views/modules/Academic/dashboards/dashboard-admin.blade.php`
  - `resources/views/modules/Academic/dashboards/dashboard-dosen.blade.php`
  - `resources/views/modules/Academic/dashboards/dashboard-mahasiswa.blade.php`
- **Master Data & Akademik (Module: Academic)**
  - `resources/views/modules/Academic/dosen/*.blade.php`
  - `resources/views/modules/Academic/kelas/*.blade.php`
  - `resources/views/modules/Academic/jadwal/*.blade.php`
  - `resources/views/modules/Academic/izin/*.blade.php`
  - Dan hampir seluruh form dan index di dalam `modules/Academic/`
- **Profile**
  - `resources/views/profile/edit.blade.php`
  - Semua file partials di `resources/views/profile/partials/`
- **Auth Pages & Components**
  - Halaman `login`, `register`, `forgot-password`, `reset-password`, `verify-email`, `confirm-password` di dalam `resources/views/auth/`.
  - Seluruh file di dalam `resources/views/components/` sudah direfaktor menggunakan Tailwind styling dari Design System.
- **Public / Landing Page**
  - `resources/views/welcome.blade.php` (Custom portal navigasi UTS/UAS)

### ⚠️ Belum Diimplementasikan (Masih Default Breeze)
- *(Tidak ada - Seluruh komponen UI inti sudah dikonversi ke Design System)*

## 3. Tindak Lanjut (Next Steps)
- *(Selesai) Layout Auth (`guest.blade.php`) telah direfaktor.*
- *(Selesai) Auth Pages (`login`, `register`, dll) telah direfaktor ke typography dan warna brand yang sesuai.*
- *(Selesai) Komponen Blade (`components/`) telah direfaktor ke styling Design System untuk konsistensi serentak.*
