<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Akademik — UTS & UAS Project</title>
    <meta name="description" content="Portal navigasi project UTS (Foodify) dan UAS (Siabsen) — Final Exam Submission">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root{
            --bg:#0b1220;
            --card:#0f1b33;
            --text:#e7eaf0;
            --muted:#aab2c5;
            --border:rgba(255,255,255,.10);
            --shadow: 0 14px 40px rgba(0,0,0,.35);
            --accent-uts:#ff6b35;
            --accent-uas:#6366f1;
        }
        *{box-sizing:border-box;margin:0;padding:0}
        body{
            font-family:Inter,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Arial,sans-serif;
            background: linear-gradient(180deg, #070b14 0%, var(--bg) 100%);
            color:var(--text);
            min-height:100vh;
        }

        .wrap{
            max-width:980px;
            margin:0 auto;
            padding:56px 16px;
        }

        .header{
            text-align:center;
            margin-bottom:28px;
        }
        .badge{
            display:inline-flex;
            align-items:center;
            gap:10px;
            background:rgba(255,255,255,.06);
            border:1px solid var(--border);
            padding:10px 16px;
            border-radius:999px;
            color:var(--muted);
            font-weight:600;
            letter-spacing:.02em;
            margin-bottom:14px;
        }
        .badge-dot{width:10px;height:10px;border-radius:50%;background:#22c55e;display:inline-block}
        h1{
            font-size:clamp(2rem,4vw,3rem);
            line-height:1.1;
            margin-bottom:10px;
            text-align:center;
        }
        .subtitle{
            color:var(--muted);
            max-width:620px;
            margin:0 auto;
            line-height:1.6;
            font-size:1rem;
        }

        .grid{
            display:grid;
            grid-template-columns:1fr;
            gap:16px;
            margin-top:22px;
        }
        @media (min-width:768px){
            .grid{grid-template-columns:repeat(2,1fr);}
        }

        .card{
            background:var(--card);
            border:1px solid var(--border);
            border-radius:18px;
            padding:22px;
            text-decoration:none;
            color:inherit;
            box-shadow: var(--shadow);
            transition: transform .15s ease, border-color .15s ease;
        }
        .card:hover{
            transform: translateY(-3px);
            border-color: rgba(255,255,255,.18);
        }

        .card-top{
            display:flex;
            align-items:center;
            gap:10px;
            margin-bottom:12px;
        }
        .pill{
            font-size:.8rem;
            font-weight:700;
            padding:8px 12px;
            border-radius:999px;
            border:1px solid var(--border);
            background: rgba(255,255,255,.04);
        }
        .icon{
            width:52px;height:52px;border-radius:14px;
            display:flex;align-items:center;justify-content:center;
            border:1px solid var(--border);
            background: rgba(255,255,255,.04);
            font-size:1.6rem;
        }
        .card h2{font-size:1.6rem;margin:4px 0 10px;}
        .desc{color:var(--muted);line-height:1.65;margin-bottom:14px;}

        .tags{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;}
        .tag{
            font-size:.8rem;
            padding:8px 10px;
            border-radius:12px;
            border:1px solid var(--border);
            background: rgba(255,255,255,.03);
            color: var(--muted);
            font-weight:600;
        }

        .cta{display:flex;align-items:center;gap:10px;font-weight:800;}
        .arrow{width:18px;height:18px;display:inline-block}

        .uts .pill{color:var(--accent-uts);border-color:rgba(255,107,53,.35);background:rgba(255,107,53,.08)}
        .uas .pill{color:var(--accent-uas);border-color:rgba(99,102,241,.35);background:rgba(99,102,241,.08)}
        .uts .icon{border-color:rgba(255,107,53,.35)}
        .uas .icon{border-color:rgba(99,102,241,.35)}

        .footer{
            margin-top:26px;
            text-align:center;
            color:var(--muted);
            font-size:.9rem;
            line-height:1.6;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <header class="header">
            <div class="badge"><span class="badge-dot"></span> Final Project — Pemrograman Web</div>
            <h1>Project Portfolio</h1>
            <p class="subtitle">
                Kumpulan project <strong>UTS</strong> dan <strong>UAS</strong> mata kuliah Pemrograman Web. Pilih salah satu project di bawah untuk melihat detail.
            </p>
        </header>

        <main class="grid">
            <a href="{{ route('foodify.beranda') }}" class="card uts">
                <div class="card-top">
                    <span class="pill">Ujian Tengah Semester</span>
                </div>
                <div class="icon">🍔</div>
                <h2>Foodify</h2>
                <p class="desc">
                    Website katalog makanan &amp; minuman dengan fitur pendaftaran member, kategori produk, dan navigasi multi-halaman.
                </p>
                <div class="tags">
                    <span class="tag">PHP Native</span>
                    <span class="tag">HTML</span>
                    <span class="tag">CSS</span>
                    <span class="tag">MySQL</span>
                </div>
                <div class="cta">Buka Foodify <span class="arrow">➜</span></div>
            </a>

            <a href="{{ url('/login') }}" class="card uas">
                <div class="card-top">
                    <span class="pill">Ujian Akhir Semester</span>
                </div>
                <div class="icon">📋</div>
                <h2>Siabsen</h2>
                <p class="desc">
                    Sistem Informasi Absensi Mahasiswa berbasis Laravel dengan fitur presensi QR Code, manajemen jadwal, dan multi-role dashboard.
                </p>
                <div class="tags">
                    <span class="tag">Laravel</span>
                    <span class="tag">Tailwind CSS</span>
                    <span class="tag">MySQL</span>
                    <span class="tag">Breeze</span>
                </div>
                <div class="cta">Buka Siabsen <span class="arrow">➜</span></div>
            </a>
        </main>

        <footer class="footer">
            <div><strong>NIM:</strong> 1412240028</div>
            <div>Dibuat untuk memenuhi tugas akhir mata kuliah Pemrograman Web</div>
            <div>&copy; {{ date('Y') }} — All rights reserved</div>
        </footer>
    </div>
</body>
</html>

