@extends('foodify.app', ['bgColor' => 'lightyellow'])

@php
/**
 * Hint untuk static analyzer: $data_edit diharapkan berupa object (mis. Model Member)
 * saat $edit_mode == true.
 *
 * Jika variabel benar-benar bisa null/false saat edit_mode, gunakan null-safe operator
 * di bagian HTML.
 */
function namaBulan($angka) {
    $bulan = [
        1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April",
        5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus",
        9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember"
    ];
    return $bulan[(int)$angka];
}

$tgl_edit = 1;
$bln_edit = 1;
$thn_edit = 2000;

if ($edit_mode && $data_edit) {
    $tanggal = explode("-", $data_edit->tanggal_lahir ?? '');

    // Aman untuk analyzer dan runtime
    $thn_edit = $tanggal[0] ?? 2000;
    $bln_edit = $tanggal[1] ?? 1;
    $tgl_edit = $tanggal[2] ?? 1;
}
@endphp

@section('content')
<center>
    <font face="Verdana, sans-serif" color="#C0392B" size="5">
        <b>HALAMAN PENDAFTARAN MEMBER</b>
    </font>
</center>

<br>
<hr size="1" color="#E0E0E0">
<br>

@if(session('success'))
<p align="center">
    <font color="#008000" face="Arial"><b>{{ session('success') }}</b></font>
</p>
@endif

<p align="center">
    <font size="3" color="#555555" face="Arial">
        Halo! Selamat datang di halaman pendaftaran <b>Foodify</b>.
    </font>
</p>

<p align="center">
    <font size="3" color="#555555" face="Arial">
        Yuk daftar jadi member Foodify agar kamu bisa mendapatkan pengalaman yang lebih mudah saat memesan makanan.
        Dengan menjadi member, data kamu akan tersimpan sehingga proses pemesanan bisa jadi lebih cepat dan praktis.
    </font>
</p>

<hr>

<center>
    <font face="Verdana, sans-serif" color="#2980B9" size="4">
        <b>Keuntungan Jadi Member Foodify</b>
    </font>
</center>

<br>

<table border="1" bordercolor="#E0E0E0" width="85%" align="center" cellpadding="10" cellspacing="0">
    <tr bgcolor="#34495E">
        <th><font color="#FFFFFF"><b>No</b></font></th>
        <th><font color="#FFFFFF"><b>Keuntungan</b></font></th>
        <th><font color="#FFFFFF"><b>Keterangan</b></font></th>
    </tr>

    <tr bgcolor="#FDFEFE" align="center">
        <td><font color="#333333"><b>1</b></font></td>
        <td><b><font color="#C0392B">Info Promo Duluan</font></b></td>
        <td align="left"><font color="#333333">Member dapet notifikasi promo sebelum diumumin ke publik.</font></td>
    </tr>

    <tr bgcolor="#F9EBDF" align="center">
        <td><font color="#333333"><b>2</b></font></td>
        <td><b><font color="#F39C12">Rekomendasi Personal</font></b></td>
        <td align="left"><font color="#333333">Saran menu yang disesuaikan sama preferensi dan riwayat ordermu.</font></td>
    </tr>

    <tr bgcolor="#ECF0F1" align="center">
        <td><font color="#333333"><b>3</b></font></td>
        <td><b><font color="#27AE60">Proses Order Lebih Cepat</font></b></td>
        <td align="left"><font color="#333333">Data tersimpan, jadi nggak perlu isi ulang info tiap mau pesan.</font></td>
    </tr>
</table>

<br>

<center>
    <font face="Verdana, sans-serif" color="#2C3E50" size="4">
        <b>
            {{ $edit_mode ? 'Form Edit Member' : 'Form Pendaftaran Member' }}
        </b>
    </font>
</center>

<br>

<form action="{{ $edit_mode ? route('foodify.pendaftaran.update') : route('foodify.pendaftaran.store') }}" method="post">
    @csrf

    <table border="1" bordercolor="#E0E0E0" width="85%" align="center" cellpadding="10" cellspacing="0">
        @if ($edit_mode)
            <input type="hidden" name="id_member" value="{{ $data_edit->id_member ?? '' }}">
        @endif

        <tr bgcolor="#FDFEFE">
            <th width="180" align="left"><font color="#34495E"><b>Nama Lengkap</b></font></th>
            <td>
                <input type="text" name="nama" size="50" required
                    value="{{ $edit_mode ? ($data_edit->nama ?? '') : '' }}">
            </td>
        </tr>

        <tr bgcolor="#FDFEFE">
            <th align="left"><font color="#34495E"><b>Email</b></font></th>
            <td>
                <input type="email" name="email" size="50" required
                    value="{{ $edit_mode ? ($data_edit->email ?? '') : '' }}">
            </td>
        </tr>

        <tr bgcolor="#FDFEFE">
            <th align="left"><font color="#34495E"><b>Nomor HP</b></font></th>
            <td>
                <input type="text" name="nohp" size="30" required
                    value="{{ $edit_mode ? ($data_edit->nohp ?? '') : '' }}">
            </td>
        </tr>

        <tr bgcolor="#FDFEFE">
            <th align="left"><font color="#34495E"><b>Alamat</b></font></th>
            <td>
                <textarea name="alamat" rows="4" cols="52" required>{{ $edit_mode ? ($data_edit->alamat ?? '') : '' }}</textarea>
            </td>
        </tr>

        <tr bgcolor="#FDFEFE">
            <th align="left"><font color="#34495E"><b>Jenis Kelamin</b></font></th>
            <td>
                <input type="radio" name="jk" value="Laki-laki"
                    {{ (!$edit_mode || ($data_edit->jenis_kelamin ?? '') == 'Laki-laki') ? 'checked' : '' }}>
                Laki-laki

                &nbsp;&nbsp;

                <input type="radio" name="jk" value="Perempuan"
                    {{ ($edit_mode && ($data_edit->jenis_kelamin ?? '') == 'Perempuan') ? 'checked' : '' }}>
                Perempuan
            </td>
        </tr>

        <tr bgcolor="#FDFEFE">
            <th align="left"><font color="#34495E"><b>Tanggal Lahir</b></font></th>
            <td>
                <select name="tgl">
                    @for ($i = 1; $i <= 31; $i++)
                        <option value="{{ $i }}" {{ ($i == (int)$tgl_edit) ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>

                <select name="bln">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ ($i == (int)$bln_edit) ? 'selected' : '' }}>
                            {{ namaBulan($i) }}
                        </option>
                    @endfor
                </select>

                <select name="thn">
                    @for ($y = 1990; $y <= 2030; $y++)
                        <option value="{{ $y }}" {{ ($y == (int)$thn_edit) ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </td>
        </tr>

        <tr bgcolor="#ECF0F1">
            <td colspan="2" align="center">
                @if ($edit_mode)
                    <input type="submit" name="update" value="Update Member">
                    &nbsp;
                    <a href="{{ route('foodify.pendaftaran') }}">Batal</a>
                @else
                    <input type="submit" name="tambah" value="Daftar Member">
                    &nbsp;
                    <input type="reset" value="Reset">
                @endif
            </td>
        </tr>
    </table>
</form>

<br>
<hr>

<center>
    <font face="Verdana, sans-serif" color="#2980B9" size="4">
        <b>Daftar Member Foodify</b>
    </font>
</center>

<br>

<table border="1" bordercolor="#E0E0E0" width="90%" align="center" cellpadding="10" cellspacing="0">
    <tr bgcolor="#34495E">
        <th><font color="#FFFFFF"><b>No</b></font></th>
        <th><font color="#FFFFFF"><b>Nama Lengkap</b></font></th>
        <th><font color="#FFFFFF"><b>Email</b></font></th>
        <th><font color="#FFFFFF"><b>Nomor HP</b></font></th>
        <th><font color="#FFFFFF"><b>Alamat</b></font></th>
        <th><font color="#FFFFFF"><b>Jenis Kelamin</b></font></th>
        <th><font color="#FFFFFF"><b>Tanggal Lahir</b></font></th>
        <th><font color="#FFFFFF"><b>Aksi</b></font></th>
    </tr>

    @forelse ($members as $index => $member)
        <tr align="center" bgcolor="#FDFEFE">
            <td><font color="#333333"><b>{{ $index + 1 }}</b></font></td>
            <td align="left"><b><font color="#2C3E50">{{ $member->nama }}</font></b></td>
            <td><font color="#34495E">{{ $member->email }}</font></td>
            <td><font color="#34495E">{{ $member->nohp }}</font></td>
            <td align="left"><font color="#34495E">{{ $member->alamat }}</font></td>
            <td><font color="#34495E">{{ $member->jenis_kelamin }}</font></td>
            <td><font color="#34495E">{{ $member->tanggal_lahir }}</font></td>
            <td>
                <a href="{{ route('foodify.pendaftaran', ['edit' => $member->id_member]) }}">Edit</a>
                |
                <a href="{{ route('foodify.pendaftaran.delete', ['hapus' => $member->id_member]) }}"
                   onclick="return confirm('Yakin ingin menghapus member ini?')">
                    Hapus
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" align="center">
                <font color="#34495E">Belum ada data member</font>
            </td>
        </tr>
    @endforelse
</table>

<br>

<center>
    <table border="0" cellpadding="10">
        <tr>
            <td bgcolor="#3498DB" align="center" width="150">
                <a href="{{ route('foodify.profil') }}"><font color="#FFFFFF" face="Arial"><b>&larr; Profil</b></font></a>
            </td>
            <td width="20"></td>
            <td bgcolor="#E67E22" align="center" width="150">
                <a href="{{ route('foodify.beranda') }}"><font color="#FFFFFF" face="Arial"><b>Beranda &rarr;</b></font></a>
            </td>
        </tr>
    </table>
</center>
@endsection

