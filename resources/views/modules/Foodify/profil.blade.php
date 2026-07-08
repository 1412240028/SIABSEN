@extends('modules.Foodify.app', ['bgColor' => 'pink'])

@section('content')
<center>
    <font face="Verdana, sans-serif" color="#27AE60" size="5">
        <b>PROFIL FOODIFY</b>
    </font>
</center>

<br>
<hr size="1" color="#E0E0E0">
<br>

<p align="center">
    <font face="Arial, sans-serif" color="#34495E" size="3">
        Kenalan lebih dekat sama <b>Foodify</b>, platform yang siap bantu
        penuhi kebutuhan perut kamu kapan aja.
    </font>
</p>

<hr>

<center>
    <font face="Verdana, sans-serif" color="#2C3E50" size="4">
        <b>Visi &amp; Misi Kami</b>
    </font>
</center>

<br>

<table border="1" bordercolor="#E0E0E0" width="85%" align="center" cellpadding="10" cellspacing="0">
    <tr bgcolor="orange">
        <th><font color="#FFFFFF"><b>Visi</b></font></th>
        <th><font color="#FFFFFF"><b>Misi</b></font></th>
    </tr>

    <tr align="center" valign="top" bgcolor="#FDFEFE">
        <td align="center"><font color="#34495E">
            Menjadi platform pemesanan makanan nomor satu yang paling ngerti selera
            dan dompet pelajar serta mahasiswa.
        </font></td>
        <td align="left">
            <ul>
                <li>Ngasih pilihan makanan lezat dengan harga jujur.</li>
                <li>Membuat proses pemesanan jadi super gampang.</li>
                <li>Menjamin kebersihan dan kecepatan layanan.</li>
            </ul>
        </td>
    </tr>
</table>

<br>

<center>
    <font face="Verdana, sans-serif" color="#2C3E50" size="4">
        <b>Tim di Balik Foodify</b>
    </font>
</center>

<br>

<table border="1" bordercolor="#E0E0E0" width="85%" align="center" cellpadding="10" cellspacing="0">
    <tr bgcolor="orange">
        <th width="25%"><font color="#FFFFFF"><b>Bagian</b></font></th>
        <th><font color="#FFFFFF"><b>Tanggung Jawab</b></font></th>
    </tr>

    <tr align="center" bgcolor="#FDFEFE">
        <td><b><font color="#2C3E50">Dapur &amp; Koki</font></b></td>
        <td align="left"><font color="#34495E">Memastikan tiap masakan punya rasa yang konsisten dan enak.</font></td>
    </tr>

    <tr align="center" bgcolor="#F9EBDF">
        <td><b><font color="#2C3E50">Customer Service</font></b></td>
        <td align="left"><font color="#34495E">Siap bantu kalau ada keluhan atau request khusus dari pelanggan.</font></td>
    </tr>

    <tr align="center" bgcolor="#FCF3CF">
        <td><b><font color="#2C3E50">Kurir &amp; Pengiriman</font></b></td>
        <td align="left"><font color="#34495E">Berusaha sampai tepat waktu biar makanan nggak keburu dingin.</font></td>
    </tr>
</table>

<br>

<center>
    <font face="Verdana, sans-serif" color="#2C3E50" size="4">
        <b>Kontak Kami</b>
    </font>
</center>

<br>

<table border="1" bordercolor="#E0E0E0" width="85%" align="center" cellpadding="10" cellspacing="0">
    <tr align="center" bgcolor="#FDFEFE">
        <td width="33%"><font color="#34495E"><b>WhatsApp:</b></font><br>0812-3456-7890</td>
        <td width="33%"><font color="#34495E"><b>Email:</b></font><br>foodify@gmail.com</td>
        <td width="33%"><font color="#34495E"><b>Instagram:</b></font><br>@foodifyid</td>
    </tr>
</table>

<br>

<center>
    <table border="0" cellpadding="10">
        <tr>
            <td bgcolor="#3498DB" align="center" width="150">
                <a href="{{ route('foodify.produk') }}"><font color="#FFFFFF" face="Arial"><b>&laquo; Produk</b></font></a>
            </td>
            <td width="20"></td>
            <td bgcolor="#E67E22" align="center" width="150">
                <a href="{{ route('foodify.pendaftaran') }}"><font color="#FFFFFF" face="Arial"><b>Pendaftaran &raquo;</b></font></a>
            </td>
        </tr>
    </table>
</center>
@endsection

