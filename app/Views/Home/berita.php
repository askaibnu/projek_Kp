<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan — Karang Taruna Waru</title>
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
        .nav-link:hover,.nav-link.active { color:var(--merah) !important; }
        .dropdown-menu { border:1px solid rgba(153,27,27,0.1);box-shadow:0 8px 24px rgba(0,0,0,0.09);border-radius:12px; }
        .dropdown-item:hover { background:var(--merah-muda);color:var(--merah); }

        .page-hero { background:linear-gradient(135deg,var(--merah-tua) 0%,#991b1b 50%,#b45309 100%);padding:80px 0 60px;color:white;position:relative;overflow:hidden; }
        .page-hero::before { content:'';position:absolute;top:-80px;right:-80px;width:320px;height:320px;background:radial-gradient(circle,rgba(255,255,255,0.07),transparent 70%);border-radius:50%; }
        .page-hero::after { content:'';position:absolute;bottom:-60px;left:10%;width:220px;height:220px;background:radial-gradient(circle,rgba(217,119,6,0.2),transparent 70%);border-radius:50%; }
        .page-hero .breadcrumb-item { color:rgba(255,255,255,0.6);font-size:0.82rem; }
        .page-hero .breadcrumb-item a { color:rgba(255,255,255,0.7);text-decoration:none; }
        .page-hero .breadcrumb-item.active { color:rgba(255,255,255,0.9); }
        .page-hero h1 { font-size:2.6rem;font-weight:800;letter-spacing:-0.5px;margin-top:12px; }
        .page-hero p { opacity:0.8;font-size:1rem;max-width:540px;margin-top:10px; }
        .hero-stat { display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.2);padding:8px 18px;border-radius:50px;font-size:0.85rem;font-weight:600;margin-top:16px;margin-right:8px; }

        .reveal { opacity:0;transform:translateY(36px);transition:opacity 0.7s cubic-bezier(.22,1,.36,1),transform 0.7s cubic-bezier(.22,1,.36,1); }
        .reveal.visible { opacity:1;transform:translateY(0); }
        .delay-1{transition-delay:0.1s !important}.delay-2{transition-delay:0.2s !important}
        .delay-3{transition-delay:0.3s !important}.delay-4{transition-delay:0.4s !important}

        /* FILTER BAR */
        .filter-bar { background:white;border-radius:16px;padding:20px 24px;box-shadow:0 4px 20px rgba(0,0,0,0.06);margin-bottom:32px; }
        .search-input { border:1.5px solid #e8d5c4;border-radius:12px;padding:11px 16px 11px 42px;font-size:0.9rem;width:100%;outline:none;transition:border-color 0.2s;font-family:'Plus Jakarta Sans',sans-serif;background:var(--krem); }
        .search-input:focus { border-color:var(--merah);background:white; }

        /* FEATURED */
        .card-featured { border:none;border-radius:24px;overflow:hidden;box-shadow:0 8px 40px rgba(153,27,27,0.12);transition:all 0.35s cubic-bezier(.22,1,.36,1);cursor:pointer;background:white; }
        .card-featured:hover { transform:translateY(-6px);box-shadow:0 20px 60px rgba(153,27,27,0.18); }
        .feat-img { width:100%;height:100%;min-height:300px;object-fit:cover; }
        .feat-placeholder { height:100%;min-height:300px;background:linear-gradient(135deg,var(--merah-tua),#991b1b);display:flex;align-items:center;justify-content:center; }
        .feat-body { padding:36px; }
        .feat-badge { display:inline-flex;align-items:center;gap:6px;background:var(--merah-muda);color:var(--merah);font-size:0.75rem;font-weight:700;padding:5px 12px;border-radius:50px;margin-bottom:14px; }
        .feat-title { font-size:1.6rem;font-weight:800;color:#1a0a0a;line-height:1.3;margin-bottom:12px;letter-spacing:-0.3px; }
        .feat-desc { color:#7a5c5c;line-height:1.8;font-size:0.95rem;margin-bottom:20px; }
        .feat-meta { display:flex;align-items:center;gap:16px;font-size:0.8rem;color:#a08080;font-weight:600;margin-bottom:24px; }
        .feat-meta i { color:var(--merah); }
        .btn-baca { display:inline-flex;align-items:center;gap:8px;background:var(--merah);color:white;font-weight:700;font-size:0.88rem;padding:11px 24px;border-radius:12px;text-decoration:none;transition:all 0.2s; }
        .btn-baca:hover { background:var(--merah-tua);color:white;transform:translateX(3px); }

        /* REGULAR CARDS */
        .card-berita { border:none;border-radius:20px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.07);transition:all 0.35s cubic-bezier(.22,1,.36,1);cursor:pointer;background:white;height:100%;border-bottom:3px solid transparent; }
        .card-berita:hover { transform:translateY(-8px);box-shadow:0 20px 50px rgba(153,27,27,0.12);border-bottom-color:var(--merah); }
        .card-img-top { width:100%;height:190px;object-fit:cover; }
        .card-placeholder { height:190px;background:linear-gradient(135deg,var(--merah-tua),#991b1b);display:flex;align-items:center;justify-content:center; }
        .card-date { display:inline-flex;align-items:center;gap:5px;background:var(--emas-muda);color:var(--emas);font-size:0.72rem;font-weight:700;padding:4px 10px;border-radius:6px;margin-bottom:10px; }
        .card-berita h5 { font-weight:800;font-size:0.97rem;color:#1a0a0a;line-height:1.4;margin-bottom:8px; }
        .card-berita p { font-size:0.82rem;color:#7a5c5c;line-height:1.6;margin-bottom:14px; }
        .btn-selengkapnya { display:inline-flex;align-items:center;gap:6px;color:var(--merah);font-size:0.8rem;font-weight:700;text-decoration:none;transition:gap 0.2s; }
        .btn-selengkapnya:hover { color:var(--merah-tua);gap:10px; }

        /* LIST VIEW */
        .card-list { background:white;border-radius:16px;overflow:hidden;box-shadow:0 3px 16px rgba(0,0,0,0.06);transition:all 0.3s;display:flex;border-left:4px solid transparent;cursor:pointer;margin-bottom:14px; }
        .card-list:hover { transform:translateX(6px);box-shadow:0 8px 30px rgba(153,27,27,0.1);border-left-color:var(--merah); }
        .list-img { width:140px;min-height:110px;object-fit:cover;flex-shrink:0; }
        .list-placeholder { width:140px;min-height:110px;background:linear-gradient(135deg,var(--krem-gelap),#e8d5c4);display:flex;align-items:center;justify-content:center;flex-shrink:0; }
        .list-body { padding:16px 20px;flex:1; }
        .list-date { font-size:0.72rem;font-weight:700;color:var(--emas);margin-bottom:6px; }
        .list-title { font-weight:700;font-size:0.92rem;color:#1a0a0a;line-height:1.4;margin-bottom:6px; }
        .list-desc { font-size:0.8rem;color:#7a5c5c;line-height:1.5;margin:0; }

        /* VIEW TOGGLE */
        .view-btn { width:36px;height:36px;border-radius:9px;border:1.5px solid #e8d5c4;background:white;display:flex;align-items:center;justify-content:center;color:#a08080;cursor:pointer;transition:all 0.2s;font-size:0.95rem; }
        .view-btn.active { background:var(--merah);border-color:var(--merah);color:white; }
        .view-btn:hover:not(.active) { border-color:var(--merah);color:var(--merah); }

        /* EMPTY */
        .empty-state { text-align:center;padding:80px 20px; }
        .empty-icon { width:80px;height:80px;background:var(--merah-muda);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2rem;color:var(--merah);margin:0 auto 20px; }

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
    <li class="nav-item"><a class="nav-link active" href="<?= site_url('berita') ?>" style="color:var(--merah) !important;">berita</a></li>
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
                <li class="breadcrumb-item active">Kegiatan</li>
            </ol>
        </nav>
        <h1>Kegiatan Kami</h1>
        <p>Dokumentasi dan laporan berbagai kegiatan sosial, pemberdayaan masyarakat, dan aktivitas Karang Taruna Desa Waru.</p>
        <div>
            <span class="hero-stat"><i class="bi bi-calendar-event"></i> <?= count($kegiatan) ?> Kegiatan</span>
            <span class="hero-stat"><i class="bi bi-clock-history"></i> Terbaru <?= !empty($kegiatan) ? date('Y', strtotime($kegiatan[0]->tanggal)) : date('Y') ?></span>
        </div>
    </div>
</div>

<!-- KONTEN -->
<div style="padding:60px 0;">
    <div class="container">

        <?php if(!empty($kegiatan)): ?>

        <!-- FEATURED -->
        <div class="reveal mb-5">
            <div class="card-featured" onclick="window.location='<?= site_url('kegiatan/detail/'.$kegiatan[0]->id) ?>'">
                <div class="row g-0">
                    <div class="col-lg-6">
                        <?php if($kegiatan[0]->foto): ?>
                            <img src="<?= base_url('uploads/'.$kegiatan[0]->foto) ?>" class="feat-img">
                        <?php else: ?>
                            <div class="feat-placeholder">
                                <i class="bi bi-calendar-event" style="font-size:4rem;color:rgba(255,255,255,0.3);"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="feat-body">
                            <div class="feat-badge"><i class="bi bi-star-fill"></i> Kegiatan Terbaru</div>
                            <div class="feat-title"><?= $kegiatan[0]->nama ?></div>
                            <div class="feat-desc"><?= substr($kegiatan[0]->deskripsi, 0, 160) ?>...</div>
                            <div class="feat-meta">
                                <span><i class="bi bi-calendar3"></i> <?= date('d F Y', strtotime($kegiatan[0]->tanggal)) ?></span>
                                <span><i class="bi bi-geo-alt-fill"></i> Desa Waru</span>
                            </div>
                            <a href="<?= site_url('kegiatan/detail/'.$kegiatan[0]->id) ?>" class="btn-baca">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(count($kegiatan) > 1): ?>

        <!-- FILTER -->
        <div class="filter-bar reveal">
            <div class="row align-items-center g-3">
                <div class="col-md-5">
                    <div style="position:relative;">
                        <i class="bi bi-search" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#a08080;font-size:0.9rem;"></i>
                        <input type="text" id="searchBerita" class="search-input" placeholder="Cari kegiatan..." onkeyup="filterBerita()">
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="totalHasil" style="font-size:0.85rem;color:#7a5c5c;font-weight:600;">
                        Menampilkan <strong><?= count($kegiatan) - 1 ?></strong> kegiatan
                    </div>
                </div>
                <div class="col-md-3 d-flex justify-content-md-end gap-2">
                    <button class="view-btn active" id="btnGrid" onclick="setView('grid')" title="Grid View">
                        <i class="bi bi-grid-fill"></i>
                    </button>
                    <button class="view-btn" id="btnList" onclick="setView('list')" title="List View">
                        <i class="bi bi-list-ul"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- GRID VIEW -->
        <div id="viewGrid" class="row g-4">
            <?php foreach($kegiatan as $i => $k): ?>
                <?php if($i == 0) continue; ?>
                <div class="col-md-4 col-sm-6 berita-item reveal delay-<?= (($i-1) % 3) + 1 ?>">
                    <div class="card-berita" onclick="window.location='<?= site_url('kegiatan/detail/'.$k->id) ?>'">
                        <?php if($k->foto): ?>
                            <img src="<?= base_url('uploads/'.$k->foto) ?>" class="card-img-top">
                        <?php else: ?>
                            <div class="card-placeholder">
                                <i class="bi bi-calendar-event" style="font-size:2.5rem;color:rgba(255,255,255,0.35);"></i>
                            </div>
                        <?php endif; ?>
                        <div class="card-body p-4">
                            <div class="card-date">
                                <i class="bi bi-calendar3"></i> <?= date('d M Y', strtotime($k->tanggal)) ?>
                            </div>
                            <h5><?= $k->nama ?></h5>
                            <p><?= substr($k->deskripsi, 0, 90) ?>...</p>
                            <a href="<?= site_url('kegiatan/detail/'.$k->id) ?>" class="btn-selengkapnya">
                                Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- LIST VIEW -->
        <div id="viewList" class="d-none">
            <?php foreach($kegiatan as $i => $k): ?>
                <?php if($i == 0) continue; ?>
                <div class="card-list berita-item reveal delay-<?= (($i-1) % 3) + 1 ?>"
                     onclick="window.location='<?= site_url('kegiatan/detail/'.$k->id) ?>'">
                    <?php if($k->foto): ?>
                        <img src="<?= base_url('uploads/'.$k->foto) ?>" class="list-img">
                    <?php else: ?>
                        <div class="list-placeholder">
                            <i class="bi bi-calendar-event" style="color:var(--merah);opacity:0.4;font-size:1.2rem;"></i>
                        </div>
                    <?php endif; ?>
                    <div class="list-body">
                        <div class="list-date"><i class="bi bi-calendar3 me-1"></i><?= date('d F Y', strtotime($k->tanggal)) ?></div>
                        <div class="list-title"><?= $k->nama ?></div>
                        <p class="list-desc"><?= substr($k->deskripsi, 0, 120) ?>...</p>
                    </div>
                    <div class="d-flex align-items-center" style="padding-right:20px;">
                        <i class="bi bi-chevron-right" style="color:var(--merah);font-size:1.1rem;"></i>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- NO RESULT -->
        <div id="noResult" style="display:none;" class="text-center py-5">
            <div class="empty-icon" style="margin:0 auto 16px;"><i class="bi bi-search"></i></div>
            <h6 style="font-weight:700;">Kegiatan tidak ditemukan</h6>
            <p style="color:#7a5c5c;font-size:0.88rem;">Coba kata kunci yang berbeda.</p>
        </div>

        <?php endif; ?>

        <?php else: ?>
        <div class="empty-state">
            <div class="empty-icon"><i class="bi bi-calendar-x"></i></div>
            <h5 style="font-weight:800;color:#1a0a0a;">Belum Ada Kegiatan</h5>
            <p style="color:#7a5c5c;">Kegiatan akan segera ditambahkan. Pantau terus halaman ini!</p>
            <a href="<?= site_url('/') ?>" class="btn-baca mt-3" style="display:inline-flex;">
                <i class="bi bi-house-fill me-2"></i>Kembali ke Beranda
            </a>
        </div>
        <?php endif; ?>

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
                <h5>Navigasi</h5>
                <ul class="list-unstyled mt-3" style="font-size:0.87rem;">
                    <li class="mb-2"><a href="<?= site_url('/') ?>">Beranda</a></li>
                    <li class="mb-2"><a href="<?= site_url('profil/sejarah') ?>">Sejarah</a></li>
                    <li class="mb-2"><a href="<?= site_url('anggota-publik') ?>">Anggota</a></li>
                    <li class="mb-2"><a href="<?= site_url('umkm-publik') ?>">UMKM</a></li>
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

const observer = new IntersectionObserver(e => e.forEach(x => { if(x.isIntersecting) x.target.classList.add('visible'); }), { threshold:0.1, rootMargin:'0px 0px -40px 0px' });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

function setView(v) {
    const isGrid = v === 'grid';
    document.getElementById('viewGrid').classList.toggle('d-none', !isGrid);
    document.getElementById('viewList').classList.toggle('d-none', isGrid);
    document.getElementById('btnGrid').classList.toggle('active', isGrid);
    document.getElementById('btnList').classList.toggle('active', !isGrid);
}

function filterBerita() {
    const q = document.getElementById('searchBerita').value.toLowerCase();
    const items = document.querySelectorAll('.berita-item');
    let visible = 0;
    items.forEach(item => {
        const show = item.innerText.toLowerCase().includes(q);
        item.style.display = show ? '' : 'none';
        if(show) visible++;
    });
    document.getElementById('totalHasil').innerHTML = 'Menampilkan <strong>' + visible + '</strong> kegiatan';
    document.getElementById('noResult').style.display = visible === 0 ? 'block' : 'none';
}
</script>
</body>
</html>