@extends('foodify.app', ['bgColor' => 'lightblue'])

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
<center>
    <font face="Verdana, sans-serif" color="#27AE60" size="5">
        <b>DAFTAR PRODUK FOODIFY</b>
    </font>
</center>

<br>
<hr size="1" color="#E0E0E0">
<br>

<p align="center">
    <font size="3" color="#555555" face="Arial">
        Temukan berbagai pilihan makanan dan minuman favorit di <b>Foodify</b>.
    </font>
</p>

<p align="center">
    <font size="3" color="#555555" face="Arial">
        Mulai dari makanan berat, snack, sampai minuman segar. Semuanya tersedia
        untuk menemani aktivitas kamu sehari-hari.
    </font>
</p>

<hr>

<center>
    <font face="Verdana, sans-serif" color="#2C3E50" size="4">
        <b>Daftar Menu Foodify</b>
    </font>
</center>

<br>

<table border="1" bordercolor="#E0E0E0" width="85%" align="center" cellpadding="10" cellspacing="0">
    <tr bgcolor="orange">
        <th width="40"><font color="#FFFFFF"><b>No</b></font></th>
        <th width="130"><font color="#FFFFFF"><b>Gambar</b></font></th>
        <th><font color="#FFFFFF"><b>Nama Produk</b></font></th>
        <th><font color="#FFFFFF"><b>Kategori</b></font></th>
        <th><font color="#FFFFFF"><b>Harga</b></font></th>
        <th><font color="#FFFFFF"><b>Deskripsi</b></font></th>
        <th><font color="#FFFFFF"><b>Status</b></font></th>
    </tr>

    @forelse($produk as $index => $item)
        <tr align="center" bgcolor="#FDFEFE">
            <td><font color="#333333"><b>{{ $index + 1 }}</b></font></td>
            <td>
                <img src="{{ gambarProduk($item->nama_produk) }}" alt="{{ $item->nama_produk }}" width="110" height="80">
            </td>
            <td align="left"><b><font color="#2C3E50">{{ $item->nama_produk }}</font></b></td>
            <td><font color="#34495E">{{ $item->kategori }}</font></td>
            <td><b><font color="#C0392B">Rp {{ number_format($item->harga, 0, ',', '.') }}</font></b></td>
            <td align="left"><font color="#34495E">{{ $item->deskripsi }}</font></td>
            <td><font color="#27AE60"><b>Tersedia</b></font></td>
        </tr>
    @empty
        <tr>
            <td colspan="7" align="center">
                <font color="#34495E">Belum ada produk yang tersedia.</font>
            </td>
        </tr>
    @endforelse
</table>

<br>

<center>
    <font face="Verdana, sans-serif" color="#2980B9" size="4">
        <b>Kategori Produk</b>
    </font>
</center>

<br>

<table border="1" bordercolor="#E0E0E0" width="85%" align="center" cellpadding="10" cellspacing="0">
    <tr bgcolor="orange">
        <th width="40"><font color="#FFFFFF"><b>No</b></font></th>
        <th><font color="#FFFFFF"><b>Kategori</b></font></th>
        <th><font color="#FFFFFF"><b>Keterangan</b></font></th>
    </tr>

    <tr bgcolor="#FADBD8" align="center">
        <td><font color="#333333"><b>1</b></font></td>
        <td><font color="#C0392B" size="3"><b>Makanan Berat</b></font></td>
        <td align="left"><font color="#333333">Menu utama yang cocok untuk makan siang atau makan malam.</font></td>
    </tr>

    <tr bgcolor="#FCF3CF" align="center">
        <td><font color="#333333"><b>2</b></font></td>
        <td><font color="#F39C12" size="3"><b>Snack</b></font></td>
        <td align="left"><font color="#333333">Cemilan santai buat nemenin ngobrol, belajar, atau nonton.</font></td>
    </tr>

    <tr bgcolor="#D4E6F1" align="center">
        <td><font color="#333333"><b>3</b></font></td>
        <td><font color="#2980B9" size="3"><b>Minuman</b></font></td>
        <td align="left"><font color="#333333">Pilihan minuman segar dan hangat untuk melengkapi pesanan.</font></td>
    </tr>
</table>

<br>

<center>
    <font face="Verdana, sans-serif" color="#2C3E50" size="4">
        <b>Informasi Pemesanan</b>
    </font>
</center>

<br>

<table border="1" bordercolor="#BDC3C7" width="85%" align="center" cellpadding="10" cellspacing="0">
    <tr bgcolor="#ECF0F1">
        <td width="25%" align="center"><font color="#34495E"><b>Cara Pesan</b></font></td>
        <td align="left"><font color="#34495E">Pilih produk yang tersedia, lalu lanjutkan pemesanan melalui layanan Foodify.</font></td>
    </tr>

    <tr bgcolor="#FFFFFF">
        <td align="center"><font color="#34495E"><b>Keunggulan</b></font></td>
        <td align="left"><font color="#34495E">Harga ramah kantong, bahan segar, dan pilihan menu yang cocok untuk pelajar maupun mahasiswa.</font></td>
    </tr>
</table>

<br>

<center>
    <table border="0" cellpadding="10">
        <tr>
            <td bgcolor="#E67E22" align="center" width="150">
                <a href="{{ route('foodify.kategori') }}"><font color="#FFFFFF" face="Arial"><b>&laquo; Kembali ke Kategori</b></font></a>
            </td>
            <td width="20"></td>
            <td bgcolor="#3498DB" align="center" width="150">
                <a href="{{ route('foodify.profil') }}"><font color="#FFFFFF" face="Arial"><b>Profil &rarr;</b></font></a>
            </td>
        </tr>
    </table>
</center>
@endsection

