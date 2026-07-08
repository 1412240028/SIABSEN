<?php
include "koneksi.php";

function namaBulan($angka) {
    $bulan = [
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

    return $bulan[(int)$angka];
}

if (isset($_POST['tambah'])) {
    $nama   = trim($_POST['nama']);
    $email  = trim($_POST['email']);
    $nohp   = trim($_POST['nohp']);
    $alamat = trim($_POST['alamat']);
    $jk     = $_POST['jk'];

    $tgl = $_POST['tgl'];
    $bln = $_POST['bln'];
    $thn = $_POST['thn'];

    $tanggal_lahir = $thn . "-" . $bln . "-" . $tgl;

    $stmt = mysqli_prepare($conn, "INSERT INTO member (nama, email, nohp, alamat, jenis_kelamin, tanggal_lahir) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssss", $nama, $email, $nohp, $alamat, $jk, $tanggal_lahir);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Member berhasil ditambahkan'); window.location='index.php?page=pendaftaran';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan member');</script>";
    }
    mysqli_stmt_close($stmt);
}

if (isset($_POST['update'])) {
    $id_member = (int)$_POST['id_member'];
    $nama      = trim($_POST['nama']);
    $email     = trim($_POST['email']);
    $nohp      = trim($_POST['nohp']);
    $alamat    = trim($_POST['alamat']);
    $jk        = $_POST['jk'];

    $tgl = $_POST['tgl'];
    $bln = $_POST['bln'];
    $thn = $_POST['thn'];

    $tanggal_lahir = $thn . "-" . $bln . "-" . $tgl;

    $stmt = mysqli_prepare($conn, "UPDATE member SET nama = ?, email = ?, nohp = ?, alamat = ?, jenis_kelamin = ?, tanggal_lahir = ? WHERE id_member = ?");
    mysqli_stmt_bind_param($stmt, "ssssssi", $nama, $email, $nohp, $alamat, $jk, $tanggal_lahir, $id_member);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Member berhasil diubah'); window.location='index.php?page=pendaftaran';</script>";
    } else {
        echo "<script>alert('Gagal mengubah member');</script>";
    }
    mysqli_stmt_close($stmt);
}

if (isset($_GET['hapus'])) {
    $id_member = (int)$_GET['hapus'];

    $stmt = mysqli_prepare($conn, "DELETE FROM member WHERE id_member = ?");
    mysqli_stmt_bind_param($stmt, "i", $id_member);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Member berhasil dihapus'); window.location='index.php?page=pendaftaran';</script>";
    } else {
        echo "<script>alert('Gagal menghapus member');</script>";
    }
    mysqli_stmt_close($stmt);
}

$edit_mode = false;
$data_edit = null;

$tgl_edit = 1;
$bln_edit = 1;
$thn_edit = 2000;

if (isset($_GET['edit'])) {
    $id_member = (int)$_GET['edit'];
    $stmt_edit = mysqli_prepare($conn, "SELECT * FROM member WHERE id_member = ?");
    mysqli_stmt_bind_param($stmt_edit, "i", $id_member);
    mysqli_stmt_execute($stmt_edit);
    $result_edit = mysqli_stmt_get_result($stmt_edit);

    if (mysqli_num_rows($result_edit) > 0) {
        $edit_mode = true;
        $data_edit = mysqli_fetch_assoc($result_edit);

        $tanggal = explode("-", $data_edit['tanggal_lahir']);
        $thn_edit = $tanggal[0];
        $bln_edit = $tanggal[1];
        $tgl_edit = $tanggal[2];
    }
    mysqli_stmt_close($stmt_edit);
}
?>


    <h2 align="center">HALAMAN PENDAFTARAN MEMBER</h2>
    <hr>

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
        <?php echo $edit_mode ? "Form Edit Member" : "Form Pendaftaran Member"; ?>
    </h3>

    <form action="" method="post">
        <table border="1" width="700" align="center" cellpadding="6" cellspacing="0">

            <?php if ($edit_mode): ?>
                <input type="hidden" name="id_member" value="<?php echo $data_edit['id_member']; ?>">
            <?php endif; ?>

            <tr>
                <th width="180">Nama Lengkap</th>
                <td>
                    <input type="text" name="nama" size="50" required
                           value="<?php echo $edit_mode ? $data_edit['nama'] : ''; ?>">
                </td>
            </tr>

            <tr>
                <th>Email</th>
                <td>
                    <input type="email" name="email" size="50" required
                           value="<?php echo $edit_mode ? $data_edit['email'] : ''; ?>">
                </td>
            </tr>

            <tr>
                <th>Nomor HP</th>
                <td>
                    <input type="text" name="nohp" size="30" required
                           value="<?php echo $edit_mode ? $data_edit['nohp'] : ''; ?>">
                </td>
            </tr>

            <tr>
                <th>Alamat</th>
                <td>
                    <textarea name="alamat" rows="4" cols="52" required><?php echo $edit_mode ? $data_edit['alamat'] : ''; ?></textarea>
                </td>
            </tr>

            <tr>
                <th>Jenis Kelamin</th>
                <td>
                    <input type="radio" name="jk" value="Laki-laki"
                        <?php echo (!$edit_mode || $data_edit['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?>>
                    Laki-laki

                    &nbsp;&nbsp;

                    <input type="radio" name="jk" value="Perempuan"
                        <?php echo ($edit_mode && $data_edit['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?>>
                    Perempuan
                </td>
            </tr>

            <tr>
                <th>Tanggal Lahir</th>
                <td>
                    <select name="tgl">
                        <?php for ($i = 1; $i <= 31; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php echo ($i == (int)$tgl_edit) ? 'selected' : ''; ?>>
                                <?php echo $i; ?>
                            </option>
                        <?php endfor; ?>
                    </select>

                    <select name="bln">
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php echo ($i == (int)$bln_edit) ? 'selected' : ''; ?>>
                                <?php echo namaBulan($i); ?>
                            </option>
                        <?php endfor; ?>
                    </select>

                    <select name="thn">
                        <?php for ($y = 1990; $y <= 2030; $y++): ?>
                            <option value="<?php echo $y; ?>" <?php echo ($y == (int)$thn_edit) ? 'selected' : ''; ?>>
                                <?php echo $y; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <?php if ($edit_mode): ?>
                        <input type="submit" name="update" value="Update Member">
                        &nbsp;
                        <a href="index.php?page=pendaftaran">Batal</a>
                    <?php else: ?>
                        <input type="submit" name="tambah" value="Daftar Member">
                        &nbsp;
                        <input type="reset" value="Reset">
                    <?php endif; ?>
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

        <?php
        $no = 1;
        $query_member = mysqli_query($conn, "SELECT * FROM member ORDER BY id_member DESC");

        if (mysqli_num_rows($query_member) > 0) {
            while ($member = mysqli_fetch_assoc($query_member)) {
        ?>
                <tr align="center">
                    <td><?php echo $no++; ?></td>
                    <td align="left"><b><?php echo $member['nama']; ?></b></td>
                    <td><?php echo $member['email']; ?></td>
                    <td><?php echo $member['nohp']; ?></td>
                    <td align="left"><?php echo $member['alamat']; ?></td>
                    <td><?php echo $member['jenis_kelamin']; ?></td>
                    <td><?php echo $member['tanggal_lahir']; ?></td>
                    <td>
                        <a href="index.php?page=pendaftaran&edit=<?php echo $member['id_member']; ?>">Edit</a>
                        |
                        <a href="index.php?page=pendaftaran&hapus=<?php echo $member['id_member']; ?>"
                           onclick="return confirm('Yakin ingin menghapus member ini?')">
                            Hapus
                        </a>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr>";
            echo "<td colspan='8' align='center'>Belum ada data member</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br>

    <p align="center">
        <a href="index.php?page=profil">&larr; Profil</a>
        &nbsp;
        <a href="index.php?page=beranda">Beranda &rarr;</a>
    </p>