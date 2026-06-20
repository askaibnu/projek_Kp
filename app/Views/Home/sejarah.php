<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sejarah — Karang Taruna Waru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --merah: #991b1b; --merah-tua: #7f1d1d;
            --merah-muda: #fee2e2; --emas: #b45309;
            --emas-muda: #fef3c7; --emas-terang: #d97706;
            --krem: #fdf8f0; --krem-gelap: #f5ebe0;
        }
        * { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--krem); color: #2a1a1a; }

        /* PROGRESS */
        #readingProgress { position:fixed;top:0;left:0;height:3px;background:linear-gradient(90deg,var(--merah),var(--emas-terang));z-index:9999;width:0%;transition:width 0.1s; }

        /* NAVBAR */
        .navbar { background:rgba(255,255,255,0.96);backdrop-filter:blur(14px);box-shadow:0 2px 20px rgba(0,0,0,0.06);transition:all 0.3s; }
        .navbar.scrolled { box-shadow:0 4px 30px rgba(127,29,29,0.1); }
        .navbar-brand { font-weight:800;color:var(--merah-tua) !important;font-size:1.2rem; }
        .nav-link { color:#3a2a2a !important;font-weight:600;font-size:0.9rem;transition:color 0.2s; }
        .nav-link:hover { color:var(--merah) !important; }
        .dropdown-menu { border:1px solid rgba(153,27,27,0.1);box-shadow:0 8px 24px rgba(0,0,0,0.09);border-radius:12px; }
        .dropdown-item:hover { background:var(--merah-muda);color:var(--merah); }

        /* PAGE HERO */
        .page-hero {
            background: linear-gradient(135deg, var(--merah-tua) 0%, #991b1b 50%, #b45309 100%);
            padding: 80px 0 60px; color: white; position: relative; overflow: hidden;
        }
        .page-hero::before {
            content:''; position:absolute; top:-80px; right:-80px;
            width:320px; height:320px;
            background:radial-gradient(circle, rgba(255,255,255,0.07), transparent 70%);
            border-radius:50%;
        }
        .page-hero::after {
            content:''; position:absolute; bottom:-60px; left:10%;
            width:220px; height:220px;
            background:radial-gradient(circle, rgba(217,119,6,0.2), transparent 70%);
            border-radius:50%;
        }
        .page-hero .breadcrumb-item { color:rgba(255,255,255,0.6);font-size:0.82rem; }
        .page-hero .breadcrumb-item a { color:rgba(255,255,255,0.7);text-decoration:none; }
        .page-hero .breadcrumb-item.active { color:rgba(255,255,255,0.9); }
        .page-hero .breadcrumb-divider { color:rgba(255,255,255,0.4); }
        .page-hero h1 { font-size:2.6rem;font-weight:800;letter-spacing:-0.5px;margin-top:12px; }
        .page-hero p { opacity:0.8;font-size:1rem;max-width:540px;margin-top:10px; }

        /* REVEAL */
        .reveal { opacity:0;transform:translateY(36px);transition:opacity 0.7s cubic-bezier(.22,1,.36,1),transform 0.7s cubic-bezier(.22,1,.36,1); }
        .reveal.visible { opacity:1;transform:translateY(0); }
        .reveal-left { opacity:0;transform:translateX(-40px);transition:opacity 0.7s cubic-bezier(.22,1,.36,1),transform 0.7s cubic-bezier(.22,1,.36,1); }
        .reveal-left.visible { opacity:1;transform:translateX(0); }
        .reveal-right { opacity:0;transform:translateX(40px);transition:opacity 0.7s cubic-bezier(.22,1,.36,1),transform 0.7s cubic-bezier(.22,1,.36,1); }
        .reveal-right.visible { opacity:1;transform:translateX(0); }
        .delay-1 { transition-delay:0.1s !important; }
        .delay-2 { transition-delay:0.2s !important; }
        .delay-3 { transition-delay:0.3s !important; }
        .delay-4 { transition-delay:0.4s !important; }

        /* SECTION TAG */
        .section-tag { display:inline-block;background:var(--merah-muda);color:var(--merah);font-weight:700;font-size:0.78rem;padding:5px 14px;border-radius:50px;letter-spacing:0.5px;text-transform:uppercase;margin-bottom:10px; }
        .section-title { font-size:2rem;font-weight:800;color:#1a0a0a;letter-spacing:-0.4px; }
        .divider { width:50px;height:4px;background:linear-gradient(90deg,var(--merah),var(--emas-terang));border-radius:2px;margin:12px 0 20px; }

        /* TIMELINE */
        .timeline { position:relative;padding-left:0; }
        .timeline::before {
            content:''; position:absolute; left:28px; top:0; bottom:0;
            width:2px; background:linear-gradient(to bottom, var(--merah), var(--emas-terang));
        }
        .timeline-item { display:flex;gap:24px;margin-bottom:40px;position:relative; }
        .timeline-dot {
            width:56px; height:56px; border-radius:50%; flex-shrink:0;
            background:linear-gradient(135deg, var(--merah), var(--merah-tua));
            display:flex;align-items:center;justify-content:center;
            color:white;font-weight:800;font-size:0.75rem;text-align:center;line-height:1.2;
            box-shadow:0 4px 16px rgba(153,27,27,0.35);
            border:3px solid white; z-index:1;
        }
        .timeline-content {
            background:white;border-radius:16px;padding:24px 28px;flex:1;
            box-shadow:0 4px 20px rgba(0,0,0,0.06);
            border-left:3px solid var(--merah);
            transition:all 0.3s;
        }
        .timeline-content:hover { transform:translateX(6px);box-shadow:0 8px 30px rgba(153,27,27,0.1); }
        .timeline-year { font-size:0.75rem;font-weight:700;color:var(--merah);text-transform:uppercase;letter-spacing:1px;margin-bottom:6px; }
        .timeline-title { font-size:1.05rem;font-weight:700;color:#1a0a0a;margin-bottom:8px; }
        .timeline-desc { font-size:0.88rem;color:#7a5c5c;line-height:1.7;margin:0; }

        /* STAT CARDS */
        .stat-card {
            background:white;border-radius:20px;padding:28px;text-align:center;
            border-bottom:3px solid var(--merah);
            box-shadow:0 4px 20px rgba(0,0,0,0.06);
            transition:all 0.3s;
        }
        .stat-card:hover { transform:translateY(-6px);box-shadow:0 16px 40px rgba(153,27,27,0.12); }
        .stat-num { font-size:2.4rem;font-weight:800;color:var(--merah);letter-spacing:-1px; }
        .stat-lbl { font-size:0.82rem;color:#7a5c5c;font-weight:600;margin-top:4px; }

        /* FOOTER */
        footer { background:linear-gradient(135deg,#1c0808,#2d0f0f);color:white;padding:50px 0 20px; }
        footer h5 { color:#f0c090;font-size:0.78rem;text-transform:uppercase;letter-spacing:1.5px;font-weight:700; }
        footer a { color:rgba(255,255,255,0.65);text-decoration:none;transition:color 0.2s; }
        footer a:hover { color:white; }
        .footer-bottom { border-top:1px solid rgba(255,255,255,0.08);padding-top:20px;margin-top:30px; }
    </style>
</head>
<body>
<div id="readingProgress"></div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg sticky-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('/') ?>">
            <img src="<?= base_url('uploads/logo.png') ?>" height="38" class="me-2">Karang Taruna Waru
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
           <ul class="navbar-nav ms-auto gap-2 align-items-center">
    <li class="nav-item"><a class="nav-link" href="<?= site_url('/') ?>">Beranda</a></li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Profil</a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= site_url('profil/sejarah') ?>">Sejarah</a></li>
            <li><a class="dropdown-item" href="<?= site_url('profil/visimisi') ?>">Visi Misi</a></li>
            <li><a class="dropdown-item" href="<?= site_url('profil/struktur') ?>">Struktur Organisasi</a></li>
        </ul>
    </li>
    <li class="nav-item"><a class="nav-link active" href="<?= site_url('berita') ?>" style="color:var(--merah) !important;">Berita</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= site_url('events') ?>">Event</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= site_url('umkm-publik') ?>">UMKM</a></li>
</ul>
        </div>
    </div>
</nav>

<!-- PAGE HERO -->
<div class="page-hero">
    <div class="container position-relative" style="z-index:1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Beranda</a></li>
                <li class="breadcrumb-item"><span>Profil</span></li>
                <li class="breadcrumb-item active">Sejarah</li>
            </ol>
        </nav>
        <h1>Sejarah Kami</h1>
        <p>Perjalanan panjang Karang Taruna Desa Waru sejak berdiri hingga kini dalam mengabdi kepada masyarakat.</p>
    </div>
</div>

<!-- KONTEN -->
<div style="padding:70px 0;">
    <div class="container">

        <!-- INTRO -->
        <div class="row align-items-center g-5 mb-5">
            <div class="col-lg-5 reveal-left">
                <span class="section-tag">Tentang Kami</span>
                <h2 class="section-title mt-1">Karang Taruna<br>Desa Waru</h2>
                <div class="divider"></div>
                <p style="color:#5a3a3a;line-height:1.9;font-size:0.97rem;">
                    Karang Taruna Desa Waru adalah organisasi kepemudaan yang lahir dari semangat
                    para pemuda desa untuk bersama-sama membangun dan memajukan desa tercinta.
                    Dengan landasan gotong royong dan kebersamaan, kami terus tumbuh menjadi
                    wadah pemberdayaan yang nyata.
                </p>
                <p style="color:#5a3a3a;line-height:1.9;font-size:0.97rem;">
                    Kini, lebih dari satu dekade berdiri, Karang Taruna Desa Waru telah menjelma
                    menjadi organisasi yang dipercaya masyarakat dan menjadi mitra strategis
                    pemerintah desa dalam berbagai program pembangunan.
                </p>
            </div>
            <div class="col-lg-7 reveal-right">
                <div class="row g-3">
                    <div class="col-6 reveal delay-1"><div class="stat-card"><div class="stat-num">2010</div><div class="stat-lbl">Tahun Berdiri</div></div></div>
                    <div class="col-6 reveal delay-2"><div class="stat-card"><div class="stat-num"><?= date('Y') - 2010 ?>+</div><div class="stat-lbl">Tahun Berkarya</div></div></div>
                    <div class="col-6 reveal delay-3"><div class="stat-card"><div class="stat-num">100+</div><div class="stat-lbl">Anggota Aktif</div></div></div>
                    <div class="col-6 reveal delay-4"><div class="stat-card"><div class="stat-num">50+</div><div class="stat-lbl">Kegiatan Terlaksana</div></div></div>
                </div>
            </div>
        </div>

        <!-- TIMELINE -->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="text-center mb-5 reveal">
                    <span class="section-tag">Perjalanan</span>
                    <h2 class="section-title mt-1">Linimasa Sejarah</h2>
                    <div class="divider mx-auto"></div>
                </div>
                <div class="timeline">
                    <div class="timeline-item reveal delay-1">
                        <div class="timeline-dot">2010</div>
                        <div class="timeline-content">
                            <div class="timeline-year">Tahun 2010</div>
                            <div class="timeline-title">Pendirian Karang Taruna Desa Waru</div>
                            <p class="timeline-desc">Karang Taruna Desa Waru resmi dibentuk atas inisiatif para pemuda desa yang ingin berkontribusi nyata. Kegiatan awal meliputi kerja bakti dan perayaan hari besar nasional.</p>
                        </div>
                    </div>
                    <div class="timeline-item reveal delay-2">
                        <div class="timeline-dot">2012</div>
                        <div class="timeline-content">
                            <div class="timeline-year">Tahun 2012</div>
                            <div class="timeline-title">Pengembangan Program Sosial</div>
                            <p class="timeline-desc">Mulai mengembangkan program sosial kemasyarakatan, termasuk bakti sosial, santunan anak yatim, dan kegiatan olahraga bersama warga.</p>
                        </div>
                    </div>
                    <div class="timeline-item reveal delay-3">
                        <div class="timeline-dot">2015</div>
                        <div class="timeline-content">
                            <div class="timeline-year">Tahun 2015</div>
                            <div class="timeline-title">Pemberdayaan Ekonomi Lokal</div>
                            <p class="timeline-desc">Merambah bidang ekonomi dengan membina UMKM warga lokal. Program ini berhasil membuka lapangan kerja baru dan meningkatkan pendapatan warga desa.</p>
                        </div>
                    </div>
                    <div class="timeline-item reveal delay-1">
                        <div class="timeline-dot">2018</div>
                        <div class="timeline-content">
                            <div class="timeline-year">Tahun 2018</div>
                            <div class="timeline-title">Era Digital & Media Sosial</div>
                            <p class="timeline-desc">Mulai memanfaatkan platform digital untuk mempromosikan kegiatan dan produk UMKM binaan kepada khalayak yang lebih luas.</p>
                        </div>
                    </div>
                    <div class="timeline-item reveal delay-2">
                        <div class="timeline-dot">2021</div>
                        <div class="timeline-content">
                            <div class="timeline-year">Tahun 2021</div>
                            <div class="timeline-title">Penanganan Pandemi & Solidaritas</div>
                            <p class="timeline-desc">Aktif dalam penanganan pandemi COVID-19 dengan mendistribusikan bantuan sembako, masker, dan disinfektan kepada warga yang terdampak.</p>
                        </div>
                    </div>
                    <div class="timeline-item reveal delay-3">
                        <div class="timeline-dot">Kini</div>
                        <div class="timeline-content">
                            <div class="timeline-year">Tahun <?= date('Y') ?></div>
                            <div class="timeline-title">Terus Berkarya & Berkembang</div>
                            <p class="timeline-desc">Karang Taruna Desa Waru terus berinovasi dengan program-program baru yang relevan, siap menjadi garda terdepan pemberdayaan pemuda dan masyarakat Desa Waru.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-5">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="<?= base_url('uploads/logo.png') ?>" height="52" style="border-radius:10px;">
                    <div>
                        <div style="color:white;font-weight:800;font-size:1.05rem;">Karang Taruna</div>
                        <small style="color:rgba(255,255,255,0.5);">Desa Waru</small>
                    </div>
                </div>
                <p style="color:rgba(255,255,255,0.6);font-size:0.87rem;line-height:1.8;">Organisasi kepemudaan yang berdedikasi membangun masyarakat melalui kegiatan sosial dan pemberdayaan ekonomi.</p>
            </div>
            <div class="col-md-3">
                <h5>Profil</h5>
                <ul class="list-unstyled mt-3" style="font-size:0.87rem;">
                    <li class="mb-2"><a href="<?= site_url('profil/sejarah') ?>">Sejarah</a></li>
                    <li class="mb-2"><a href="<?= site_url('profil/visimisi') ?>">Visi & Misi</a></li>
                    <li class="mb-2"><a href="<?= site_url('profil/struktur') ?>">Struktur Organisasi</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Kontak</h5>
                <ul class="list-unstyled mt-3" style="font-size:0.87rem;color:rgba(255,255,255,0.65);">
                    <li class="mb-2"><i class="bi bi-geo-alt me-2" style="color:var(--emas-terang);"></i>Desa Waru, Kab. Bogor</li>
                    <li class="mb-2"><i class="bi bi-telephone me-2" style="color:var(--emas-terang);"></i>+6289531435314</li>
                    <li class="mb-2"><i class="bi bi-envelope me-2" style="color:var(--emas-terang);"></i> karangtaruna.desawaru@gmail.com</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom text-center">
            <p style="color:rgba(255,255,255,0.35);font-size:0.82rem;margin:0;">&copy; <?= date('Y') ?> Karang Taruna Desa Waru. All rights reserved.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
window.addEventListener('scroll', () => {
    const doc = document.documentElement;
    document.getElementById('readingProgress').style.width = (doc.scrollTop / (doc.scrollHeight - doc.clientHeight) * 100) + '%';
    document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 50);
});
const observer = new IntersectionObserver(e => e.forEach(x => { if(x.isIntersecting) x.target.classList.add('visible'); }), { threshold:0.12, rootMargin:'0px 0px -40px 0px' });
document.querySelectorAll('.reveal,.reveal-left,.reveal-right').forEach(el => observer.observe(el));
</script>
</body>
</html>