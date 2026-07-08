@extends('foodify.app', ['bgColor' => 'pink'])

@section('content')
<h2 align="center">PROFIL FOODIFY</h2>
<hr>

<p align="center">
    Kenalan lebih dekat sama <b>Foodify</b>, platform yang siap bantu
    penuhi kebutuhan perut kamu kapan aja.
</p>

<hr>

<h3 align="center">Visi &amp; Misi Kami</h3>

<table border="1" width="700" align="center" cellpadding="8" cellspacing="0">
    <tr bgcolor="orange">
        <th>Visi</th>
        <th>Misi</th>
    </tr>

    <tr align="center" valign="top">
        <td align="left">
            Menjadi platform pemesanan makanan nomor satu yang paling ngerti selera
            dan dompet pelajar serta mahasiswa.
        </td>
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

<h3 align="center">Tim di Balik Foodify</h3>

<table border="1" width="700" align="center" cellpadding="8" cellspacing="0">
    <tr>
        <th width="200">Bagian</th>
        <th>Tanggung Jawab</th>
    </tr>

    <tr align="center">
        <td><b>Dapur &amp; Koki</b></td>
        <td align="left">Memastikan tiap masakan punya rasa yang konsisten dan enak.</td>
    </tr>

    <tr align="center">
        <td><b>Customer Service</b></td>
        <td align="left">Siap bantu kalau ada keluhan atau request khusus dari pelanggan.</td>
    </tr>

    <tr align="center">
        <td><b>Kurir &amp; Pengiriman</b></td>
        <td align="left">Berusaha sampai tepat waktu biar makanan nggak keburu dingin.</td>
    </tr>
</table>

<br>

<h3 align="center">Kontak Kami</h3>

<table border="1" width="700" align="center" cellpadding="8" cellspacing="0">
    <tr align="center">
        <td width="33%">
            <b>WhatsApp:</b><br>
            0812-3456-7890
        </td>
        <td width="33%">
            <b>Email:</b><br>
            halo@foodify.com
        </td>
        <td width="33%">
            <b>Instagram:</b><br>
            @foodify.id
        </td>
    </tr>
</table>

<br>

<p align="center">
    <a href="{{ route('foodify.produk') }}">&larr; Produk</a>
    &nbsp;&nbsp;
    <a href="{{ route('foodify.pendaftaran') }}">Pendaftaran &rarr;</a>
</p>
@endsection
