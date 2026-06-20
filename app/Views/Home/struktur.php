<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi — Karang Taruna Waru</title>
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
        .reveal-scale { opacity:0;transform:scale(0.92);transition:opacity 0.6s ease,transform 0.6s ease; }
        .reveal-scale.visible { opacity:1;transform:scale(1); }
        .delay-1{transition-delay:0.1s !important}.delay-2{transition-delay:0.2s !important}
        .delay-3{transition-delay:0.3s !important}.delay-4{transition-delay:0.4s !important}

        .section-tag { display:inline-block;background:var(--merah-muda);color:var(--merah);font-weight:700;font-size:0.78rem;padding:5px 14px;border-radius:50px;letter-spacing:0.5px;text-transform:uppercase;margin-bottom:10px; }
        .section-title { font-size:2rem;font-weight:800;color:#1a0a0a;letter-spacing:-0.4px; }
        .divider { width:50px;height:4px;background:linear-gradient(90deg,var(--merah),var(--emas-terang));border-radius:2px;margin:12px 0 20px; }

        /* STRUKTUR IMAGE VIEWER */
        .struktur-wrapper {
            background:white;border-radius:24px;
            padding:32px;box-shadow:0 8px 40px rgba(0,0,0,0.08);
            border:1px solid rgba(153,27,27,0.08);
        }
        .struktur-wrapper img {
            width:100%;border-radius:14px;
            box-shadow:0 4px 20px rgba(0,0,0,0.08);
            transition:transform 0.3s;cursor:zoom-in;
        }
        .struktur-wrapper img:hover { transform:scale(1.01); }
        .struktur-caption {
            text-align:center;margin-top:20px;
            font-size:0.85rem;color:#7a5c5c;font-weight:600;
        }

        /* JABATAN CARDS */
        .jabatan-card {
            background:white;border-radius:18px;padding:24px;
            box-shadow:0 4px 20px rgba(0,0,0,0.06);
            border-left:4px solid var(--merah);
            display:flex;align-items:center;gap:16px;
            transition:all 0.3s;
        }
        .jabatan-card:hover { transform:translateX(6px);box-shadow:0 8px 30px rgba(153,27,27,0.1); }
        .jabatan-icon { width:48px;height:48px;background:var(--merah-muda);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:var(--merah);flex-shrink:0; }
        .jabatan-title { font-weight:700;font-size:0.9rem;color:#1a0a0a;margin-bottom:2px; }
        .jabatan-sub { font-size:0.78rem;color:#7a5c5c; }

        /* LIGHTBOX */
        #lightbox { display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.9);z-index:9998;align-items:center;justify-content:center;cursor:zoom-out; }
        #lightbox img { max-width:92%;max-height:92vh;border-radius:12px; }

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
                <li class="breadcrumb-item active">Struktur Organisasi</li>
            </ol>
        </nav>
        <h1>Struktur Organisasi</h1>
        <p>Susunan kepengurusan Karang Taruna Desa Waru yang menjalankan roda organisasi.</p>
    </div>
</div>

<!-- KONTEN -->
<div style="padding:70px 0;">
    <div class="container">

        <!-- STRUKTUR IMAGE -->
        <div class="text-center mb-5 reveal">
            <span class="section-tag">Kepengurusan</span>
            <h2 class="section-title mt-1">Bagan Struktur</h2>
            <div class="divider mx-auto"></div>
            <p style="color:#7a5c5c;max-width:500px;margin:0 auto;">Klik gambar untuk memperbesar. Struktur kepengurusan periode aktif.</p>
        </div>

        <div class="reveal-scale mb-5">
            <div class="struktur-wrapper">
                <img src="<?= base_url('uploads/anggota.jpg') ?>" alt="Struktur Organisasi"
                     onclick="document.getElementById('lightbox').style.display='flex'">
                <div class="struktur-caption">
                    <i class="bi bi-zoom-in me-1"></i>Klik gambar untuk memperbesar
                </div>
            </div>
        </div>

        <!-- JABATAN INFO -->
        <div class="text-center mb-4 reveal">
            <span class="section-tag">Peran</span>
            <h2 class="section-title mt-1">Jabatan Organisasi</h2>
            <div class="divider mx-auto"></div>
        </div>
        <div class="row g-3">
            <?php
            $jabatan = [
                ['icon'=>'bi-person-badge-fill','judul'=>'Ketua','desc'=>'Memimpin dan bertanggung jawab atas seluruh kegiatan organisasi.'],
                ['icon'=>'bi-person-lines-fill','judul'=>'Wakil Ketua','desc'=>'Membantu ketua dan menjalankan tugas saat ketua berhalangan.'],
                ['icon'=>'bi-journal-text','judul'=>'Sekretaris','desc'=>'Mengelola administrasi, surat-menyurat, dan dokumentasi organisasi.'],
                ['icon'=>'bi-cash-coin','judul'=>'Bendahara','desc'=>'Mengelola keuangan dan pelaporan keuangan organisasi.'],
                ['icon'=>'bi-people-fill','judul'=>'Bidang Sosial','desc'=>'Merancang dan melaksanakan program sosial kemasyarakatan.'],
                ['icon'=>'bi-shop-window','judul'=>'Bidang Ekonomi','desc'=>'Membina dan mengembangkan UMKM serta ekonomi kreatif lokal.'],
                ['icon'=>'bi-trophy-fill','judul'=>'Bidang Olahraga','desc'=>'Mengorganisir kegiatan olahraga dan kepemudaan desa.'],
                ['icon'=>'bi-camera-reels-fill','judul'=>'Bidang Humas','desc'=>'Mengelola komunikasi, media sosial, dan hubungan masyarakat.'],
            ];
            foreach($jabatan as $i => $j): ?>
            <div class="col-md-6 col-lg-3 reveal delay-<?= ($i % 4) + 1 ?>">
                <div class="jabatan-card">
                    <div class="jabatan-icon"><i class="bi <?= $j['icon'] ?>"></i></div>
                    <div>
                        <div class="jabatan-title"><?= $j['judul'] ?></div>
                        <div class="jabatan-sub"><?= $j['desc'] ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<!-- LIGHTBOX -->
<div id="lightbox" onclick="this.style.display='none'" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.92);z-index:9998;align-items:center;justify-content:center;cursor:zoom-out;">
    <img src="<?= base_url('uploads/anggota.jpg') ?>" style="max-width:92%;max-height:92vh;border-radius:12px;">
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
document.querySelectorAll('.reveal,.reveal-scale').forEach(el => observer.observe(el));
</script>
</body>
</html>