<?php
include "koneksi.php";

$query_produk = mysqli_query($conn, "SELECT * FROM produk ORDER BY id_produk DESC");

function gambarProduk($nama_produk)
{
    $nama = strtolower($nama_produk);

    if (strpos($nama, 'nasi goreng') !== false) {
        return 'images/nasi-goreng.png';
    } elseif (strpos($nama, 'kopi') !== false) {
        return 'images/kopi.png';
    } elseif (strpos($nama, 'ayam') !== false) {
        return 'images/ayam-geprek.png';
    } elseif (strpos($nama, 'burger') !== false) {
        return 'images/burger.png';
    } elseif (strpos($nama, 'es teh') !== false || strpos($nama, 'teh') !== false) {
        return 'images/es-teh.png';
    } else {
        return 'images/default.png';
    }
}
?>


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

        <?php
        $no = 1;

        if ($query_produk && mysqli_num_rows($query_produk) > 0) {
            while ($produk = mysqli_fetch_assoc($query_produk)) {
                $gambar = gambarProduk($produk['nama_produk']);
                ?>
                <tr align="center">
                    <td><?php echo $no++; ?></td>

                    <td>
                        <img src="<?php echo $gambar; ?>" alt="<?php echo $produk['nama_produk']; ?>" width="110" height="80">
                    </td>

                    <td align="left">
                        <b><?php echo $produk['nama_produk']; ?></b>
                    </td>

                    <td>
                        <?php echo $produk['kategori']; ?>
                    </td>

                    <td>
                        <b>Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></b>
                    </td>

                    <td align="left">
                        <?php echo $produk['deskripsi']; ?>
                    </td>

                    <td>
                        Tersedia
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr>";
            echo "<td colspan='7' align='center'>Belum ada produk yang tersedia.</td>";
            echo "</tr>";
        }
        ?>
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
        <a href="index.php?page=kategori">&larr; Kategori</a>
        &nbsp;
        <a href="index.php?page=profil">Profil &rarr;</a>
    </p>