<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi & Misi — Karang Taruna Waru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --merah:#991b1b;--merah-tua:#7f1d1d;--merah-muda:#fee2e2;
            --emas:#b45309;--emas-muda:#fef3c7;--emas-terang:#d97706;
            --krem:#fdf8f0;--krem-gelap:#f5ebe0;
        }
        * { scroll-behavior:smooth; }
        body { font-family:'Plus Jakarta Sans',sans-serif;background:var(--krem);color:#2a1a1a; }
        #readingProgress { position:fixed;top:0;left:0;height:3px;background:linear-gradient(90deg,var(--merah),var(--emas-terang));z-index:9999;width:0%;transition:width 0.1s; }
        .navbar { background:rgba(255,255,255,0.96);backdrop-filter:blur(14px);box-shadow:0 2px 20px rgba(0,0,0,0.06);transition:all 0.3s; }
        .navbar.scrolled { box-shadow:0 4px 30px rgba(127,29,29,0.1); }
        .navbar-brand { font-weight:800;color:var(--merah-tua) !important;font-size:1.2rem; }
        .nav-link { color:#3a2a2a !important;font-weight:600;font-size:0.9rem;transition:color 0.2s; }
        .nav-link:hover { color:var(--merah) !important; }
        .dropdown-menu { border:1px solid rgba(153,27,27,0.1);box-shadow:0 8px 24px rgba(0,0,0,0.09);border-radius:12px; }
        .dropdown-item:hover { background:var(--merah-muda);color:var(--merah); }

        .page-hero { background:linear-gradient(135deg,var(--merah-tua) 0%,#991b1b 50%,#b45309 100%);padding:80px 0 60px;color:white;position:relative;overflow:hidden; }
        .page-hero::before { content:'';position:absolute;top:-80px;right:-80px;width:320px;height:320px;background:radial-gradient(circle,rgba(255,255,255,0.07),transparent 70%);border-radius:50%; }
        .page-hero .breadcrumb-item { color:rgba(255,255,255,0.6);font-size:0.82rem; }
        .page-hero .breadcrumb-item a { color:rgba(255,255,255,0.7);text-decoration:none; }
        .page-hero .breadcrumb-item.active { color:rgba(255,255,255,0.9); }
        .page-hero h1 { font-size:2.6rem;font-weight:800;letter-spacing:-0.5px;margin-top:12px; }
        .page-hero p { opacity:0.8;font-size:1rem;max-width:540px;margin-top:10px; }

        .reveal { opacity:0;transform:translateY(36px);transition:opacity 0.7s cubic-bezier(.22,1,.36,1),transform 0.7s cubic-bezier(.22,1,.36,1); }
        .reveal.visible { opacity:1;transform:translateY(0); }
        .reveal-left { opacity:0;transform:translateX(-40px);transition:opacity 0.7s cubic-bezier(.22,1,.36,1),transform 0.7s cubic-bezier(.22,1,.36,1); }
        .reveal-left.visible { opacity:1;transform:translateX(0); }
        .reveal-right { opacity:0;transform:translateX(40px);transition:opacity 0.7s cubic-bezier(.22,1,.36,1),transform 0.7s cubic-bezier(.22,1,.36,1); }
        .reveal-right.visible { opacity:1;transform:translateX(0); }
        .delay-1{transition-delay:0.1s !important}.delay-2{transition-delay:0.2s !important}
        .delay-3{transition-delay:0.3s !important}.delay-4{transition-delay:0.4s !important}
        .delay-5{transition-delay:0.5s !important}

        .section-tag { display:inline-block;background:var(--merah-muda);color:var(--merah);font-weight:700;font-size:0.78rem;padding:5px 14px;border-radius:50px;letter-spacing:0.5px;text-transform:uppercase;margin-bottom:10px; }
        .section-title { font-size:2rem;font-weight:800;color:#1a0a0a;letter-spacing:-0.4px; }
        .divider { width:50px;height:4px;background:linear-gradient(90deg,var(--merah),var(--emas-terang));border-radius:2px;margin:12px 0 20px; }

        /* VISI CARD */
        .visi-card {
            background:linear-gradient(135deg,var(--merah-tua),#991b1b);
            border-radius:24px;padding:44px;color:white;
            position:relative;overflow:hidden;
            box-shadow:0 12px 40px rgba(153,27,27,0.35);
        }
        .visi-card::before { content:'';position:absolute;top:-60px;right:-60px;width:220px;height:220px;background:rgba(255,255,255,0.06);border-radius:50%; }
        .visi-card::after { content:'';position:absolute;bottom:-40px;left:-40px;width:160px;height:160px;background:rgba(217,119,6,0.15);border-radius:50%; }
        .visi-icon { width:60px;height:60px;background:rgba(255,255,255,0.15);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;margin-bottom:20px;position:relative;z-index:1; }
        .visi-card h3 { font-weight:800;font-size:1.4rem;margin-bottom:16px;position:relative;z-index:1; }
        .visi-card p { opacity:0.88;line-height:1.9;font-size:1rem;position:relative;z-index:1;margin:0; }

        /* MISI CARD */
        .misi-card {
            background:white;border-radius:24px;padding:44px;
            box-shadow:0 4px 24px rgba(0,0,0,0.07);
            border-top:4px solid var(--emas-terang);
        }
        .misi-icon { width:60px;height:60px;background:var(--emas-muda);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:var(--emas);margin-bottom:20px; }
        .misi-card h3 { font-weight:800;font-size:1.4rem;color:#1a0a0a;margin-bottom:20px; }
        .misi-item { display:flex;gap:14px;align-items:flex-start;padding:14px 0;border-bottom:1px solid #f5ebe0; }
        .misi-item:last-child { border-bottom:none; }
        .misi-num { width:32px;height:32px;background:var(--merah-muda);color:var(--merah);border-radius:8px;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:0.82rem;flex-shrink:0; }
        .misi-text { font-size:0.92rem;color:#5a3a3a;line-height:1.6;padding-top:5px; }

        /* NILAI */
        .nilai-card {
            background:white;border-radius:20px;padding:28px 24px;text-align:center;
            box-shadow:0 4px 20px rgba(0,0,0,0.06);
            transition:all 0.3s;border-bottom:3px solid var(--merah);
        }
        .nilai-card:hover { transform:translateY(-6px);box-shadow:0 14px 36px rgba(153,27,27,0.12); }
        .nilai-icon { width:56px;height:56px;background:var(--merah-muda);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;color:var(--merah);margin:0 auto 16px; }
        .nilai-title { font-weight:800;font-size:1rem;color:#1a0a0a;margin-bottom:8px; }
        .nilai-desc { font-size:0.82rem;color:#7a5c5c;line-height:1.6;margin:0; }

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
                <li class="breadcrumb-item active">Visi & Misi</li>
            </ol>
        </nav>
        <h1>Visi & Misi</h1>
        <p>Landasan arah dan tujuan Karang Taruna Desa Waru dalam mengabdi dan berkarya untuk masyarakat.</p>
    </div>
</div>

<!-- KONTEN -->
<div style="padding:70px 0;">
    <div class="container">

        <!-- VISI & MISI -->
        <div class="row g-4 mb-5">
            <div class="col-lg-5 reveal-left">
                <div class="visi-card">
                    <div class="visi-icon"><i class="bi bi-eye-fill"></i></div>
                    <h3>Visi</h3>
                    <p>Terwujudnya Karang Taruna Desa Waru yang mandiri, kreatif, dan berdaya saing dalam membangun masyarakat yang sejahtera, berbudaya, dan bermartabat.</p>
                </div>
            </div>
            <div class="col-lg-7 reveal-right">
                <div class="misi-card">
                    <div class="misi-icon"><i class="bi bi-bullseye"></i></div>
                    <h3>Misi</h3>
                    <?php
                    $misi = [
                        'Meningkatkan kualitas sumber daya manusia pemuda Desa Waru melalui pendidikan dan pelatihan.',
                        'Mengembangkan potensi ekonomi kreatif dan memberdayakan UMKM lokal di desa.',
                        'Menyelenggarakan kegiatan sosial dan kemasyarakatan yang bermanfaat bagi warga.',
                        'Mempererat tali persaudaraan dan kebersamaan antar pemuda dan warga desa.',
                        'Mendukung dan berpartisipasi aktif dalam program pembangunan desa yang berkelanjutan.',
                    ];
                    foreach($misi as $i => $m): ?>
                    <div class="misi-item reveal delay-<?= $i+1 ?>">
                        <div class="misi-num"><?= $i+1 ?></div>
                        <div class="misi-text"><?= $m ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- NILAI-NILAI -->
        <div class="text-center mb-5 reveal">
            <span class="section-tag">Landasan</span>
            <h2 class="section-title mt-1">Nilai-Nilai Kami</h2>
            <div class="divider mx-auto"></div>
            <p style="color:#7a5c5c;max-width:520px;margin:0 auto;">Prinsip-prinsip yang menjadi fondasi setiap langkah dan keputusan organisasi.</p>
        </div>
        <div class="row g-3">
            <?php
            $nilai = [
                ['icon'=>'bi-heart-fill','judul'=>'Kebersamaan','desc'=>'Mengutamakan semangat gotong royong dan kebersamaan dalam setiap kegiatan.'],
                ['icon'=>'bi-shield-fill-check','judul'=>'Integritas','desc'=>'Bertindak jujur, amanah, dan bertanggung jawab dalam setiap amanah yang diterima.'],
                ['icon'=>'bi-lightbulb-fill','judul'=>'Inovasi','desc'=>'Terus berinovasi untuk menghadirkan solusi kreatif bagi tantangan masyarakat.'],
                ['icon'=>'bi-person-hearts','judul'=>'Pelayanan','desc'=>'Melayani masyarakat dengan sepenuh hati tanpa pamrih dan diskriminasi.'],
                ['icon'=>'bi-award-fill','judul'=>'Kemandirian','desc'=>'Membangun kemandirian organisasi dan anggota agar tidak bergantung pada pihak lain.'],
                ['icon'=>'bi-globe2','judul'=>'Inklusivitas','desc'=>'Terbuka dan menerima semua kalangan tanpa memandang latar belakang.'],
            ];
            foreach($nilai as $i => $n): ?>
            <div class="col-md-4 col-sm-6 reveal delay-<?= ($i % 3) + 1 ?>">
                <div class="nilai-card">
                    <div class="nilai-icon"><i class="bi <?= $n['icon'] ?>"></i></div>
                    <div class="nilai-title"><?= $n['judul'] ?></div>
                    <p class="nilai-desc"><?= $n['desc'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
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
                    <li class="mb-2"><i class="bi bi-envelope me-2" style="color:var(--emas-terang);"></i>karangtaruna.desawaru@gmail.com</li>
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