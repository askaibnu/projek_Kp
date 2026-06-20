<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan - Karang Taruna Waru</title>
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

        /* PROGRESS */
        #progress { position: fixed; top: 0; left: 0; height: 3px; background: linear-gradient(90deg, var(--merah), var(--emas-terang)); z-index: 9999; width: 0%; transition: width 0.1s; }

        /* NAVBAR */
        .navbar {
            background: rgba(253,248,240,0.97);
            backdrop-filter: blur(16px);
            box-shadow: 0 4px 24px rgba(127,29,29,0.1);
            padding: 10px 0;
            transition: all 0.3s;
        }
        .navbar-brand { font-family: 'Fraunces', serif; font-weight: 700; font-size: 1.25rem; color: var(--merah-tua) !important; }
        .nav-link { font-weight: 600; font-size: 0.875rem; color: #5a3a3a !important; padding: 6px 12px !important; border-radius: 8px; transition: all 0.2s; }
        .nav-link:hover, .nav-link.active-link { color: var(--merah) !important; background: var(--merah-muda); }
        .dropdown-menu { border: 1px solid rgba(153,27,27,0.1); box-shadow: 0 12px 32px rgba(0,0,0,0.08); border-radius: 14px; padding: 8px; }
        .dropdown-item { border-radius: 8px; font-size: 0.875rem; font-weight: 600; color: #5a3a3a; padding: 8px 14px; }
        .dropdown-item:hover { background: var(--merah-muda); color: var(--merah); }

        /* PAGE HEADER */
        .page-header {
            background: linear-gradient(135deg, var(--merah-tua) 0%, #991b1b 60%, #c2410c 100%);
            padding: 80px 0 60px;
            position: relative;
            overflow: hidden;
        }
        .page-header::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 70% 80% at 80% 50%, rgba(255,255,255,0.06), transparent 70%);
        }
        .page-header::after {
            content: '';
            position: absolute; bottom: -1px; left: 0; right: 0; height: 40px;
            background: var(--krem);
            clip-path: ellipse(55% 100% at 50% 100%);
        }
        .page-header .breadcrumb-item a { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.82rem; font-weight: 600; }
        .page-header .breadcrumb-item.active { color: rgba(255,255,255,0.5); font-size: 0.82rem; }
        .page-header .breadcrumb-item+.breadcrumb-item::before { color: rgba(255,255,255,0.3); }

        /* SECTION */
        .sec-label {
            font-size: 0.72rem; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase;
            color: var(--merah); background: var(--merah-muda);
            display: inline-block; padding: 4px 14px; border-radius: 50px; margin-bottom: 14px;
        }
        .sec-title {
            font-family: 'Fraunces', serif;
            font-size: clamp(1.8rem, 3vw, 2.4rem);
            font-weight: 700; color: #1a0a0a; letter-spacing: -0.5px; line-height: 1.2;
        }

        /* CARDS */
        .card-kegiatan {
            background: white; border-radius: 20px;
            overflow: hidden; border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: all 0.35s cubic-bezier(.22,1,.36,1);
            cursor: pointer;
            border-bottom: 3px solid transparent;
            height: 100%;
            text-decoration: none;
            display: block;
            color: inherit;
        }
        .card-kegiatan:hover { transform: translateY(-8px); box-shadow: 0 20px 50px rgba(153,27,27,0.12); border-bottom-color: var(--merah); color: inherit; }
        .card-kegiatan img { height: 200px; object-fit: cover; width: 100%; }
        .card-k-placeholder { height: 200px; background: linear-gradient(135deg, var(--merah-tua), #991b1b); display: flex; align-items: center; justify-content: center; }
        .card-k-date { font-size: 0.72rem; font-weight: 700; color: var(--emas); margin-bottom: 8px; }
        .card-k-title { font-weight: 700; font-size: 0.95rem; color: #1a0a0a; line-height: 1.4; margin-bottom: 8px; }
        .card-k-desc { font-size: 0.82rem; color: #a08080; line-height: 1.6; margin: 0; }

        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 80px 20px; }
        .empty-state i { font-size: 4rem; color: #ddc0b0; display: block; margin-bottom: 16px; }
        .empty-state p { color: #a08080; font-size: 1rem; }

        /* REVEAL */
        .reveal { opacity:0; transform:translateY(28px); transition:opacity 0.6s cubic-bezier(.22,1,.36,1),transform 0.6s cubic-bezier(.22,1,.36,1); }
        .reveal.visible { opacity:1; transform:translateY(0); }
        .d1{transition-delay:.05s!important} .d2{transition-delay:.1s!important} .d3{transition-delay:.15s!important}
        .d4{transition-delay:.2s!important} .d5{transition-delay:.25s!important} .d6{transition-delay:.3s!important}

        /* FOOTER */
        footer { background: linear-gradient(135deg, #1c0808, #2d0f0f); color: white; padding: 60px 0 24px; }
        footer h6 { color: var(--emas-terang); font-size: 0.72rem; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; margin-bottom: 16px; }
        footer a { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.875rem; transition: color 0.2s; }
        footer a:hover { color: white; }
        footer li { margin-bottom: 10px; }
        .footer-divider { border-top: 1px solid rgba(255,255,255,0.08); padding-top: 20px; margin-top: 40px; }
        .social-btn { width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; font-size: 0.95rem; transition: all 0.3s; }
        .social-btn:hover { transform: translateY(-3px) scale(1.1); color: white; }

        /* DARK MODE */
        body.dark { background: #180808; color: #f0dada; }
        body.dark .navbar { background: rgba(24,8,8,0.97) !important; }
        body.dark .navbar .nav-link { color: #e5c5c5 !important; }
        body.dark .navbar .navbar-brand { color: #fca5a5 !important; }
        body.dark .card-kegiatan { background: #2d0f0f !important; }
        body.dark .card-k-title { color: #f9e8e8; }
        body.dark .sec-title { color: #f9e8e8 !important; }
        body.dark .dropdown-menu { background: #2d0f0f; border-color: #4d1f1f; }
        body.dark .dropdown-item { color: #e5c5c5; }
        body.dark .dropdown-item:hover { background: #4d1f1f; }
        body.dark #btnDark { background: #3d1515 !important; border-color: #5d2020 !important; }
    </style>
</head>
<body>

<div id="progress"></div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg sticky-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('/') ?>">
            <img src="<?= base_url('uploads/logo.png') ?>" height="36" class="me-2" style="border-radius:6px;">Karang Taruna Waru
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto gap-1 align-items-center">
                <li class="nav-item"><a class="nav-link" href="<?= site_url('/') ?>">Beranda</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Profil</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= site_url('profil/sejarah') ?>">Sejarah</a></li>
                        <li><a class="dropdown-item" href="<?= site_url('profil/visimisi') ?>">Visi Misi</a></li>
                        <li><a class="dropdown-item" href="<?= site_url('profil/struktur') ?>">Struktur Organisasi</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('berita') ?>">Berita</a></li>
                <li class="nav-item"><a class="nav-link active-link" href="<?= site_url('kegiatan') ?>">Kegiatan</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('events') ?>">Event</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('umkm-publik') ?>">UMKM</a></li>
                <li class="nav-item ms-1">
                    <button onclick="toggleDark()" id="btnDark"
                        style="width:38px;height:38px;border-radius:50%;border:1.5px solid #e8d5c4;background:white;cursor:pointer;transition:all 0.3s;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-moon-fill" id="iconDark" style="font-size:0.9rem;color:#5a3a3a;"></i>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- PAGE HEADER -->
<div class="page-header">
    <div class="container position-relative" style="z-index:1;">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Beranda</a></li>
                <li class="breadcrumb-item active">Kegiatan</li>
            </ol>
        </nav>
        <span class="sec-label" style="background:rgba(255,255,255,0.15);color:white;">Kegiatan Kami</span>
        <h1 style="font-family:'Fraunces',serif;font-weight:700;color:white;font-size:clamp(1.8rem,4vw,2.8rem);margin-top:10px;letter-spacing:-0.5px;">
            Dokumentasi &amp; Kegiatan Sosial
        </h1>
        <p style="color:rgba(255,255,255,0.7);max-width:500px;font-size:0.95rem;line-height:1.7;margin-top:10px;">
            Berbagai kegiatan sosial dan pemberdayaan masyarakat yang telah kami laksanakan.
        </p>
    </div>
</div>

<!-- KONTEN -->
<div class="container py-5" style="margin-top:10px;">

    <?php if(!empty($kegiatan)): ?>
    <div class="row g-4">
        <?php foreach($kegiatan as $i => $k): ?>
        <div class="col-md-4 col-sm-6 reveal d<?= ($i % 3) + 1 ?>">
            <a href="<?= site_url('kegiatan/detail/'.$k->id) ?>" class="card-kegiatan">
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
                    <p class="card-k-desc"><?= substr($k->deskripsi, 0, 100) ?>...</p>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>

    <?php else: ?>
    <div class="empty-state reveal">
        <i class="bi bi-calendar-x"></i>
        <p>Belum ada kegiatan yang tersedia.</p>
        <a href="<?= site_url('/') ?>" style="display:inline-flex;align-items:center;gap:8px;background:var(--merah);color:white;padding:10px 24px;border-radius:50px;text-decoration:none;font-weight:700;font-size:0.9rem;">
            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
        </a>
    </div>
    <?php endif; ?>

</div>

<!-- FOOTER -->
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
                    <li style="margin-bottom:10px;"><a href="tel:+62xxxxxxxxxx"><i class="bi bi-telephone me-2" style="color:var(--emas-terang);"></i>+62 xxx-xxxx-xxxx</a></li>
                    <li><a href="mailto:karangtaruna@email.com"><i class="bi bi-envelope me-2" style="color:var(--emas-terang);"></i>karangtaruna@email.com</a></li>
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
/* progress */
window.addEventListener('scroll', () => {
    const d = document.documentElement;
    document.getElementById('progress').style.width = (d.scrollTop / (d.scrollHeight - d.clientHeight) * 100) + '%';
}, { passive: true });

/* reveal */
const ro = new IntersectionObserver(es => es.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); }), { threshold:.12, rootMargin:'0px 0px -40px 0px' });
document.querySelectorAll('.reveal').forEach(el => ro.observe(el));

/* social hover */
document.querySelectorAll('.social-btn').forEach(b => {
    const c = b.dataset.color;
    b.onmouseenter = () => { b.style.background = c; };
    b.onmouseleave = () => { b.style.background = 'rgba(255,255,255,0.1)'; };
});

/* dark mode */
function toggleDark() {
    document.body.classList.toggle('dark');
    const on = document.body.classList.contains('dark');
    document.getElementById('iconDark').className = on ? 'bi bi-sun-fill' : 'bi bi-moon-fill';
    document.getElementById('iconDark').style.color = on ? '#f0c040' : '#5a3a3a';
    localStorage.setItem('dk', on ? '1' : '0');
}
if(localStorage.getItem('dk') === '1') {
    document.body.classList.add('dark');
    document.getElementById('iconDark').className = 'bi bi-sun-fill';
    document.getElementById('iconDark').style.color = '#f0c040';
}
</script>
</body>
</html>