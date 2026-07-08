@extends('modules.Foodify.app', ['bgColor' => '#FFFFFF'])

@section('content')
<center>
    <font face="Verdana, sans-serif" color="#27AE60" size="5">
        <b>SELAMAT DATANG DI FOODIFY</b>
    </font>
</center>

<br>
<hr size="1" color="#E0E0E0">
<br>

<table width="80%" align="center" border="0">
    <tr>
        <td align="center">
            <font size="3" color="#555555" face="Arial">
                <b>Foodify</b> adalah tempat terbaik buat kamu yang lagi pengen cari makanan enak, cepat, dan murah.
                <br><br>
                Mulai dari cemilan buat nemenin tugas, sampai makanan berat buat ngisi perut kosong, semuanya ada di sini.
                Kami selalu menjaga kualitas bahan biar masakan yang sampai ke tanganmu tetap <i>fresh</i> dan lezat.
            </font>
        </td>
    </tr>
</table>

<br><br>

<center>
    <font face="Verdana, sans-serif" color="#2C3E50" size="4">
        <b>Menu Favorit Minggu Ini</b>
    </font>
</center>

<br>

<table border="1" bordercolor="#E0E0E0" width="80%" align="center" cellpadding="10" cellspacing="0">
    <tr bgcolor="#F39C12">
        <td width="5%" align="center"><font color="#FFFFFF"><b>No</b></font></td>
        <td width="20%" align="center"><font color="#FFFFFF"><b>Gambar</b></font></td>
        <td width="55%" align="center"><font color="#FFFFFF"><b>Keterangan</b></font></td>
        <td width="20%" align="center"><font color="#FFFFFF"><b>Kategori</b></font></td>
    </tr>

    <tr bgcolor="#FDFEFE" align="center">
        <td><font color="#333333">1</font></td>
        <td>
            <img src="{{ asset('foodify_assets/images/nasi-goreng.png') }}" alt="Nasi Goreng" width="120" height="90">
        </td>
        <td align="left">
            <font size="3" color="#2C3E50"><b>Nasi Goreng</b></font><br>
            <font size="2" color="#7F8C8D">Yang paling sering di-reorder pelanggan karena porsinya bikin kenyang banget!</font>
        </td>
        <td><font color="#16A085"><b>Makanan Berat</b></font></td>
    </tr>

    <tr bgcolor="#F9EBDF" align="center">
        <td><font color="#333333">2</font></td>
        <td>
            <img src="{{ asset('foodify_assets/images/kopi.png') }}" alt="Kopi" width="120" height="90">
        </td>
        <td align="left">
            <font size="3" color="#2C3E50"><b>Kopi Susu Gula Aren</b></font><br>
            <font size="2" color="#7F8C8D">Teman begadang yang nggak pernah gagal nemenin bikin tugas.</font>
        </td>
        <td><font color="#8E44AD"><b>Minuman</b></font></td>
    </tr>
</table>

<br><br>

<center>
    <font face="Verdana, sans-serif" color="#2980B9" size="4">
        <b>Kenapa Pilih Foodify?</b>
    </font>
</center>
<br>

<table border="1" bordercolor="#BDC3C7" width="80%" align="center" cellpadding="10" cellspacing="0">
    <tr bgcolor="#ECF0F1">
        <td width="30%" align="center"><font color="#C0392B"><b>🚀 Cepat</b></font></td>
        <td width="70%"><font color="#34495E">Pesanan langsung diproses tanpa ribet. Waktu tunggunya sebentar aja!</font></td>
    </tr>
    <tr bgcolor="#FFFFFF">
        <td width="30%" align="center"><font color="#27AE60"><b>💸 Murah</b></font></td>
        <td width="70%"><font color="#34495E">Harga pas di kantong mahasiswa dan pelajar. Ga bikin dompet nangis.</font></td>
    </tr>
    <tr bgcolor="#ECF0F1">
        <td width="30%" align="center"><font color="#8E44AD"><b>📦 Praktis</b></font></td>
        <td width="70%"><font color="#34495E">Pesan lewat web, tinggal klik-klik, lalu ambil atau tunggu diantar.</font></td>
    </tr>
</table>

<br><br>

<center>
    <table border="0" cellpadding="10">
        <tr>
            <td bgcolor="#3498DB" align="center" width="150">
                <a href="{{ route('foodify.pendaftaran') }}"><font color="#FFFFFF" face="Arial"><b>&laquo; Daftar Member</b></font></a>
            </td>
            <td width="20"></td>
            <td bgcolor="#E67E22" align="center" width="150">
                <a href="{{ route('foodify.kategori') }}"><font color="#FFFFFF" face="Arial"><b>Lihat Kategori &raquo;</b></font></a>
            </td>
        </tr>
    </table>
</center>
@endsection

