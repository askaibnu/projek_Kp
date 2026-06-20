<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karang Taruna Waru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fraunces:opsz,wght@9..144,300;9..144,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --merah: #991b1b;
            --merah-tua: #7f1d1d;
            --merah-muda: #fee2e2;
            --emas: #b45309;
            --emas-muda: #fef3c7;
            --emas-terang: #d97706;
            --krem: #fdf8f0;
            --krem-gelap: #f5ebe0;
        }

        * { scroll-behavior: smooth; box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--krem); color: #1a0a0a; margin: 0; }

        /* ── PROGRESS ── */
        #progress { position: fixed; top: 0; left: 0; height: 3px; background: linear-gradient(90deg, var(--merah), var(--emas-terang)); z-index: 9999; width: 0%; transition: width 0.1s; }

        /* ── NAVBAR ── */
        .navbar {
            background: transparent;
            backdrop-filter: blur(0px);
            box-shadow: none;
            transition: background 0.45s cubic-bezier(.22,1,.36,1),
                        backdrop-filter 0.45s ease,
                        box-shadow 0.45s ease;
            padding: 16px 0;
        }
        /* Transparan: semua teks putih */
        .navbar:not(.scrolled) .navbar-brand { color: white !important; }
        .navbar:not(.scrolled) .nav-link { color: rgba(255,255,255,0.88) !important; }
        .navbar:not(.scrolled) .nav-link:hover { color: white !important; background: rgba(255,255,255,0.12); }
        .navbar:not(.scrolled) .nav-link.active-link { color: white !important; }
        .navbar:not(.scrolled) .navbar-toggler { border-color: rgba(255,255,255,0.4); filter: invert(1); }
        .navbar:not(.scrolled) #btnDark { border-color: rgba(255,255,255,0.3) !important; background: rgba(255,255,255,0.12) !important; }
        .navbar:not(.scrolled) #btnDark i { color: white !important; }

        /* Scrolled: background solid muncul smooth */
        .navbar.scrolled {
            background: rgba(253,248,240,0.97);
            backdrop-filter: blur(16px);
            box-shadow: 0 4px 24px rgba(127,29,29,0.1);
            padding: 10px 0;
        }
        .navbar.scrolled .navbar-brand { color: var(--merah-tua) !important; }
        .navbar.scrolled .nav-link { color: #5a3a3a !important; }
        .navbar.scrolled .nav-link:hover { color: var(--merah) !important; background: var(--merah-muda); }
        .navbar.scrolled .nav-link.active-link { color: var(--merah) !important; }
        .navbar.scrolled #btnDark { border-color: #e8d5c4 !important; background: white !important; }

        .navbar-brand { font-family: 'Fraunces', serif; font-weight: 700; font-size: 1.25rem; letter-spacing: -0.3px; transition: color 0.3s; }
        .nav-link { font-weight: 600; font-size: 0.875rem; transition: color 0.2s, background 0.2s; padding: 6px 12px !important; border-radius: 8px; }
        .dropdown-menu { border: 1px solid rgba(153,27,27,0.1); box-shadow: 0 12px 32px rgba(0,0,0,0.08); border-radius: 14px; padding: 8px; }
        .dropdown-item { border-radius: 8px; font-size: 0.875rem; font-weight: 600; color: #5a3a3a; padding: 8px 14px; }
        .dropdown-item:hover { background: var(--merah-muda); color: var(--merah); }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            background: linear-gradient(160deg, rgba(0,0,0,0.65) 0%, rgba(100,10,10,0.5) 100%),
                        url('<?= base_url("uploads/hero.jpg") ?>') center/cover no-repeat fixed;
            display: flex; align-items: center;
            position: relative; overflow: hidden;
        }
        .hero::after {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 80% 60% at 60% 50%, rgba(180,83,9,0.15), transparent 70%);
        }
        .hero-content { position: relative; z-index: 2; padding: 140px 0 80px; }
        .hero-eyebrow {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(8px);
            padding: 6px 18px; border-radius: 50px;
            font-size: 0.8rem; font-weight: 700; color: rgba(255,255,255,0.9);
            letter-spacing: 0.5px; text-transform: uppercase;
            animation: slideDown 0.8s cubic-bezier(.22,1,.36,1) 0.1s both;
        }
        .hero h1 {
            font-family: 'Fraunces', serif;
            font-size: clamp(2rem, 4vw, 3.2rem);
            font-weight: 700; color: white;
            line-height: 1.15; letter-spacing: -1px;
            margin: 16px 0 10px;
            animation: slideUp 0.9s cubic-bezier(.22,1,.36,1) 0.25s both;
        }
        .hero h1 em { font-style: normal; color: #fcd5a0; }
        .hero-sub {
            font-size: 1.05rem; color: rgba(255,255,255,0.75);
            max-width: 480px; line-height: 1.75;
            animation: slideUp 0.9s cubic-bezier(.22,1,.36,1) 0.4s both;
        }
        .hero-actions {
            display: flex; gap: 12px; flex-wrap: wrap; margin-top: 36px;
            animation: slideUp 0.9s cubic-bezier(.22,1,.36,1) 0.55s both;
        }
        .btn-primary-hero {
            background: white; color: var(--merah);
            font-weight: 700; padding: 14px 30px; border-radius: 50px;
            border: none; font-size: 0.9rem; cursor: pointer;
            transition: all 0.3s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        .btn-primary-hero:hover { background: var(--merah); color: white; transform: translateY(-3px); box-shadow: 0 10px 30px rgba(153,27,27,0.4); }
        .btn-ghost-hero {
            background: rgba(255,255,255,0.1); color: white;
            font-weight: 700; padding: 14px 30px; border-radius: 50px;
            border: 1.5px solid rgba(255,255,255,0.35); font-size: 0.9rem; cursor: pointer;
            transition: all 0.3s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
            backdrop-filter: blur(6px);
        }
        .btn-ghost-hero:hover { background: rgba(255,255,255,0.18); border-color: white; color: white; transform: translateY(-3px); }

        /* Hero scroll hint */
        .scroll-hint {
            position: absolute; bottom: 36px; left: 50%; transform: translateX(-50%);
            display: flex; flex-direction: column; align-items: center; gap: 6px;
            z-index: 2; animation: fadeIn 1s ease 1.2s both;
        }
        .scroll-hint span { font-size: 0.7rem; color: rgba(255,255,255,0.4); font-weight: 600; letter-spacing: 1px; text-transform: uppercase; }
        .scroll-line { width: 1.5px; height: 40px; background: linear-gradient(to bottom, rgba(255,255,255,0.5), transparent); animation: pulse-line 1.8s ease infinite; }
        @keyframes pulse-line { 0%,100% { opacity:0.4; transform: scaleY(1); } 50% { opacity:1; transform: scaleY(0.6); } }

        @keyframes slideDown { from { opacity:0; transform:translateY(-16px); } to { opacity:1; transform:translateY(0); } }
        @keyframes slideUp   { from { opacity:0; transform:translateY(24px);  } to { opacity:1; transform:translateY(0); } }
        @keyframes fadeIn    { from { opacity:0; } to { opacity:1; } }

        /* ── STATS STRIP ── */
        .stats-strip {
            background: white;
            border-bottom: 1px solid rgba(153,27,27,0.08);
            padding: 0;
        }
        .stat-cell {
            padding: 32px 20px;
            text-align: center;
            position: relative;
            border-right: 1px solid rgba(153,27,27,0.08);
        }
        .stat-cell:last-child { border-right: none; }
        .stat-n {
            font-family: 'Fraunces', serif;
            font-size: 2.6rem; font-weight: 700;
            color: var(--merah); line-height: 1;
        }
        .stat-l { font-size: 0.78rem; color: #a08080; font-weight: 700; margin-top: 4px; text-transform: uppercase; letter-spacing: 0.5px; }

        /* ── REVEAL ── */
        .reveal { opacity:0; transform:translateY(32px); transition:opacity 0.7s cubic-bezier(.22,1,.36,1),transform 0.7s cubic-bezier(.22,1,.36,1); }
        .reveal.visible { opacity:1; transform:translateY(0); }
        .reveal-l { opacity:0; transform:translateX(-32px); transition:opacity 0.7s cubic-bezier(.22,1,.36,1),transform 0.7s cubic-bezier(.22,1,.36,1); }
        .reveal-l.visible { opacity:1; transform:translateX(0); }
        .reveal-r { opacity:0; transform:translateX(32px); transition:opacity 0.7s cubic-bezier(.22,1,.36,1),transform 0.7s cubic-bezier(.22,1,.36,1); }
        .reveal-r.visible { opacity:1; transform:translateX(0); }
        .d1{transition-delay:.1s!important} .d2{transition-delay:.2s!important} .d3{transition-delay:.3s!important} .d4{transition-delay:.4s!important}

        /* ── SECTION SHARED ── */
        .sec { padding: 88px 0; }
        .sec-label {
            font-size: 0.72rem; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase;
            color: var(--merah); background: var(--merah-muda);
            display: inline-block; padding: 4px 14px; border-radius: 50px; margin-bottom: 14px;
        }
        .sec-title {
            font-family: 'Fraunces', serif;
            font-size: clamp(1.8rem, 3vw, 2.4rem);
            font-weight: 700; color: #1a0a0a; letter-spacing: -0.5px;
            line-height: 1.2;
        }
        .sec-divider { width: 40px; height: 3px; background: linear-gradient(90deg, var(--merah), var(--emas-terang)); border-radius: 2px; margin: 16px 0 20px; }
        .sec-sub { color: #a08080; font-size: 0.95rem; line-height: 1.75; }

        .btn-lihat-semua {
            display: inline-flex; align-items: center; gap: 8px;
            background: white; color: var(--merah);
            border: 1.5px solid rgba(153,27,27,0.2);
            font-weight: 700; font-size: 0.85rem;
            padding: 10px 22px; border-radius: 50px;
            text-decoration: none; transition: all 0.25s;
        }
        .btn-lihat-semua:hover { background: var(--merah); color: white; border-color: var(--merah); transform: translateX(4px); }
        .btn-lihat-semua i { transition: transform 0.25s; }
        .btn-lihat-semua:hover i { transform: translateX(4px); }

        /* ── TENTANG ── */
        #tentang { background: white; }
        .tentang-img {
            border-radius: 24px; overflow: hidden;
            box-shadow: 0 20px 60px rgba(153,27,27,0.12);
            position: relative;
        }
        .tentang-img img { width: 100%; height: 380px; object-fit: cover; display: block; }
        .tentang-badge {
            position: absolute; bottom: 20px; left: 20px;
            background: white; border-radius: 14px;
            padding: 14px 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
            display: flex; align-items: center; gap: 12px;
        }
        .tentang-badge-icon { width: 42px; height: 42px; background: var(--merah-muda); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; color: var(--merah); }
        .tentang-badge-text strong { display: block; font-size: 1.1rem; font-weight: 800; color: var(--merah); }
        .tentang-badge-text span { font-size: 0.75rem; color: #a08080; font-weight: 600; }
        .highlight-pill {
            display: inline-flex; align-items: center; gap: 6px;
            background: var(--krem-gelap); color: var(--emas);
            font-size: 0.8rem; font-weight: 700;
            padding: 5px 14px; border-radius: 50px; margin: 4px 4px 4px 0;
        }

        /* ── KEGIATAN ── */
        #kegiatan { background: var(--krem-gelap); }
        .card-kegiatan {
            background: white; border-radius: 20px;
            overflow: hidden; border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: all 0.35s cubic-bezier(.22,1,.36,1);
            cursor: pointer;
            border-bottom: 3px solid transparent;
            height: 100%;
        }
        .card-kegiatan:hover { transform: translateY(-8px); box-shadow: 0 20px 50px rgba(153,27,27,0.12); border-bottom-color: var(--merah); }
        .card-kegiatan img { height: 180px; object-fit: cover; width: 100%; }
        .card-k-placeholder { height: 180px; background: linear-gradient(135deg, var(--merah-tua), #991b1b); display: flex; align-items: center; justify-content: center; }
        .card-k-date { font-size: 0.72rem; font-weight: 700; color: var(--emas); margin-bottom: 8px; }
        .card-k-title { font-weight: 700; font-size: 0.95rem; color: #1a0a0a; line-height: 1.4; margin-bottom: 8px; }
        .card-k-desc { font-size: 0.82rem; color: #a08080; line-height: 1.6; margin: 0; }

        /* ── UMKM PREVIEW ── */
        #umkm-preview { background: white; }
        .umkm-card {
            background: var(--krem);
            border-radius: 20px; overflow: hidden;
            border: 1px solid rgba(153,27,27,0.08);
            transition: all 0.35s cubic-bezier(.22,1,.36,1);
            height: 100%;
        }
        .umkm-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(153,27,27,0.1); border-color: rgba(153,27,27,0.2); }
        .umkm-card img { height: 180px; object-fit: cover; width: 100%; }
        .umkm-placeholder { height: 180px; background: linear-gradient(135deg, var(--krem-gelap), #e8d5c4); display: flex; align-items: center; justify-content: center; }
        .umkm-price { font-weight: 800; color: var(--merah); font-size: 0.95rem; }
        .umkm-name { font-weight: 700; font-size: 0.9rem; color: #1a0a0a; margin-bottom: 4px; }
        .umkm-owner { font-size: 0.78rem; color: #a08080; font-weight: 600; }

        /* ── CTA BANNER ── */
        #cta {
            background: linear-gradient(135deg, var(--merah-tua) 0%, #991b1b 50%, var(--emas) 100%);
            padding: 80px 0; position: relative; overflow: hidden;
        }
        #cta::before { content:''; position:absolute; top:-60%; right:-5%; width:500px; height:500px; background:radial-gradient(circle,rgba(255,255,255,0.06),transparent 70%); border-radius:50%; }
        #cta::after  { content:''; position:absolute; bottom:-40%; left:5%; width:300px; height:300px; background:radial-gradient(circle,rgba(255,255,255,0.05),transparent 70%); border-radius:50%; }
        .cta-title { font-family:'Fraunces',serif; font-size:clamp(1.8rem,4vw,2.8rem); font-weight:700; color:white; line-height:1.2; }
        .btn-cta { background:white; color:var(--merah); font-weight:700; padding:14px 32px; border-radius:50px; border:none; font-size:0.9rem; text-decoration:none; display:inline-flex; align-items:center; gap:8px; transition:all 0.3s; box-shadow:0 4px 20px rgba(0,0,0,0.2); }
        .btn-cta:hover { background:var(--krem); color:var(--merah); transform:translateY(-3px); box-shadow:0 10px 30px rgba(0,0,0,0.25); }

        /* ── FOOTER ── */
        footer { background: linear-gradient(135deg, #1c0808, #2d0f0f); color: white; padding: 60px 0 24px; }
        footer h6 { color: var(--emas-terang); font-size: 0.72rem; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; margin-bottom: 16px; }
        footer a { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.875rem; transition: color 0.2s; }
        footer a:hover { color: white; }
        footer li { margin-bottom: 10px; }
        .footer-divider { border-top: 1px solid rgba(255,255,255,0.08); padding-top: 20px; margin-top: 40px; }
        .social-btn { width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; font-size: 0.95rem; transition: all 0.3s; }
        .social-btn:hover { transform: translateY(-3px) scale(1.1); color: white; }

        @media (max-width: 480px) {
    .hero-actions {
        flex-direction: column;
        align-items: flex-start;
    }
    .btn-primary-hero,
    .btn-ghost-hero {
        width: 100%;
        justify-content: center;
    }
}
    </style>
</head>
<body>

<div id="progress"></div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('/') ?>">
            <img src="<?= base_url('uploads/logo.png') ?>" height="36" class="me-2" style="border-radius:6px;">Karang Taruna Waru
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto gap-1 align-items-center">
                <li class="nav-item"><a class="nav-link active-link" href="<?= site_url('/') ?>">Beranda</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Profil</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= site_url('profil/sejarah') ?>">Sejarah</a></li>
                        <li><a class="dropdown-item" href="<?= site_url('profil/visimisi') ?>">Visi Misi</a></li>
                        <li><a class="dropdown-item" href="<?= site_url('profil/struktur') ?>">Struktur Organisasi</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('berita') ?>">berita</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('events') ?>">Event</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('umkm-publik') ?>">UMKM</a></li>
              
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ── HERO ── -->
<div class="hero">
    <div class="container hero-content">
        <div class="row">
            <div class="col-lg-6">
                <div class="hero-eyebrow">
                    <i class="bi bi-geo-alt-fill"></i> Desa Waru, Kab. Bogor
                </div>
                <h1>Karang Taruna<br><em>Bersatu &<br>Berkarya</em></h1>
                <p class="hero-sub">Organisasi kepemudaan yang membangun masyarakat melalui kegiatan sosial, pemberdayaan ekonomi, dan pengembangan potensi pemuda Desa Waru.</p>
                <div class="hero-actions">
                    <a href="#tentang" class="btn-primary-hero">Tentang Kami <i class="bi bi-arrow-down"></i></a>
                    <a href="<?= site_url('events') ?>" class="btn-ghost-hero">Lihat Event <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-hint">
        <span>Scroll</span>
        <div class="scroll-line"></div>
    </div>
</div>

<!-- ── STATS STRIP ── -->
<div class="stats-strip">
    <div class="container-fluid px-0">
        <div class="row g-0">
            <div class="col-6 col-md-3 reveal d1">
                <div class="stat-cell">
                    <div class="stat-n" data-target="<?= $totalAnggota ?>">0</div>
                    <div class="stat-l"><i class="bi bi-people me-1"></i>Anggota</div>
                </div>
            </div>
            <div class="col-6 col-md-3 reveal d2">
                <div class="stat-cell">
                    <div class="stat-n" data-target="<?= $totalKegiatan ?? 0 ?>">0</div>
                    <div class="stat-l"><i class="bi bi-calendar-event me-1"></i>Kegiatan</div>
                </div>
            </div>
            <div class="col-6 col-md-3 reveal d3">
                <div class="stat-cell">
                    <div class="stat-n" data-target="<?= $totalUmkm ?? 0 ?>">0</div>
                    <div class="stat-l"><i class="bi bi-shop me-1"></i>UMKM</div>
                </div>
            </div>
            <div class="col-6 col-md-3 reveal d4">
                <div class="stat-cell">
                    <div class="stat-n" data-target="<?= date('Y') - 2010 ?>">0</div>
                    <div class="stat-l"><i class="bi bi-award me-1"></i>Tahun Aktif</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ── TENTANG ── -->
<section class="sec" id="tentang">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 reveal-l">
                <div class="tentang-img">
                    <img src="<?= base_url('uploads/hero.jpg') ?>" alt="Karang Taruna Waru">
                    <div class="tentang-badge">
                        <div class="tentang-badge-icon"><i class="bi bi-award-fill"></i></div>
                        <div class="tentang-badge-text">
                            <strong>Sejak 2010</strong>
                            <span>Melayani Desa Waru</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 reveal-r">
                <span class="sec-label">Tentang Kami</span>
                <h2 class="sec-title">Pemuda Bergerak,<br>Desa Berkembang</h2>
                <div class="sec-divider"></div>
                <p class="sec-sub" style="margin-bottom:20px;">
                    Karang Taruna Desa Waru adalah wadah kepemudaan yang aktif membangun masyarakat sejak 2010 — dari kegiatan sosial, pemberdayaan UMKM, hingga pengembangan potensi generasi muda.
                </p>
                <div class="mb-28" style="margin-bottom:28px;">
                    <span class="highlight-pill"><i class="bi bi-check-circle-fill me-1" style="color:var(--merah);"></i>Kegiatan Sosial</span>
                    <span class="highlight-pill"><i class="bi bi-check-circle-fill me-1" style="color:var(--merah);"></i>Pemberdayaan UMKM</span>
                    <span class="highlight-pill"><i class="bi bi-check-circle-fill me-1" style="color:var(--merah);"></i>Pengembangan Pemuda</span>
                    <span class="highlight-pill"><i class="bi bi-check-circle-fill me-1" style="color:var(--merah);"></i>Gotong Royong</span>
                </div>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="<?= site_url('profil/sejarah') ?>" class="btn-lihat-semua">
                        Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="<?= site_url('profil/struktur') ?>" class="btn-lihat-semua">
                        Struktur Organisasi <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ── KEGIATAN TERBARU ── -->
<section class="sec" id="kegiatan">
    <div class="container">
        <div class="row align-items-end mb-5">
            <div class="col-md-7 reveal">
                <span class="sec-label">Kegiatan Terbaru</span>
                <h2 class="sec-title" style="margin-top:10px;">Dokumentasi dan  kegiatan sosial<br></h2>
            </div>
            <div class="col-md-5 text-md-end reveal d2">
                <a href="<?= site_url('kegiatan') ?>" class="btn-lihat-semua">
                    Semua Kegiatan <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="row g-4">
            <?php if(!empty($kegiatan)): ?>
                <?php $shown = array_slice($kegiatan, 0, 3); ?>
                <?php foreach($shown as $i => $k): ?>
                <div class="col-md-4 reveal d<?= $i+1 ?>">
                    <div class="card-kegiatan" onclick="window.location='<?= site_url('kegiatan/detail/'.$k->id) ?>'">
                        <?php if($k->foto): ?>
                            <img src="<?= base_url('uploads/'.$k->foto) ?>" alt="<?= $k->nama ?>">
                        <?php else: ?>
                            <div class="card-k-placeholder">
                                <i class="bi bi-calendar-event" style="font-size:2.5rem;color:rgba(255,255,255,0.3);"></i>
                            </div>
                        <?php endif; ?>
                        <div class="p-4">
                            <div class="card-k-date"><i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime($k->tanggal)) ?></div>
                            <div class="card-k-title"><?= $k->nama ?></div>
                            <p class="card-k-desc"><?= substr($k->deskripsi, 0, 90) ?>...</p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-calendar-x" style="font-size:3rem;color:#ddc0b0;"></i>
                    <p style="color:#a08080;margin-top:12px;">Belum ada kegiatan</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ── UMKM PREVIEW ── -->
<section class="sec" id="umkm-preview">
    <div class="container">
        <div class="row align-items-end mb-5">
            <div class="col-md-7 reveal">
                <span class="sec-label">UMKM Binaan</span>
                <h2 class="sec-title" style="margin-top:10px;">Produk Unggulan<br>Warga Kami</h2>
            </div>
            <div class="col-md-5 text-md-end reveal d2">
                <a href="<?= site_url('umkm-publik') ?>" class="btn-lihat-semua">
                    Lihat Semua UMKM <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="row g-4">
            <?php if(!empty($umkm)): ?>
                <?php $shownUmkm = array_slice($umkm, 0, 4); ?>
                <?php foreach($shownUmkm as $i => $u): ?>
                <?php
                    $noWa = preg_replace('/[^0-9]/', '', $u->no_hp ?? '');
                    if(substr($noWa, 0, 1) == '0') $noWa = '62'.substr($noWa, 1);
                    $pesanWa = urlencode("Halo, saya tertarik dengan produk {$u->nama_umkm}.");
                ?>
                <div class="col-md-3 col-sm-6 reveal d<?= ($i%4)+1 ?>">
                    <div class="umkm-card">
                        <?php if($u->foto): ?>
                            <img src="<?= base_url('uploads/'.$u->foto) ?>" alt="<?= $u->nama_umkm ?>">
                        <?php else: ?>
                            <div class="umkm-placeholder">
                                <i class="bi bi-shop" style="font-size:2.5rem;color:var(--merah);opacity:0.25;"></i>
                            </div>
                        <?php endif; ?>
                        <div class="p-3">
                            <div class="umkm-name"><?= $u->nama_umkm ?></div>
                            <?php if($u->harga): ?><div class="umkm-price"><?= $u->harga ?></div><?php endif; ?>
                            <div class="umkm-owner mt-1"><i class="bi bi-person-circle me-1"></i><?= $u->pemilik ?></div>
                            <?php if($u->no_hp): ?>
                            <a href="https://wa.me/<?= $noWa ?>?text=<?= $pesanWa ?>" target="_blank"
                               style="display:flex;align-items:center;justify-content:center;gap:6px;margin-top:12px;background:var(--merah);color:white;font-size:0.8rem;font-weight:700;padding:9px;border-radius:10px;text-decoration:none;transition:all 0.2s;"
                               onmouseover="this.style.background='var(--merah-tua)'" onmouseout="this.style.background='var(--merah)'">
                                <i class="bi bi-whatsapp"></i> Hubungi
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-shop" style="font-size:3rem;color:#ddc0b0;"></i>
                    <p style="color:#a08080;margin-top:12px;">Belum ada UMKM</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ── CTA BANNER ── -->
<section id="cta">
    <div class="container position-relative" style="z-index:1;">
        <div class="row align-items-center g-4">
            <div class="col-lg-7 reveal-l">
                <div class="cta-title">Bergabunglah bersama kami,<br>bangun Desa Waru lebih baik.</div>
                <p style="color:rgba(255,255,255,0.7);margin-top:16px;font-size:0.95rem;line-height:1.7;">Jadilah bagian dari gerakan kepemudaan yang peduli dan berkontribusi nyata bagi masyarakat.</p>
            </div>
            <div class="col-lg-5 text-lg-end reveal-r">
                <a href="https://wa.me/6289531435314" target="_blank" class="btn-cta">
                    <i class="bi bi-whatsapp"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ── FOOTER ── -->
<footer>
    <div class="container">
        <div class="row g-5">
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="<?= base_url('uploads/logo.png') ?>" height="48" style="border-radius:8px;">
                    <div>
                        <div style="font-weight:800;font-size:1rem;color:white;">Karang Taruna</div>
                        <div style="font-size:0.8rem;color:rgba(255,255,255,0.45);">Desa Waru, Kab. Bogor</div>
                    </div>
                </div>
                <p style="color:rgba(255,255,255,0.55);font-size:0.85rem;line-height:1.8;margin-bottom:20px;">Organisasi kepemudaan yang berdedikasi membangun masyarakat melalui kegiatan sosial dan pemberdayaan ekonomi.</p>
                <div class="d-flex gap-2">
                    <?php $sosmed = [['icon'=>'facebook','color'=>'#1877f2'],['icon'=>'instagram','color'=>'#bc1888'],['icon'=>'whatsapp','color'=>'#25d366'],['icon'=>'youtube','color'=>'#ff0000']];
                    foreach($sosmed as $s): ?>
                    <a href="#" class="social-btn" data-color="<?= $s['color'] ?>"><i class="bi bi-<?= $s['icon'] ?>"></i></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-2">
                <h6>Navigasi</h6>
                <ul class="list-unstyled">
                    <li><a href="<?= site_url('/') ?>">Beranda</a></li>
                    <li><a href="<?= site_url('profil/sejarah') ?>">Sejarah</a></li>
                    <li><a href="<?= site_url('profil/visimisi') ?>">Visi Misi</a></li>
                    <li><a href="<?= site_url('profil/struktur') ?>">Struktur</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h6>Konten</h6>
                <ul class="list-unstyled">
                    <li><a href="<?= site_url('berita') ?>">Berita</a></li>
                    <li><a href="<?= site_url('events') ?>">Event</a></li>
                    <li><a href="<?= site_url('kegiatan') ?>">Kegiatan</a></li>
                    <li><a href="<?= site_url('umkm-publik') ?>">UMKM</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6>Kontak</h6>
                <ul class="list-unstyled" style="font-size:0.85rem;">
                    <li style="color:rgba(255,255,255,0.6);margin-bottom:10px;"><i class="bi bi-geo-alt me-2" style="color:var(--emas-terang);"></i>Desa Waru, Kab. Bogor</li>
                    <li style="margin-bottom:10px;"><a href="tel:+6289531435314"><i class="bi bi-telephone me-2" style="color:var(--emas-terang);"></i>+6289531435314</a></li>
                    <li><a href="mailto:karangtaruna@email.com"><i class="bi bi-envelope me-2" style="color:var(--emas-terang);"></i>karangtaruna.desawaru@gmail.com</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-divider text-center">
            <p style="color:rgba(255,255,255,0.3);font-size:0.8rem;margin:0;">&copy; <?= date('Y') ?> Karang Taruna Desa Waru. All rights reserved.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* progress + navbar transparent→solid */
window.addEventListener('scroll', () => {
    const d = document.documentElement;
    document.getElementById('progress').style.width = (d.scrollTop / (d.scrollHeight - d.clientHeight) * 100) + '%';
    const heroH = document.querySelector('.hero').offsetHeight;
    document.getElementById('mainNav').classList.toggle('scrolled', scrollY > heroH * 0.15);
}, { passive: true });

/* reveal */
const ro = new IntersectionObserver(es => es.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); }), { threshold:.12, rootMargin:'0px 0px -40px 0px' });
document.querySelectorAll('.reveal,.reveal-l,.reveal-r').forEach(el => ro.observe(el));

/* counter */
const co = new IntersectionObserver(es => es.forEach(e => {
    if(e.isIntersecting && !e.target.dataset.done) {
        e.target.dataset.done = 1;
        const t = +e.target.dataset.target, step = t / (1600/16);
        let c = 0;
        const tmr = setInterval(() => { c += step; if(c >= t){ e.target.textContent=t; clearInterval(tmr); } else e.target.textContent=Math.floor(c); }, 16);
    }
}), { threshold:.5 });
document.querySelectorAll('.stat-n[data-target]').forEach(el => co.observe(el));

/* social hover */
document.querySelectorAll('.social-btn').forEach(b => {
    const c = b.dataset.color;
    b.onmouseenter = () => { b.style.background = c; };
    b.onmouseleave = () => { b.style.background = 'rgba(255,255,255,0.1)'; };
});

if(localStorage.getItem('dk') === '1') {
    document.body.classList.add('dark');
    document.getElementById('iconDark').className = 'bi bi-sun-fill';
    document.getElementById('iconDark').style.color = '#f0c040';
}
</script>
</body>
</html>