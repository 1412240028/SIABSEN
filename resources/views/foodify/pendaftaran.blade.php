@extends('foodify.app', ['bgColor' => 'lightyellow'])

@php
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
    $tanggal = explode("-", $data_edit->tanggal_lahir);
    $thn_edit = $tanggal[0];
    $bln_edit = $tanggal[1];
    $tgl_edit = $tanggal[2];
}
@endphp

@section('content')
<h2 align="center">HALAMAN PENDAFTARAN MEMBER</h2>
<hr>

@if(session('success'))
<p align="center"><font color="#008000" face="Arial"><b>{{ session('success') }}</b></font></p>
@endif

<p align="center">
    Halo! Selamat datang di halaman pendaftaran <b>Foodify</b>.
</p>

<p align="center">
    Yuk daftar jadi member Foodify agar kamu bisa mendapatkan pengalaman yang lebih mudah saat memesan makanan.
    Dengan menjadi member, data kamu akan tersimpan sehingga proses pemesanan bisa jadi lebih cepat dan praktis.
</p>

<hr>

<h3 align="center">Keuntungan Jadi Member Foodify</h3>

<table border="1" width="700" align="center" cellpadding="6" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Keuntungan</th>
        <th>Keterangan</th>
    </tr>

    <tr align="center">
        <td>1</td>
        <td><b>Info Promo Duluan</b></td>
        <td align="left">Member dapet notifikasi promo sebelum diumumin ke publik.</td>
    </tr>

    <tr align="center">
        <td>2</td>
        <td><b>Rekomendasi Personal</b></td>
        <td align="left">Saran menu yang disesuaikan sama preferensi dan riwayat ordermu.</td>
    </tr>

    <tr align="center">
        <td>3</td>
        <td><b>Proses Order Lebih Cepet</b></td>
        <td align="left">Data tersimpan, jadi nggak perlu isi ulang info tiap mau pesan.</td>
    </tr>
</table>

<br>

<h3 align="center">
    {{ $edit_mode ? "Form Edit Member" : "Form Pendaftaran Member" }}
</h3>

<form action="{{ $edit_mode ? route('foodify.pendaftaran.update') : route('foodify.pendaftaran.store') }}" method="post">
    @csrf
    <table border="1" width="700" align="center" cellpadding="6" cellspacing="0">

        @if ($edit_mode)
            <input type="hidden" name="id_member" value="{{ $data_edit->id_member }}">
        @endif

        <tr>
            <th width="180">Nama Lengkap</th>
            <td>
                <input type="text" name="nama" size="50" required
                       value="{{ $edit_mode ? $data_edit->nama : '' }}">
            </td>
        </tr>

        <tr>
            <th>Email</th>
            <td>
                <input type="email" name="email" size="50" required
                       value="{{ $edit_mode ? $data_edit->email : '' }}">
            </td>
        </tr>

        <tr>
            <th>Nomor HP</th>
            <td>
                <input type="text" name="nohp" size="30" required
                       value="{{ $edit_mode ? $data_edit->nohp : '' }}">
            </td>
        </tr>

        <tr>
            <th>Alamat</th>
            <td>
                <textarea name="alamat" rows="4" cols="52" required>{{ $edit_mode ? $data_edit->alamat : '' }}</textarea>
            </td>
        </tr>

        <tr>
            <th>Jenis Kelamin</th>
            <td>
                <input type="radio" name="jk" value="Laki-laki"
                    {{ (!$edit_mode || $data_edit->jenis_kelamin == 'Laki-laki') ? 'checked' : '' }}>
                Laki-laki

                &nbsp;&nbsp;

                <input type="radio" name="jk" value="Perempuan"
                    {{ ($edit_mode && $data_edit->jenis_kelamin == 'Perempuan') ? 'checked' : '' }}>
                Perempuan
            </td>
        </tr>

        <tr>
            <th>Tanggal Lahir</th>
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

        <tr>
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

<h3 align="center">Daftar Member Foodify</h3>

<table border="1" width="900" align="center" cellpadding="6" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Lengkap</th>
        <th>Email</th>
        <th>Nomor HP</th>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
        <th>Tanggal Lahir</th>
        <th>Aksi</th>
    </tr>

    @forelse ($members as $index => $member)
        <tr align="center">
            <td>{{ $index + 1 }}</td>
            <td align="left"><b>{{ $member->nama }}</b></td>
            <td>{{ $member->email }}</td>
            <td>{{ $member->nohp }}</td>
            <td align="left">{{ $member->alamat }}</td>
            <td>{{ $member->jenis_kelamin }}</td>
            <td>{{ $member->tanggal_lahir }}</td>
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
            <td colspan="8" align="center">Belum ada data member</td>
        </tr>
    @endforelse
</table>

<br>

<p align="center">
    <a href="{{ route('foodify.profil') }}">&larr; Profil</a>
    &nbsp;
    <a href="{{ route('foodify.beranda') }}">Beranda &rarr;</a>
</p>
@endsection
