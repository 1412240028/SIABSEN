<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Foodify - Website Penjualan Makanan</title>
</head>
<body bgcolor="#F4F4F9" text="#333333" link="#D35400" vlink="#D35400" alink="#FF8C00" topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">

    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <!-- Header -->
            <td colspan="2" bgcolor="#FF8C00" align="center" height="120" valign="middle" background="{{ asset('foodify_assets/images/header-bg.png') }}">
                <font face="Verdana, Arial, sans-serif" color="#FFFFFF">
                    <h1>🍽️ FOODIFY</h1>
                    <p><b>Jagonya Makanan Enak & Harga Pas di Kantong</b></p>
                </font>
            </td>
        </tr>

        <tr>
            <!-- Sidebar Navigasi -->
            <td width="200" valign="top" bgcolor="#34495E" height="600">
                <br>
                <center>
                    <font face="Arial, sans-serif" color="#F39C12" size="4">
                        <b>MENU UTAMA</b>
                    </font>
                </center>
                <br>
@include('modules.Foodify.navbar')

            </td>

            <!-- Area Konten Utama -->
            <td valign="top" bgcolor="{{ $bgColor ?? '#FFFFFF' }}">
                <table width="100%" border="0" cellpadding="30" cellspacing="0">
                    <tr>
                        <td valign="top">
                            <font face="Arial, sans-serif">
                                @yield('content')
                            </font>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <!-- Footer -->
            <td colspan="2" bgcolor="#2C3E50" align="center" height="60">
                <font face="Arial, sans-serif" color="#BDC3C7" size="2">
                    <i>&copy; 2026 Foodify - Platform Pemesanan Makanan Terpercaya.</i>
                </font>
            </td>
        </tr>
    </table>

</body>
</html>

