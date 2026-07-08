<?php
// Ambil query parameter page, default ke 'beranda'
$page = $_GET['page'] ?? 'beranda';

// Konfigurasi warna latar belakang konten berdasarkan halaman yang aktif
$bg_colors = [
    'beranda'     => 'lightgreen',
    'kategori'    => 'red',
    'produk'      => 'lightblue',
    'profil'      => 'pink',
    'pendaftaran' => 'lightyellow'
];
$bg_color = $bg_colors[$page] ?? 'white';

// Map halaman yang valid
$valid_pages = [
    'beranda'     => 'pages/beranda.html',
    'kategori'    => 'pages/kategori.html',
    'produk'      => 'pages/produk.php',
    'profil'      => 'pages/profil.html',
    'pendaftaran' => 'pages/pendaftaran.php'
];

$content_file = $valid_pages[$page] ?? 'pages/beranda.html';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Foodify - Website Penjualan Makanan</title>
</head>
<body>
    <!-- Header -->
    <table width="100%" border="1" cellpadding="10" cellspacing="0">
      <tr>
        <td align="center">
          <h1>FOODIFY</h1>
          <p>Website Penjualan Makanan Online</p>
        </td>
      </tr>
    </table>

    <!-- Main Content & Sidebar -->
    <table width="100%" border="1" cellpadding="10" cellspacing="0">
      <tr>
        <!-- Sidebar Navigasi -->
        <td width="150" valign="top" bgcolor="orange">
          <?php include "pages/navbar.php"; ?>
        </td>

        <!-- Area Konten Utama -->
        <td valign="top" bgcolor="<?php echo $bg_color; ?>">
          <?php 
          if (file_exists($content_file)) {
              include $content_file;
          } else {
              echo "<h2>Halaman tidak ditemukan!</h2>";
          }
          ?>
        </td>
      </tr>
    </table>

    <!-- Footer -->
    <table width="100%" border="1" cellpadding="10" cellspacing="0">
      <tr>
        <td align="center">
          <i>&copy; 2026 Foodify - Food Marketplace</i>
        </td>
      </tr>
    </table>
</body>
</html>
