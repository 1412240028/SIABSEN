<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Akademik — UTS & UAS Project</title>
    <meta name="description" content="Portal navigasi project UTS (Foodify) dan UAS (Siabsen) — Final Exam Submission">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-primary: #0a0a0f;
            --bg-secondary: #12121a;
            --surface: rgba(255, 255, 255, 0.03);
            --surface-hover: rgba(255, 255, 255, 0.06);
            --border: rgba(255, 255, 255, 0.08);
            --border-hover: rgba(255, 255, 255, 0.15);
            --text-primary: #f0f0f5;
            --text-secondary: #8b8b9e;
            --text-muted: #5a5a6e;
            --accent-uts: #ff6b35;
            --accent-uts-glow: rgba(255, 107, 53, 0.3);
            --accent-uas: #6366f1;
            --accent-uas-glow: rgba(99, 102, 241, 0.3);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated gradient background */
        .bg-gradient {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .bg-gradient::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(ellipse at 20% 50%, rgba(255, 107, 53, 0.08) 0%, transparent 50%),
                        radial-gradient(ellipse at 80% 50%, rgba(99, 102, 241, 0.08) 0%, transparent 50%),
                        radial-gradient(ellipse at 50% 0%, rgba(168, 85, 247, 0.05) 0%, transparent 50%);
            animation: gradientMove 15s ease-in-out infinite alternate;
        }

        @keyframes gradientMove {
            0% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(-2%, 1%) rotate(1deg); }
            66% { transform: translate(2%, -1%) rotate(-1deg); }
            100% { transform: translate(-1%, 2%) rotate(0.5deg); }
        }

        /* Floating orbs */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            animation: float 20s ease-in-out infinite;
            z-index: 0;
        }

        .orb-1 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 107, 53, 0.15), transparent);
            top: 10%;
            left: -5%;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.15), transparent);
            bottom: 10%;
            right: -5%;
            animation-delay: -7s;
        }

        .orb-3 {
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.1), transparent);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -14s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            25% { transform: translate(30px, -30px); }
            50% { transform: translate(-20px, 20px); }
            75% { transform: translate(15px, -15px); }
        }

        /* Grid pattern */
        .grid-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 60px 60px;
            z-index: 0;
        }

        /* Main content */
        .main-container {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem 1.5rem;
        }

        /* Header section */
        .header {
            text-align: center;
            margin-bottom: 4rem;
            animation: fadeInUp 0.8s ease-out;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.25rem;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-secondary);
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #22c55e;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        .title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.25rem;
            background: linear-gradient(135deg, #f0f0f5 0%, #a0a0b5 50%, #f0f0f5 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 6s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { background-position: 0% center; }
            50% { background-position: 200% center; }
        }

        .subtitle {
            font-size: 1.1rem;
            color: var(--text-secondary);
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.7;
            font-weight: 400;
        }

        .subtitle strong {
            color: var(--text-primary);
            font-weight: 600;
        }

        /* Cards container */
        .cards-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            max-width: 900px;
            width: 100%;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        @media (min-width: 768px) {
            .cards-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Project Card */
        .project-card {
            position: relative;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 1.5rem;
            padding: 2.5rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            cursor: pointer;
            backdrop-filter: blur(20px);
        }

        .project-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: 1.5rem 1.5rem 0 0;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .project-card:hover::before {
            opacity: 1;
        }

        .project-card::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 1.5rem;
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
        }

        .project-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-4px);
        }

        .project-card:hover::after {
            opacity: 1;
        }

        /* UTS Card */
        .card-uts::before {
            background: linear-gradient(90deg, var(--accent-uts), #ff9a62);
        }

        .card-uts:hover {
            box-shadow: 0 20px 60px -15px var(--accent-uts-glow),
                        0 0 0 1px rgba(255, 107, 53, 0.1);
        }

        .card-uts::after {
            background: radial-gradient(circle at 50% 0%, rgba(255, 107, 53, 0.05) 0%, transparent 60%);
        }

        /* UAS Card */
        .card-uas::before {
            background: linear-gradient(90deg, var(--accent-uas), #818cf8);
        }

        .card-uas:hover {
            box-shadow: 0 20px 60px -15px var(--accent-uas-glow),
                        0 0 0 1px rgba(99, 102, 241, 0.1);
        }

        .card-uas::after {
            background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.05) 0%, transparent 60%);
        }

        .card-label {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 1.25rem;
            padding: 0.35rem 0.85rem;
            border-radius: 0.5rem;
        }

        .card-uts .card-label {
            color: var(--accent-uts);
            background: rgba(255, 107, 53, 0.1);
            border: 1px solid rgba(255, 107, 53, 0.15);
        }

        .card-uas .card-label {
            color: var(--accent-uas);
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.15);
        }

        .card-icon {
            width: 56px;
            height: 56px;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .project-card:hover .card-icon {
            transform: scale(1.1) rotate(-3deg);
        }

        .card-uts .card-icon {
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.15), rgba(255, 154, 98, 0.08));
            border: 1px solid rgba(255, 107, 53, 0.15);
        }

        .card-uas .card-icon {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(129, 140, 248, 0.08));
            border: 1px solid rgba(99, 102, 241, 0.15);
        }

        .card-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            line-height: 1.2;
        }

        .card-description {
            font-size: 0.95rem;
            color: var(--text-secondary);
            line-height: 1.7;
            margin-bottom: 2rem;
        }

        .card-tech {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .tech-tag {
            font-size: 0.7rem;
            font-weight: 500;
            padding: 0.3rem 0.7rem;
            border-radius: 0.4rem;
            background: var(--surface);
            border: 1px solid var(--border);
            color: var(--text-muted);
            letter-spacing: 0.02em;
        }

        .card-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .card-uts .card-cta {
            color: var(--accent-uts);
        }

        .card-uas .card-cta {
            color: var(--accent-uas);
        }

        .card-cta .arrow {
            display: inline-flex;
            transition: transform 0.3s ease;
        }

        .project-card:hover .card-cta .arrow {
            transform: translateX(6px);
        }

        /* Footer */
        .footer {
            margin-top: 4rem;
            text-align: center;
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        .footer-text {
            font-size: 0.8rem;
            color: var(--text-muted);
            line-height: 1.8;
        }

        .footer-divider {
            width: 60px;
            height: 1px;
            background: var(--border);
            margin: 0 auto 1rem;
        }

        .student-name {
            font-weight: 600;
            color: var(--text-secondary);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 767px) {
            .main-container {
                padding: 1.5rem 1rem;
            }

            .header {
                margin-bottom: 2.5rem;
            }

            .project-card {
                padding: 2rem;
            }

            .card-title {
                font-size: 1.5rem;
            }

            .footer {
                margin-top: 3rem;
            }
        }

        /* Particles */
        .particle {
            position: fixed;
            width: 2px;
            height: 2px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: 0;
            animation: particleFloat linear infinite;
        }

        @keyframes particleFloat {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-10vh) rotate(720deg); opacity: 0; }
        }
    </style>
</head>
<body>
    <!-- Background effects -->
    <div class="bg-gradient"></div>
    <div class="grid-pattern"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Particles (generated by JS) -->
    <div id="particles"></div>

    <!-- Main content -->
    <div class="main-container">
        <!-- Header -->
        <header class="header">
            <div class="badge">
                <span class="badge-dot"></span>
                Final Project — Pemrograman Web
            </div>
            <h1 class="title">Project Portfolio</h1>
            <p class="subtitle">
                Kumpulan project <strong>UTS</strong> dan <strong>UAS</strong> mata kuliah Pemrograman Web.
                Pilih salah satu project di bawah untuk melihat detail.
            </p>
        </header>

        <!-- Project Cards -->
        <div class="cards-container">
            <!-- UTS - Foodify -->
            <a href="{{ url('/foodify') }}" class="project-card card-uts" id="card-uts">
                <span class="card-label">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    Ujian Tengah Semester
                </span>
                <div class="card-icon">🍔</div>
                <h2 class="card-title">Foodify</h2>
                <p class="card-description">
                    Website katalog makanan & minuman dengan fitur pendaftaran member, kategori produk, dan sistem navigasi multi-halaman.
                </p>
                <div class="card-tech">
                    <span class="tech-tag">PHP Native</span>
                    <span class="tech-tag">HTML</span>
                    <span class="tech-tag">CSS</span>
                    <span class="tech-tag">MySQL</span>
                </div>
                <span class="card-cta">
                    Buka Foodify
                    <span class="arrow">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </span>
                </span>
            </a>

            <!-- UAS - Siabsen -->
            <a href="{{ url('/login') }}" class="project-card card-uas" id="card-uas">
                <span class="card-label">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    Ujian Akhir Semester
                </span>
                <div class="card-icon">📋</div>
                <h2 class="card-title">Siabsen</h2>
                <p class="card-description">
                    Sistem Informasi Absensi Mahasiswa berbasis Laravel dengan fitur presensi QR Code, manajemen jadwal, dan multi-role dashboard.
                </p>
                <div class="card-tech">
                    <span class="tech-tag">Laravel</span>
                    <span class="tech-tag">Tailwind CSS</span>
                    <span class="tech-tag">MySQL</span>
                    <span class="tech-tag">Breeze</span>
                </div>
                <span class="card-cta">
                    Buka Siabsen
                    <span class="arrow">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </span>
                </span>
            </a>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-divider"></div>
            <p class="footer-text">
                <span class="student-name">NIM: 1412240028</span><br>
                Dibuat untuk memenuhi tugas akhir mata kuliah Pemrograman Web<br>
                &copy; {{ date('Y') }} — All rights reserved
            </p>
        </footer>
    </div>

    <script>
        // Generate floating particles
        (function() {
            const container = document.getElementById('particles');
            const count = 20;

            for (let i = 0; i < count; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDuration = (Math.random() * 20 + 15) + 's';
                particle.style.animationDelay = (Math.random() * 20) + 's';
                particle.style.width = (Math.random() * 2 + 1) + 'px';
                particle.style.height = particle.style.width;
                container.appendChild(particle);
            }
        })();

        // Subtle parallax on cards
        document.querySelectorAll('.project-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = ((e.clientX - rect.left) / rect.width - 0.5) * 8;
                const y = ((e.clientY - rect.top) / rect.height - 0.5) * 8;
                card.style.transform = `translateY(-4px) perspective(1000px) rotateX(${-y}deg) rotateY(${x}deg)`;
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) perspective(1000px) rotateX(0) rotateY(0)';
            });
        });
    </script>
</body>
</html>
