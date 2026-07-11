@extends('modules.Foodify.app', ['bgColor' => 'lightblue'])

@php
function gambarProduk($nama_produk)
{
    $nama = strtolower($nama_produk);

    if (strpos($nama, 'nasi goreng') !== false) {
        return asset('foodify_assets/images/nasi-goreng.png');
    } elseif (strpos($nama, 'kopi') !== false) {
        return asset('foodify_assets/images/kopi.png');
    } elseif (strpos($nama, 'ayam') !== false) {
        return asset('foodify_assets/images/ayam-geprek.png');
    } elseif (strpos($nama, 'burger') !== false) {
        return asset('foodify_assets/images/burger.png');
    } elseif (strpos($nama, 'es teh') !== false || strpos($nama, 'teh') !== false) {
        return asset('foodify_assets/images/es-teh.png');
    } else {
        return asset('foodify_assets/images/default.png');
    }
}
@endphp

@section('content')
    <h2 align="center">DAFTAR PRODUK FOODIFY</h2>
    <hr>

    <p align="center">
        Temukan berbagai pilihan makanan dan minuman favorit di <b>Foodify</b>.
    </p>

    <p align="center">
        Mulai dari makanan berat, snack, sampai minuman segar. Semuanya tersedia
        untuk menemani aktivitas kamu sehari-hari.
    </p>

    <hr>

    <h3 align="center">Daftar Menu Foodify</h3>

    <table border="1" width="950" align="center" cellpadding="8" cellspacing="0">
        <tr bgcolor="orange">
            <th width="40">No</th>
            <th width="130">Gambar</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Status</th>
        </tr>

        @php($no = 1)
        @forelse($produk as $item)
            @php($gambar = gambarProduk($item->nama_produk))
            <tr align="center">
                <td>{{ $no++ }}</td>

                <td>
                    <img src="{{ $gambar }}" alt="{{ $item->nama_produk }}" width="110" height="80">
                </td>

                <td align="left">
                    <b>{{ $item->nama_produk }}</b>
                </td>

                <td>
                    {{ $item->kategori }}
                </td>

                <td>
                    <b>Rp {{ number_format($item->harga, 0, ',', '.') }}</b>
                </td>

                <td align="left">
                    {{ $item->deskripsi }}
                </td>

                <td>
                    Tersedia
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" align="center">Belum ada produk yang tersedia.</td>
            </tr>
        @endforelse
    </table>

    <br>

    <h3 align="center">Kategori Produk</h3>

    <table border="1" width="700" align="center" cellpadding="8" cellspacing="0">
        <tr bgcolor="orange">
            <th>No</th>
            <th>Kategori</th>
            <th>Keterangan</th>
        </tr>

        <tr align="center">
            <td>1</td>
            <td><b>Makanan Berat</b></td>
            <td align="left">Menu utama yang cocok untuk makan siang atau makan malam.</td>
        </tr>

        <tr align="center">
            <td>2</td>
            <td><b>Snack</b></td>
            <td align="left">Cemilan santai buat nemenin ngobrol, belajar, atau nonton.</td>
        </tr>

        <tr align="center">
            <td>3</td>
            <td><b>Minuman</b></td>
            <td align="left">Pilihan minuman segar dan hangat untuk melengkapi pesanan.</td>
        </tr>
    </table>

    <br>

    <h3 align="center">Informasi Pemesanan</h3>

    <table border="1" width="700" align="center" cellpadding="8" cellspacing="0">
        <tr>
            <th width="180">Cara Pesan</th>
            <td>
                Pilih produk yang tersedia, lalu lanjutkan pemesanan melalui layanan Foodify.
            </td>
        </tr>

        <tr>
            <th>Keunggulan</th>
            <td>
                Harga ramah kantong, bahan segar, dan pilihan menu yang cocok untuk pelajar maupun mahasiswa.
            </td>
        </tr>
    </table>

    <br>

    <p align="center">
        <a href="{{ route('foodify.kategori') }}">&larr; Kategori</a>
        &nbsp;
        <a href="{{ route('foodify.profil') }}">Profil &rarr;</a>
    </p>
@endsection
