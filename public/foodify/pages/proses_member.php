<?php
include "../koneksi.php";

$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$nohp = trim($_POST['nohp'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$jk = $_POST['jk'] ?? '';
$tgl = $_POST['tgl'] ?? '';
$bln = $_POST['bln'] ?? '';
$thn = $_POST['thn'] ?? '';
$setuju = isset($_POST['setuju']) ? $_POST['setuju'] : '';

$errors = [];

if ($nama == '') {
    $errors[] = "Nama Lengkap tidak boleh kosong.";
}

if ($email == '') {
    $errors[] = "Email tidak boleh kosong.";
}

if ($nohp == '') {
    $errors[] = "Nomor HP tidak boleh kosong.";
}

if ($alamat == '') {
    $errors[] = "Alamat tidak boleh kosong.";
}

if ($email != '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Format Email tidak valid.";
}

if ($nohp != '' && !is_numeric($nohp)) {
    $errors[] = "Nomor HP harus berupa angka.";
}

if (!checkdate((int) $bln, (int) $tgl, (int) $thn)) {
    $errors[] = "Tanggal lahir tidak valid.";
}

if ($setuju == '') {
    $errors[] = "Anda harus menyetujui syarat dan ketentuan.";
}

if (!empty($errors)) {
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Gagal - Foodify</title>
</head>

<body bgcolor="lightyellow">

    <h2>PENDAFTARAN MEMBER GAGAL</h2>
    <hr>

    <p>
        Formulir pendaftaran belum diisi dengan benar.
        Silakan perbaiki beberapa kesalahan berikut.
    </p>

    <hr>

    <h3 align="center">Daftar Kesalahan</h3>

    <table border="1" width="700" align="center" cellpadding="6" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Keterangan Kesalahan</th>
        </tr>

        <?php
        $no = 1;
        foreach ($errors as $error):
        ?>
            <tr>
                <td align="center"><?= $no++; ?></td>
                <td><?= htmlspecialchars($error); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>

    <p align="center">
        <input type="button" value="Kembali ke Form" onclick="history.back()">
    </p>

</body>
</html>

<?php
    exit();
}

$tanggal_lahir_db = $thn . "-" . $bln . "-" . $tgl;

$nama_safe = mysqli_real_escape_string($conn, $nama);
$email_safe = mysqli_real_escape_string($conn, $email);
$nohp_safe = mysqli_real_escape_string($conn, $nohp);
$alamat_safe = mysqli_real_escape_string($conn, $alamat);
$jk_safe = mysqli_real_escape_string($conn, $jk);
$tanggal_lahir_safe = mysqli_real_escape_string($conn, $tanggal_lahir_db);

$query = "INSERT INTO member 
          (nama, email, nohp, alamat, jenis_kelamin, tanggal_lahir)
          VALUES 
          ('$nama_safe', '$email_safe', '$nohp_safe', '$alamat_safe', '$jk_safe', '$tanggal_lahir_safe')";

$simpan = mysqli_query($conn, $query);

if (!$simpan) {
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Gagal Menyimpan Data - Foodify</title>
</head>

<body bgcolor="lightyellow">

    <h2>DATA MEMBER GAGAL DISIMPAN</h2>
    <hr>

    <p>Terjadi kesalahan saat menyimpan data ke database.</p>

    <table border="1" width="700" align="center" cellpadding="6" cellspacing="0">
        <tr>
            <th>Keterangan Error</th>
        </tr>
        <tr>
            <td><?= mysqli_error($conn); ?></td>
        </tr>
    </table>

    <br>

    <p align="center">
        <input type="button" value="Kembali ke Form" onclick="history.back()">
    </p>

</body>
</html>

<?php
    exit();
}

$nama_bulan = [
    1 => "Januari",
    2 => "Februari",
    3 => "Maret",
    4 => "April",
    5 => "Mei",
    6 => "Juni",
    7 => "Juli",
    8 => "Agustus",
    9 => "September",
    10 => "Oktober",
    11 => "November",
    12 => "Desember"
];

$tanggal_lahir = $tgl . " " . $nama_bulan[(int)$bln] . " " . $thn;
$tanggal_daftar = date('d-m-Y');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Berhasil - Foodify</title>
</head>

<body bgcolor="lightgreen">

    <h2>PENDAFTARAN MEMBER BERHASIL</h2>
    <hr>

    <p>
        Terima kasih telah mendaftar sebagai member <b>Foodify</b>.
        Data member berhasil disimpan ke database.
    </p>

    <hr>

    <h3 align="center">Data Member Foodify</h3>

    <table border="1" width="700" align="center" cellpadding="6" cellspacing="0">
        <tr>
            <th width="180">Nama Lengkap</th>
            <td><?= htmlspecialchars($nama); ?></td>
        </tr>

        <tr>
            <th>Email</th>
            <td><?= htmlspecialchars($email); ?></td>
        </tr>

        <tr>
            <th>Nomor HP</th>
            <td><?= htmlspecialchars($nohp); ?></td>
        </tr>

        <tr>
            <th>Alamat</th>
            <td><?= htmlspecialchars($alamat); ?></td>
        </tr>

        <tr>
            <th>Jenis Kelamin</th>
            <td><?= htmlspecialchars($jk); ?></td>
        </tr>

        <tr>
            <th>Tanggal Lahir</th>
            <td><?= $tanggal_lahir; ?></td>
        </tr>

        <tr>
            <th>Tanggal Daftar</th>
            <td><?= $tanggal_daftar; ?></td>
        </tr>
    </table>

    <br>

    <h3 align="center">Status Pendaftaran</h3>

    <table border="1" width="700" align="center" cellpadding="6" cellspacing="0">
        <tr>
            <th>Status</th>
            <th>Keterangan</th>
        </tr>

        <tr align="center">
            <td><b>Berhasil</b></td>
            <td align="left">
                Data member telah berhasil divalidasi dan disimpan ke database Foodify.
            </td>
        </tr>
    </table>

    <br>

    <p align="center">
        <a href="pendaftaran.php" target="konten">&larr; Kembali ke Pendaftaran</a>
        &nbsp;
        <a href="beranda.html" target="konten">Beranda &rarr;</a>
    </p>

</body>
</html>