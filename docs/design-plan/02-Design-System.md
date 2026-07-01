# Design System

> **Project Name:** SIABSEN (Sistem Informasi Presensi Mahasiswa)
>
> **Version:** 1.0
>
> **Status:** Final Draft
>
> **Last Updated:** 1 Juli 2026

---

# 1. Overview

Dokumen Design System mendefinisikan seluruh elemen visual (warna, tipografi, spacing, ikon, komponen, dan elevation) yang digunakan pada aplikasi SIABSEN. Dokumen ini melanjutkan `01-Wireframe-Low-Fidelity.md` — jika wireframe menjawab pertanyaan "di mana letak elemennya", Design System menjawab "seperti apa rupanya".

Tujuan dokumen ini:

- Menjadi *single source of truth* token visual (warna, font, spacing) agar tidak ada developer yang menebak-nebak hex code sendiri.
- Menjaga konsistensi antar halaman Admin, Dosen, dan Mahasiswa.
- Menjadi acuan konfigurasi `tailwind.config.js` dan class Blade component.

---

# 2. Design Philosophy

Beberapa prinsip yang sengaja dipilih agar SIABSEN terasa seperti **sistem informasi kampus yang kredibel**, bukan template SaaS generik:

| Prinsip | Penjelasan |
|---|---|
| **Flat, bukan gradient** | Tidak memakai gradient ungu→pink atau glassmorphism yang jadi ciri khas landing page "AI-generated". Warna solid, kontras jelas. |
| **Satu warna brand, satu warna aksen** | Primary (teal) untuk elemen struktural (navbar, sidebar aktif, tombol utama), Amber untuk aksi yang butuh perhatian (CTA, notifikasi). Bukan pelangi warna di satu layar. |
| **Netral dari skala abu-biru (slate)**, bukan abu-abu netral polos | Memberi kesan sedikit lebih "teknis/akademik" dibanding gray murni. |
| **Shadow tipis, radius sedang** | `shadow-soft` custom (bukan `shadow-xl` bawaan Tailwind yang terlalu tebal), `rounded-lg` konsisten — kesan rapi, bukan "card melayang" ala dashboard AI demo. |
| **Warna status attendance eksplisit** | Karena inti aplikasi adalah presensi, 4 status (Hadir/Izin/Sakit/Alpa) punya warna semantik tetap dan tidak boleh dipakai untuk elemen lain. |

---

# 3. Color Palette

## 3.1 Primary — Teal (Brand Color)

Dipakai untuk: logo, sidebar aktif, navbar, tombol utama, link aktif.

| Token | Hex | Contoh Penggunaan |
|---|---|---|
| `primary-50` | `#EEFBFA` | Background hover ringan |
| `primary-100` | `#D4F3F1` | Background badge/info ringan |
| `primary-200` | `#A9E6E2` | Border aktif ringan |
| `primary-300` | `#74D1CB` | Ikon sekunder |
| `primary-400` | `#3FB3AC` | Hover state |
| `primary-500` | `#1F948C` | Aksen sedang |
| **`primary-600`** | **`#157870`** | **Warna utama brand (tombol, navbar, sidebar aktif)** |
| `primary-700` | `#146059` | Hover pada tombol primary |
| `primary-800` | `#144D48` | Active/pressed state |
| `primary-900` | `#123F3C` | Teks di atas background terang |

## 3.2 Accent — Amber (Call to Action)

Dipakai **terbatas**: tombol "Buka Sesi Presensi", "Scan QR", badge notifikasi. Jangan dipakai untuk elemen struktural.

| Token | Hex |
|---|---|
| `accent-400` | `#FBBF24` |
| **`accent-500`** | **`#F2A71B`** |
| `accent-600` | `#D48806` |

## 3.3 Neutral — Slate

Dipakai untuk teks, border, background halaman, sidebar non-aktif.

| Token | Hex | Penggunaan |
|---|---|---|
| `slate-50` | `#F8FAFC` | Background halaman |
| `slate-100` | `#F1F5F9` | Background card sekunder / hover row tabel |
| `slate-200` | `#E2E8F0` | Border default |
| `slate-400` | `#94A3B8` | Placeholder, ikon non-aktif |
| `slate-500` | `#64748B` | Teks sekunder |
| `slate-700` | `#334155` | Teks body |
| `slate-900` | `#0F172A` | Teks heading, sidebar background (dark sidebar) |

## 3.4 Semantic — Status Presensi

Ini yang **paling penting** karena jadi bahasa visual inti aplikasi. Konsisten dipakai di badge, grafik, dan laporan.

| Status | Token | Hex | Badge (bg / text) |
|---|---|---|---|
| Hadir | `status-hadir` | `#16A34A` (green-600) | bg `#DCFCE7` / text `#166534` |
| Izin | `status-izin` | `#2563EB` (blue-600) | bg `#DBEAFE` / text `#1E40AF` |
| Sakit | `status-sakit` | `#D97706` (amber-600) | bg `#FEF3C7` / text `#92400E` |
| Alpa | `status-alpa` | `#DC2626` (red-600) | bg `#FEE2E2` / text `#991B1B` |

## 3.5 Feedback / System

| Fungsi | Token | Hex |
|---|---|---|
| Success | `success` | `#16A34A` |
| Warning | `warning` | `#D97706` |
| Danger / Error | `danger` | `#DC2626` |
| Info | `info` | `#2563EB` |

---

# 4. Typography

## 4.1 Font Family

Laravel Breeze pada proyek ini sudah mengonfigurasi **Figtree** sebagai font utama (`tailwind.config.js`). Kita pertahankan karena sudah terpasang via Google Fonts di layout dan bentuknya netral-humanis, cocok untuk UI form-heavy seperti SIABSEN.

Ditambahkan satu font monospace khusus untuk **kode QR / token presensi**, supaya angka token (`482913`) mudah dibaca dan tidak ambigu (`0` vs `O`, `1` vs `l`):

| Peran | Font | Fallback |
|---|---|---|
| UI utama (heading, body, form) | `Figtree` | `ui-sans-serif, system-ui` |
| Token / kode numerik | `JetBrains Mono` | `ui-monospace, monospace` |

## 4.2 Type Scale

| Token | Ukuran | Line Height | Penggunaan |
|---|---|---|---|
| `text-xs` | 12px | 16px | Label kecil, timestamp tabel |
| `text-sm` | 14px | 20px | Body sekunder, caption, input helper text |
| `text-base` | 16px | 24px | Body default, isi form |
| `text-lg` | 18px | 28px | Sub-heading card |
| `text-xl` | 20px | 28px | Judul section (mis. "Sesi Presensi Aktif") |
| `text-2xl` | 24px | 32px | Judul halaman (mis. "Dashboard Admin") |
| `text-4xl` | 36px | 40px | Hero title Landing Page |

## 4.3 Font Weight

- `font-normal` (400) → body text
- `font-medium` (500) → label form, item sidebar
- `font-semibold` (600) → judul card, heading halaman
- `font-bold` (700) → hero title, angka statistik dashboard

---

# 5. Spacing & Layout

Menggunakan skala spacing default Tailwind (`4px` per unit) tanpa modifikasi, dengan aturan pemakaian berikut agar konsisten antar halaman:

| Konteks | Token |
|---|---|
| Padding dalam card | `p-6` |
| Gap antar card dashboard | `gap-4` (mobile) / `gap-6` (desktop) |
| Padding horizontal content area | `px-4` (mobile) / `px-8` (desktop) |
| Jarak antar field form | `space-y-4` |
| Tinggi navbar | `h-16` |
| Lebar sidebar (expanded) | `w-64` |
| Lebar sidebar (collapsed, tablet) | `w-20` |

---

# 6. Border Radius & Elevation

Sengaja dibuat **lebih flat** dibanding default banyak dashboard template agar tidak terlihat seperti hasil generate cepat.

| Token | Nilai | Penggunaan |
|---|---|---|
| `rounded-md` | 6px | Input, button kecil |
| `rounded-lg` | 8px | Card, modal, button utama |
| `rounded-full` | 9999px | Avatar, badge status, ikon bulat |

Custom shadow (didefinisikan di `tailwind.config.js` pada Bagian 9):

| Token | Deskripsi |
|---|---|
| `shadow-soft` | Shadow sangat tipis untuk card di atas background `slate-50` |
| `shadow-card` | Shadow standar untuk card dengan sedikit elevasi (dropdown, modal) |

---

# 7. Iconography

- Library ikon: **Lucide Icons** (ringan, konsisten stroke-width, tersedia sebagai SVG/komponen).
- Stroke width konsisten: `1.5px` — jangan campur dengan ikon filled/solid dari library lain.
- Ukuran standar: `16px` (inline teks), `20px` (sidebar/menu), `24px` (dashboard summary card).

| Konteks | Ikon |
|---|---|
| Dashboard | `layout-dashboard` |
| Mahasiswa | `graduation-cap` |
| Dosen | `user-round` |
| Kelas | `users` |
| Mata Kuliah | `book-open` |
| Jadwal | `calendar` |
| Sesi Presensi | `qr-code` |
| Laporan | `bar-chart-3` |
| Profil | `circle-user` |
| Logout | `log-out` |

---

# 8. Komponen UI

## 8.1 Button

| Varian | Class Tailwind | Penggunaan |
|---|---|---|
| Primary | `bg-primary-600 text-white hover:bg-primary-700 rounded-lg px-4 py-2 font-medium` | Aksi utama: Simpan, Login |
| Accent | `bg-accent-500 text-slate-900 hover:bg-accent-600 rounded-lg px-4 py-2 font-medium` | Buka Sesi Presensi, Scan QR |
| Outline | `border border-slate-300 text-slate-700 hover:bg-slate-50 rounded-lg px-4 py-2` | Batal, Kembali |
| Danger | `bg-danger text-white hover:bg-red-700 rounded-lg px-4 py-2` | Hapus data |
| Ghost | `text-slate-600 hover:bg-slate-100 rounded-md px-3 py-1.5` | Aksi tabel (Edit/Detail) |

## 8.2 Input Field

```
Base:    border border-slate-300 rounded-md px-3 py-2 text-sm text-slate-700
Focus:   focus:ring-2 focus:ring-primary-500 focus:border-primary-500
Error:   border-danger focus:ring-danger
```

## 8.3 Badge Status Presensi

```html
<!-- Hadir -->
<span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full">Hadir</span>

<!-- Izin -->
<span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full">Izin</span>

<!-- Sakit -->
<span class="bg-amber-100 text-amber-800 text-xs font-medium px-2.5 py-1 rounded-full">Sakit</span>

<!-- Alpa -->
<span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-1 rounded-full">Alpa</span>
```

## 8.4 Card

```
bg-white rounded-lg shadow-soft border border-slate-200 p-6
```

## 8.5 Table

```
Header row : bg-slate-50 text-slate-500 text-xs font-medium uppercase tracking-wide
Body row   : hover:bg-slate-50 border-b border-slate-100
Cell       : px-4 py-3 text-sm text-slate-700
```

## 8.6 Sidebar

```
Container      : bg-slate-900 text-slate-300 w-64
Item default   : hover:bg-slate-800 hover:text-white px-4 py-2.5 rounded-md
Item active    : bg-primary-600 text-white px-4 py-2.5 rounded-md
```

## 8.7 Navbar

```
Container : bg-white border-b border-slate-200 h-16 px-6
```

## 8.8 Alert / Notifikasi

| Tipe | Class |
|---|---|
| Success | `bg-green-50 border border-green-200 text-green-800` |
| Warning | `bg-amber-50 border border-amber-200 text-amber-800` |
| Danger | `bg-red-50 border border-red-200 text-red-800` |
| Info | `bg-blue-50 border border-blue-200 text-blue-800` |

---

# 9. Implementasi Tailwind Config

Tambahkan ke `tailwind.config.js` yang sudah ada (extend, bukan replace, supaya tidak merusak konfigurasi Breeze):

```js
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                mono: ['"JetBrains Mono"', ...defaultTheme.fontFamily.mono],
            },

            colors: {
                primary: {
                    50: '#EEFBFA',
                    100: '#D4F3F1',
                    200: '#A9E6E2',
                    300: '#74D1CB',
                    400: '#3FB3AC',
                    500: '#1F948C',
                    600: '#157870', // brand color utama
                    700: '#146059',
                    800: '#144D48',
                    900: '#123F3C',
                },
                accent: {
                    400: '#FBBF24',
                    500: '#F2A71B',
                    600: '#D48806',
                },
                status: {
                    hadir: '#16A34A',
                    izin: '#2563EB',
                    sakit: '#D97706',
                    alpa: '#DC2626',
                },
                danger: '#DC2626',
                success: '#16A34A',
                warning: '#D97706',
                info: '#2563EB',
            },

            boxShadow: {
                soft: '0 1px 2px 0 rgb(15 23 42 / 0.04), 0 1px 3px 0 rgb(15 23 42 / 0.06)',
                card: '0 2px 4px -1px rgb(15 23 42 / 0.06), 0 4px 6px -1px rgb(15 23 42 / 0.08)',
            },

            borderRadius: {
                md: '6px',
                lg: '8px',
            },
        },
    },

    plugins: [forms],
};
```

Import font tambahan (`JetBrains Mono`) di layout utama (`resources/views/layouts/app.blade.php` atau setara), sejajar dengan import Figtree yang sudah ada:

```html
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|jetbrains-mono:400,500" rel="stylesheet" />
```

---

# 10. Responsive Breakpoint

Mengikuti breakpoint default Tailwind, dipetakan ke kebutuhan layout SIABSEN (lihat juga Bagian 8 di `01-Wireframe-Low-Fidelity.md`):

| Breakpoint | Lebar | Perilaku Layout |
|---|---|---|
| `base` (mobile) | < 640px | Sidebar jadi hamburger menu, card 1 kolom, tabel jadi scroll horizontal |
| `md` (tablet) | ≥ 768px | Sidebar collapsed (ikon saja), card 2 kolom |
| `lg` (desktop) | ≥ 1024px | Sidebar expanded penuh, card 4 kolom pada dashboard |

---

# 11. Konsistensi Antar Role

Ketiga role (Admin, Dosen, Mahasiswa) menggunakan **token dan komponen yang sama persis** — perbedaan hanya pada isi menu sidebar (lihat `00-Sitemap.md`) dan konten dashboard. Ini penting agar pengguna yang berpindah role (mis. dosen yang juga admin) tidak perlu belajar pola visual baru.

---

# 12. Conclusion

Design System ini menjadi acuan visual tunggal untuk seluruh implementasi antarmuka SIABSEN — mulai dari class Tailwind di Blade component, warna badge status presensi, hingga token yang dipakai saat proses beralih ke High-Fidelity Mockup. Kombinasi warna teal + amber + slate dengan gaya flat sengaja dipilih agar sistem terasa fungsional dan kredibel sebagai aplikasi akademik, bukan sekadar template dashboard generik.