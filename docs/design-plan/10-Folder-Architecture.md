# Rancangan Arsitektur Folder yang Lebih Rapi (Views dulu)

## Tujuan
Merapikan `resources/views` dengan pendekatan **feature-based** tanpa mengubah logic controller terlebih dulu.

## Usulan Struktur

```
resources/views/
  layouts/
  components/
  modules/
    Foodify/
      beranda.blade.php
      kategori.blade.php
      produk.blade.php
      profil.blade.php
      pendaftaran.blade.php
    Academic/
      dashboards/
        admin.blade.php
        dosen.blade.php
        mahasiswa.blade.php
      kelas/
        index.blade.php
        create.blade.php
        edit.blade.php
        show.blade.php
      dosen/
        index.blade.php
        create.blade.php
        edit.blade.php
        show.blade.php
      mata_kuliah/
      jadwal/
      presensi/
      sesi_presensi/
      izin/
      komplain/
      kalender/
      pengumuman/
      profile/
```

## Rule Migrasi (Views saja)
1. `resources/views/foodify/*` -> `resources/views/modules/Foodify/*`
2. `resources/views/dashboard-*.blade.php` -> `resources/views/modules/Academic/dashboards/*`
3. Semua folder view domain lain yang masih di root (`kelas/`, `dosen/`, `jadwal/`, dst) dipindahkan ke `modules/Academic/<domain>/*`.
4. Pastikan `@extends`, `@include`, dan `view('...')` mengarah ke path baru.

## Tahapan Implementasi
- Step 1: Pindahkan `foodify/*` ke `modules/Foodify/*` lalu update referensi view path.
- Step 2: Pindahkan `dashboard-*.blade.php` + folder academic domain ke `modules/Academic/...` lalu update referensi.
- Step 3: Jalankan cek build/route dan validasi beberapa route utama.

