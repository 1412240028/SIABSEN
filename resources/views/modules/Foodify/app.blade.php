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
          @include('modules.Foodify.navbar')
        </td>

        <!-- Area Konten Utama -->
        <td valign="top" bgcolor="{{ $bgColor ?? 'white' }}">
          @yield('content')
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
