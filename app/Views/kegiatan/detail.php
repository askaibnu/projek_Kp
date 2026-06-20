<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $kegiatan->nama ?> - Karang Taruna Waru</title>
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
        .btn-kembali {
            display:inline-flex;align-items:center;gap:6px;
            background:var(--merah-muda);color:var(--merah);
            border:none;border-radius:50px;padding:7px 18px;
            font-size:0.82rem;font-weight:700;text-decoration:none;transition:all 0.2s;
        }
        .btn-kembali:hover { background:var(--merah);color:white; }

        /* BREADCRUMB STRIP */
        .breadcrumb-strip {
            background:white;border-bottom:1px solid rgba(153,27,27,0.08);
            padding:12px 0;
        }
        .breadcrumb-strip .breadcrumb { margin:0;font-size:0.8rem; }
        .breadcrumb-item a { color:var(--merah);text-decoration:none;font-weight:600; }
        .breadcrumb-item.active { color:#7a5c5c;font-weight:500; }
        .breadcrumb-item+.breadcrumb-item::before { color:#ccc; }

        /* HERO IMAGE */
        .hero-img {
            width:100%;height:440px;object-fit:cover;
            border-radius:20px;
        }
        .hero-placeholder {
            width:100%;height:440px;
            background:linear-gradient(135deg,var(--merah-tua),#991b1b);
            border-radius:20px;
            display:flex;align-items:center;justify-content:center;
        }

        /* CAROUSEL */
        .carousel { border-radius:20px;overflow:hidden;margin-bottom:16px; }
        .carousel-inner img { width:100%;height:440px;object-fit:cover; }
        .carousel-control-prev, .carousel-control-next {
            width:44px;height:44px;
            background:rgba(0,0,0,0.5);
            border-radius:50%;
            top:50%;transform:translateY(-50%);
            margin:0 12px;
        }
        .carousel-indicators [data-bs-target] {
            width:8px;height:8px;border-radius:50%;
            background:rgba(255,255,255,0.6);border:none;
        }
        .carousel-indicators .active { background:white; }

        /* THUMBNAILS */
        .thumb-img {
            width:80px;height:60px;object-fit:cover;
            border-radius:10px;cursor:pointer;
            border:2px solid transparent;transition:all 0.2s;
        }
        .thumb-img:hover { border-color:var(--merah); }

        /* BADGE TANGGAL */
        .badge-tanggal {
            background:var(--emas-muda);color:var(--emas);
            padding:8px 18px;border-radius:50px;
            font-size:0.85rem;font-weight:700;
            display:inline-flex;align-items:center;gap:7px;
            border:1px solid rgba(180,83,9,0.15);
        }

        /* DIVIDER */
        .divider-merah {
            width:60px;height:4px;
            background:linear-gradient(90deg,var(--merah),var(--emas-terang));
            border-radius:2px;margin-bottom:28px;
        }

        /* ISI KONTEN */
        .isi-kegiatan {
            font-size:1.03rem;line-height:2;
            color:#4a2a2a;text-align:justify;
        }

        /* SHARE BUTTONS */
        .share-section { border-top:1px solid var(--krem-gelap);padding-top:28px;margin-top:36px; }
        .share-title { font-weight:700;color:#3a2a2a;margin-bottom:14px;font-size:0.95rem; }
        .btn-share {
            display:inline-flex;align-items:center;gap:7px;
            padding:9px 18px;border-radius:10px;
            font-size:0.82rem;font-weight:700;
            text-decoration:none;transition:all 0.2s;border:none;
        }
        .btn-share:hover { transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,0.15); }
        .btn-share.wa { background:#25d366;color:white; }
        .btn-share.wa:hover { background:#128c7e;color:white; }
        .btn-share.fb { background:#1877f2;color:white; }
        .btn-share.fb:hover { background:#0d5fc7;color:white; }
        .btn-share.ig { background:linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888);color:white; }

        /* SIDEBAR */
        .sidebar-card {
            background:white;border-radius:20px;
            padding:24px;box-shadow:0 4px 24px rgba(0,0,0,0.07);
            position:sticky;top:90px;
        }
        .sidebar-title {
            font-weight:800;color:#1a0a0a;font-size:1rem;
            margin-bottom:18px;padding-bottom:14px;
            border-bottom:2px solid var(--krem-gelap);
            display:flex;align-items:center;gap:8px;
        }
        .sidebar-title i { color:var(--merah); }

        /* CARD BERITA KECIL */
        .card-kecil {
            border-radius:14px;overflow:hidden;
            box-shadow:0 2px 12px rgba(0,0,0,0.07);
            transition:all 0.3s;cursor:pointer;
            text-decoration:none;display:block;
            margin-bottom:14px;border:1px solid rgba(153,27,27,0.06);
        }
        .card-kecil:hover { transform:translateY(-4px);box-shadow:0 10px 28px rgba(153,27,27,0.12); }
        .card-kecil img { width:100%;height:110px;object-fit:cover; }
        .card-kecil .ck-placeholder {
            height:110px;
            background:linear-gradient(135deg,var(--krem-gelap),#e8d5c4);
            display:flex;align-items:center;justify-content:center;
        }
        .card-kecil .ck-body { padding:12px 14px; }
        .ck-date { font-size:0.72rem;color:var(--emas);font-weight:700;margin-bottom:4px; }
        .ck-title { font-size:0.85rem;font-weight:700;color:#1a0a0a;line-height:1.4;margin:0; }

        .btn-semua {
            display:block;text-align:center;
            background:var(--merah-muda);color:var(--merah);
            border:none;border-radius:12px;padding:11px;
            font-size:0.85rem;font-weight:700;
            text-decoration:none;transition:all 0.2s;
            margin-top:6px;
        }
        .btn-semua:hover { background:var(--merah);color:white; }

        /* FOOTER */
        footer { background:linear-gradient(135deg,#1c0808,#2d0f0f);color:white;padding:40px 0 20px;margin-top:70px; }
        footer h5 { color:#f0c090;font-size:0.78rem;text-transform:uppercase;letter-spacing:1.5px;font-weight:700; }
        footer a { color:rgba(255,255,255,0.65);text-decoration:none;transition:color 0.2s; }
        footer a:hover { color:white; }
        .footer-bottom { border-top:1px solid rgba(255,255,255,0.08);padding-top:16px;margin-top:24px; }

        /* REVEAL */
        .reveal { opacity:0;transform:translateY(28px);transition:opacity 0.6s cubic-bezier(.22,1,.36,1),transform 0.6s cubic-bezier(.22,1,.36,1); }
        .reveal.visible { opacity:1;transform:translateY(0); }
        .delay-1{transition-delay:0.1s !important}.delay-2{transition-delay:0.15s !important}.delay-3{transition-delay:0.2s !important}
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
                <li class="nav-item"><a class="nav-link" href="<?= site_url('berita') ?>">Kegiatan</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('umkm-publik') ?>">UMKM</a></li>
                <li class="nav-item">
                    <a href="<?= site_url('berita') ?>" class="btn-kembali">
                        <i class="bi bi-arrow-left"></i>Kembali
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- BREADCRUMB -->
<div class="breadcrumb-strip">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Beranda</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('berita') ?>">Kegiatan</a></li>
                <li class="breadcrumb-item active"><?= strlen($kegiatan->nama) > 40 ? substr($kegiatan->nama,0,40).'...' : $kegiatan->nama ?></li>
            </ol>
        </nav>
    </div>
</div>

<!-- KONTEN -->
<div class="container py-5">
    <div class="row g-5">

        <!-- KONTEN UTAMA -->
        <div class="col-lg-8">

            <!-- FOTO CAROUSEL -->
            <?php 
            $semuaFoto = [];
            if($kegiatan->foto) $semuaFoto[] = $kegiatan->foto;
            foreach($foto_tambahan as $f) $semuaFoto[] = $f->foto;
            ?>

            <?php if(count($semuaFoto) > 1): ?>
            <div class="reveal">
                <div id="carouselKegiatan" class="carousel slide mb-3">
                    <div class="carousel-indicators">
                        <?php foreach($semuaFoto as $i => $f): ?>
                        <button type="button" data-bs-target="#carouselKegiatan" data-bs-slide-to="<?= $i ?>" 
                                <?= $i == 0 ? 'class="active"' : '' ?>></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="carousel-inner">
                        <?php foreach($semuaFoto as $i => $f): ?>
                        <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">
                            <img src="<?= base_url('uploads/'.$f) ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselKegiatan" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselKegiatan" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
                <!-- THUMBNAIL -->
                <div class="d-flex gap-2 mb-4 flex-wrap" id="thumbnailContainer">
                    <?php foreach($semuaFoto as $i => $f): ?>
                    <img src="<?= base_url('uploads/'.$f) ?>"
                         class="thumb-img"
                         data-index="<?= $i ?>">
                    <?php endforeach; ?>
                </div>
            </div>

            <?php elseif(count($semuaFoto) == 1): ?>
            <div class="reveal">
                <img src="<?= base_url('uploads/'.$semuaFoto[0]) ?>" class="hero-img mb-4">
            </div>
            <?php else: ?>
            <div class="reveal">
                <div class="hero-placeholder mb-4">
                    <i class="bi bi-calendar-event" style="font-size:5rem;color:rgba(255,255,255,0.25);"></i>
                </div>
            </div>
            <?php endif; ?>

            <!-- TANGGAL -->
            <div class="mb-3 reveal delay-1">
                <span class="badge-tanggal">
                    <i class="bi bi-calendar3"></i>
                    <?= date('d F Y', strtotime($kegiatan->tanggal)) ?>
                </span>
            </div>

            <!-- JUDUL -->
            <h1 class="reveal delay-2" style="font-weight:800;color:#1a0a0a;line-height:1.3;margin-bottom:16px;font-size:2rem;letter-spacing:-0.4px;">
                <?= $kegiatan->nama ?>
            </h1>

            <!-- DIVIDER -->
            <div class="divider-merah reveal delay-3"></div>

            <!-- DESKRIPSI -->
            <div class="isi-kegiatan reveal">
                <?= nl2br($kegiatan->deskripsi) ?>
            </div>

            <!-- SHARE -->
            <div class="share-section reveal">
                <p class="share-title"><i class="bi bi-share-fill me-2" style="color:var(--merah);"></i>Bagikan kegiatan ini:</p>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="https://wa.me/?text=<?= urlencode($kegiatan->nama . ' - Karang Taruna Desa Waru') ?>"
                       target="_blank" class="btn-share wa">
                        <i class="bi bi-whatsapp"></i>WhatsApp
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>"
                       target="_blank" class="btn-share fb">
                        <i class="bi bi-facebook"></i>Facebook
                    </a>
                    <a href="https://www.instagram.com/"
                       target="_blank" class="btn-share ig">
                        <i class="bi bi-instagram"></i>Instagram
                    </a>
                </div>
            </div>
        </div>

        <!-- SIDEBAR -->
        <div class="col-lg-4">
            <div class="sidebar-card reveal">
                <div class="sidebar-title">
                    <i class="bi bi-calendar-check-fill"></i> Kegiatan Lainnya
                </div>
                <?php foreach($semua as $k): ?>
                <?php if($k->id != $kegiatan->id): ?>
                <a href="<?= site_url('kegiatan/detail/'.$k->id) ?>" class="card-kecil">
                    <?php if($k->foto): ?>
                        <img src="<?= base_url('uploads/'.$k->foto) ?>">
                    <?php else: ?>
                        <div class="ck-placeholder">
                            <i class="bi bi-calendar-event" style="font-size:1.8rem;color:var(--merah);opacity:0.4;"></i>
                        </div>
                    <?php endif; ?>
                    <div class="ck-body">
                        <div class="ck-date"><i class="bi bi-clock me-1"></i><?= date('d M Y', strtotime($k->tanggal)) ?></div>
                        <p class="ck-title"><?= strlen($k->nama) > 50 ? substr($k->nama,0,50).'...' : $k->nama ?></p>
                    </div>
                </a>
                <?php endif; ?>
                <?php endforeach; ?>

                <a href="<?= site_url('berita') ?>" class="btn-semua">
                    <i class="bi bi-arrow-left me-1"></i>Lihat Semua Kegiatan
                </a>
            </div>
        </div>

    </div>
</div>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <img src="<?= base_url('uploads/logo.png') ?>" height="44" style="border-radius:8px;">
                    <div>
                        <div style="color:white;font-weight:800;">Karang Taruna</div>
                        <small style="color:rgba(255,255,255,0.5);">Desa Waru</small>
                    </div>
                </div>
                <p style="color:rgba(255,255,255,0.55);font-size:0.85rem;margin:0;">Organisasi kepemudaan Desa Waru, Kab. Bogor.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <ul class="list-unstyled d-flex gap-3 justify-content-md-end mb-0 flex-wrap" style="font-size:0.85rem;">
                    <li><a href="<?= site_url('/') ?>">Beranda</a></li>
                    <li><a href="<?= site_url('berita') ?>">Kegiatan</a></li>
                    <li><a href="<?= site_url('umkm-publik') ?>">UMKM</a></li>
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
// PROGRESS & NAVBAR
window.addEventListener('scroll', () => {
    const doc = document.documentElement;
    document.getElementById('readingProgress').style.width = (doc.scrollTop / (doc.scrollHeight - doc.clientHeight) * 100) + '%';
    document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 50);
});

// SCROLL REVEAL
const observer = new IntersectionObserver(e => e.forEach(x => { if(x.isIntersecting) x.target.classList.add('visible'); }), { threshold:0.1 });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));


// CAROUSEL
const carouselEl = document.getElementById('carouselKegiatan');
if(carouselEl) {
    const carousel = new bootstrap.Carousel(carouselEl, { 
        interval: 1760,
        ride: 'carousel',
        pause: 'hover'
    });
    document.querySelectorAll('.thumb-img').forEach(img => {
        img.addEventListener('click', () => carousel.to(parseInt(img.dataset.index)));
        img.addEventListener('mouseover', () => img.style.borderColor = '#991b1b');
        img.addEventListener('mouseout', () => img.style.borderColor = 'transparent');
    });
}
</script>
</body>
</html>