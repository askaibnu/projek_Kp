<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event - Karang Taruna Waru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --merah:#991b1b;--merah-tua:#7f1d1d;--merah-muda:#fee2e2;
            --emas:#b45309;--emas-muda:#fef3c7;--emas-terang:#d97706;
            --krem:#fdf8f0;--krem-gelap:#f5ebe0;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--krem); }
        .navbar { background: rgba(255,255,255,0.97); backdrop-filter: blur(12px); box-shadow: 0 2px 20px rgba(0,0,0,0.06); }
        .navbar-brand { font-weight: 800; color: var(--merah-tua) !important; }
        .nav-link { color: #3a2a2a !important; font-weight: 600; font-size: 0.9rem; }
        .nav-link:hover { color: var(--merah) !important; }
        .dropdown-menu { border: 1px solid rgba(153,27,27,0.1); box-shadow: 0 8px 30px rgba(0,0,0,0.09); border-radius: 12px; }
        .dropdown-item:hover { background: var(--merah-muda); color: var(--merah); }

        .page-hero {
            background: linear-gradient(135deg, var(--merah-tua) 0%, #991b1b 50%, #b45309 100%);
            color: white; padding: 80px 0 60px;
            position: relative; overflow: hidden;
        }
        .page-hero::before {
            content: ''; position: absolute;
            top: -50%; right: -10%;
            width: 500px; height: 500px;
            background: rgba(255,255,255,0.05); border-radius: 50%;
        }
        .page-hero h1 { font-size: 2.8rem; font-weight: 800; }

        .card-event {
            border: none; border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.07);
            transition: all 0.35s cubic-bezier(.22,1,.36,1);
            overflow: hidden; cursor: pointer;
            height: 100%; background: white;
            border-bottom: 3px solid transparent;
        }
        .card-event:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(153,27,27,0.12);
            border-bottom-color: var(--merah);
        }
        .card-event img { height: 200px; object-fit: cover; width: 100%; }
        .badge-tanggal {
            background: var(--emas-muda); color: var(--emas);
            padding: 4px 12px; border-radius: 6px;
            font-size: 0.72rem; font-weight: 700;
        }
        .badge-gratis {
            background: var(--merah); color: white;
            padding: 4px 12px; border-radius: 6px;
            font-size: 0.75rem; font-weight: 700;
        }

        /* FOOTER */
        footer { background: linear-gradient(135deg, #1c0808, #2d0f0f); color: white; padding: 60px 0 24px; }
        footer h6 { color: var(--emas-terang); font-size: 0.72rem; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; margin-bottom: 16px; }
        footer a { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.875rem; transition: color 0.2s; }
        footer a:hover { color: white; }
        footer li { margin-bottom: 10px; }
        .footer-divider { border-top: 1px solid rgba(255,255,255,0.08); padding-top: 20px; margin-top: 40px; }
        .social-btn { width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; font-size: 0.95rem; transition: all 0.3s; }
        .social-btn:hover { transform: translateY(-3px) scale(1.1); color: white; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg sticky-top">
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
                <li class="nav-item"><a class="nav-link" href="<?= site_url('berita') ?>">Berita</a></li>
                <li class="nav-item"><a class="nav-link active" href="<?= site_url('events') ?>" style="color:var(--merah) !important;">Event</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('umkm-publik') ?>">UMKM</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- PAGE HERO -->
<div class="page-hero">
    <div class="container position-relative" style="z-index:1">
        <span style="background:rgba(255,255,255,0.15);padding:5px 14px;border-radius:50px;font-size:0.82rem;font-weight:600;">
            <i class="bi bi-calendar-event me-1"></i> Karang Taruna Desa Waru
        </span>
        <h1 class="mt-3 mb-3">Event & Kegiatan</h1>
        <p style="opacity:0.85;">Temukan event terbaru yang sedang berlangsung di Karang Taruna Desa Waru</p>
        <span style="background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.2);padding:8px 18px;border-radius:50px;font-size:0.85rem;font-weight:600;">
            <i class="bi bi-calendar-check me-1"></i> <?= count($events) ?> Event
        </span>
    </div>
</div>

<!-- KONTEN -->
<div class="container py-5">

    <!-- SEARCH -->
    <div class="row mb-4">
        <div class="col-md-5">
            <div style="position:relative;">
                <i class="bi bi-search" style="position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#a08080;"></i>
                <input type="text" id="searchEvent" class="form-control"
                       placeholder="Cari event..."
                       onkeyup="filterEvent()"
                       style="border-radius:12px;padding:12px 20px 12px 44px;border:1.5px solid #e8d5c4;background:var(--krem);font-family:'Plus Jakarta Sans',sans-serif;">
            </div>
        </div>
    </div>

    <?php if(!empty($events)): ?>
    <div class="row g-4" id="eventGrid">
        <?php foreach($events as $e): ?>
        <div class="col-md-4 col-sm-6 event-item">
            <div class="card-event" onclick="window.location='<?= site_url('events/detail/'.$e->id) ?>'">
                <?php if($e->foto): ?>
                    <img src="<?= base_url('uploads/'.$e->foto) ?>">
                <?php else: ?>
                    <div style="height:200px;background:linear-gradient(135deg,var(--merah-tua),#991b1b);display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-calendar-event" style="font-size:3rem;color:rgba(255,255,255,0.3);"></i>
                    </div>
                <?php endif; ?>
                <div class="p-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge-tanggal">
                            <i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime($e->tanggal)) ?>
                        </span>
                        <span class="badge-gratis">GRATIS</span>
                    </div>
                    <h5 style="font-weight:700;color:#1a0a0a;margin-bottom:8px;font-size:1rem;">
                        <?= $e->judul ?>
                    </h5>
                    <?php if($e->lokasi): ?>
                    <p style="font-size:0.83rem;color:#a08080;margin-bottom:8px;">
                        <i class="bi bi-geo-alt-fill me-1" style="color:var(--merah);"></i><?= $e->lokasi ?>
                    </p>
                    <?php endif; ?>
                    <p style="font-size:0.83rem;color:#7a5c5c;line-height:1.6;margin-bottom:16px;">
                        <?= strlen($e->deskripsi) > 80 ? substr($e->deskripsi, 0, 80).'...' : $e->deskripsi ?>
                    </p>
                    <span style="color:var(--merah);font-weight:700;font-size:0.85rem;">
                        Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                    </span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="text-center py-5">
        <i class="bi bi-calendar-x" style="font-size:4rem;color:#ccc;"></i>
        <h5 style="color:#aaa;margin-top:16px;font-weight:700;">Belum ada event</h5>
        <p style="color:#bbb;">Event akan segera ditambahkan</p>
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
                    <a href="#" class="social-btn" data-color="#1877f2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-btn" data-color="#bc1888"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-btn" data-color="#25d366"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="social-btn" data-color="#ff0000"><i class="bi bi-youtube"></i></a>
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
                    <li><a href="<?= site_url('berita') ?>"></a></li>
                    <li><a href="<?= site_url('events') ?>">Event</a></li>
                    <li><a href="<?= site_url('kegiatan') ?>">Kegiatan</a></li>
                    <li><a href="<?= site_url('umkm-publik') ?>">UMKM</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6>Kontak</h6>
                <ul class="list-unstyled" style="font-size:0.85rem;">
                    <li style="color:rgba(255,255,255,0.6);margin-bottom:10px;"><i class="bi bi-geo-alt me-2" style="color:var(--emas-terang);"></i>Desa Waru, Kab. Bogor</li>
                    <li><a href="tel:+62xxxxxxxxxx"><i class="bi bi-telephone me-2" style="color:var(--emas-terang);"></i>+6289531435314</a></li>
                    <li style="margin-top:10px;"><a href="mailto:karangtaruna@email.com"><i class="bi bi-envelope me-2" style="color:var(--emas-terang);"></i>karangtaruna.desawaru@gmail.com</a></li>
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
function filterEvent() {
    const input = document.getElementById('searchEvent').value.toLowerCase();
    document.querySelectorAll('.event-item').forEach(item => {
        item.style.display = item.innerText.toLowerCase().includes(input) ? '' : 'none';
    });
}

document.querySelectorAll('.social-btn').forEach(b => {
    const c = b.dataset.color;
    b.onmouseenter = () => { b.style.background = c; };
    b.onmouseleave = () => { b.style.background = 'rgba(255,255,255,0.1)'; };
});
</script>
</body>
</html>