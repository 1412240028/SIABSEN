@extends('foodify.app', ['bgColor' => '#FDFEFE'])

@section('content')
<center>
    <font face="Verdana, sans-serif" color="#C0392B" size="5">
        <b>HALAMAN KATEGORI MENU</b>
    </font>
</center>

<br>
<hr size="1" color="#E0E0E0">
<br>

<table width="80%" align="center" border="0">
    <tr>
        <td align="center">
            <font size="3" color="#555555" face="Arial">
                Biar kamu nggak bingung milih, menu di Foodify udah dibagi jadi tiga kategori besar. 
                <br>
                Mau yang ngenyangein, yang santai buat nyemil, atau sekadar minum sesuatu yang seger, tinggal pilih sesuai mood kamu!
            </font>
        </td>
    </tr>
</table>

<br><br>

<center>
    <font face="Verdana, sans-serif" color="#2980B9" size="4">
        <b>Daftar Kategori Kami</b>
    </font>
</center>

<br>

<table border="1" bordercolor="#E0E0E0" width="85%" align="center" cellpadding="10" cellspacing="0">
    <tr bgcolor="#E74C3C">
        <td width="5%" align="center"><font color="#FFFFFF"><b>No</b></font></td>
        <td width="25%" align="center"><font color="#FFFFFF"><b>Nama Kategori</b></font></td>
        <td width="55%" align="center"><font color="#FFFFFF"><b>Deskripsi</b></font></td>
        <td width="15%" align="center"><font color="#FFFFFF"><b>Jumlah Menu</b></font></td>
    </tr>

    <tr bgcolor="#FADBD8" align="center">
        <td><font color="#333333">1</font></td>
        <td><font color="#C0392B" size="3"><b>Makanan Berat</b></font></td>
        <td align="left">
            <font color="#333333" size="2">
                Buat yang lagi beneran lapar. Ada nasi goreng, ayam geprek,
                dan pilihan lain yang bikin kenyang tahan lama.
            </font>
        </td>
        <td><font color="#27AE60"><b>2 Menu</b></font></td>
    </tr>

    <tr bgcolor="#FCF3CF" align="center">
        <td><font color="#333333">2</font></td>
        <td><font color="#F39C12" size="3"><b>Snack & Cemilan</b></font></td>
        <td align="left">
            <font color="#333333" size="2">
                Pas buat nemenin nonton atau ngobrol santai.
                Burger dan kentang goreng jadi favorit di kategori ini.
            </font>
        </td>
        <td><font color="#27AE60"><b>1 Menu</b></font></td>
    </tr>

    <tr bgcolor="#D4E6F1" align="center">
        <td><font color="#333333">3</font></td>
        <td><font color="#2980B9" size="3"><b>Minuman</b></font></td>
        <td align="left">
            <font color="#333333" size="2">
                Dari es teh yang simpel sampai kopi susu gula aren yang bikin fokus balik lagi. Cocok diminum kapan aja.
            </font>
        </td>
        <td><font color="#27AE60"><b>2 Menu</b></font></td>
    </tr>
</table>

<br><br>

<center>
    <font face="Verdana, sans-serif" color="#2C3E50" size="4">
        <b>Detail & Range Harga per Kategori</b>
    </font>
</center>

<br>

<table border="1" bordercolor="#BDC3C7" width="85%" align="center" cellpadding="10" cellspacing="0">
    <tr bgcolor="#34495E">
        <td align="center"><font color="#FFFFFF"><b>Kategori</b></font></td>
        <td align="center"><font color="#FFFFFF"><b>Harga Termurah</b></font></td>
        <td align="center"><font color="#FFFFFF"><b>Harga Termahal</b></font></td>
        <td align="center"><font color="#FFFFFF"><b>Contoh Produk</b></font></td>
    </tr>

    <tr bgcolor="#FFFFFF" align="center">
        <td><font color="#333333"><b>Makanan Berat</b></font></td>
        <td><font color="#27AE60">Rp 18.000</font></td>
        <td><font color="#C0392B">Rp 25.000</font></td>
        <td><font color="#7F8C8D" size="2">Nasi Goreng, Ayam Geprek</font></td>
    </tr>

    <tr bgcolor="#ECF0F1" align="center">
        <td><font color="#333333"><b>Snack</b></font></td>
        <td><font color="#27AE60">Rp 15.000</font></td>
        <td><font color="#C0392B">Rp 30.000</font></td>
        <td><font color="#7F8C8D" size="2">Burger Sapi</font></td>
    </tr>

    <tr bgcolor="#FFFFFF" align="center">
        <td><font color="#333333"><b>Minuman</b></font></td>
        <td><font color="#27AE60">Rp 5.000</font></td>
        <td><font color="#C0392B">Rp 18.000</font></td>
        <td><font color="#7F8C8D" size="2">Es Teh Manis, Kopi Susu</font></td>
    </tr>
</table>

<br><br>

<center>
    <table border="0" cellpadding="10">
        <tr>
            <td bgcolor="#E67E22" align="center" width="150">
                <a href="{{ route('foodify.beranda') }}"><font color="#FFFFFF" face="Arial"><b>&laquo; Kembali ke Beranda</b></font></a>
            </td>
            <td width="20"></td>
            <td bgcolor="#3498DB" align="center" width="150">
                <a href="{{ route('foodify.produk') }}"><font color="#FFFFFF" face="Arial"><b>Lihat Katalog Produk &raquo;</b></font></a>
            </td>
        </tr>
    </table>
</center>
@endsection
