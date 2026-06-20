<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Binaan — Karang Taruna Waru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
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

        .section-tag { display:inline-block;background:var(--merah-muda);color:var(--merah);font-weight:700;font-size:0.78rem;padding:5px 14px;border-radius:50px;letter-spacing:0.5px;text-transform:uppercase;margin-bottom:10px; }
        .section-title { font-size:2rem;font-weight:800;color:#1a0a0a;letter-spacing:-0.4px; }
        .divider { width:50px;height:4px;background:linear-gradient(90deg,var(--merah),var(--emas-terang));border-radius:2px;margin:12px 0 20px; }

        /* FILTER BAR */
        .filter-bar { background:white;border-radius:16px;padding:20px 24px;box-shadow:0 4px 20px rgba(0,0,0,0.06);margin-bottom:32px; }
        .search-input { border:1.5px solid #e8d5c4;border-radius:12px;padding:11px 16px;font-size:0.9rem;width:100%;outline:none;transition:border-color 0.2s; }
        .search-input:focus { border-color:var(--merah); }

        /* UMKM CARD */
        .umkm-card {
            background:white;border-radius:20px;overflow:hidden;
            box-shadow:0 4px 20px rgba(0,0,0,0.07);
            border:1px solid rgba(153,27,27,0.06);
            transition:all 0.35s cubic-bezier(.22,1,.36,1);
            height:100%;
        }
        .umkm-card:hover { transform:translateY(-8px);box-shadow:0 20px 50px rgba(153,27,27,0.12); }
        .umkm-img { width:100%;height:210px;object-fit:cover; }
        .umkm-placeholder { height:210px;background:linear-gradient(135deg,var(--krem-gelap),#e8d5c4);display:flex;align-items:center;justify-content:center; }
        .umkm-body { padding:20px; }
        .umkm-name { font-weight:800;font-size:1rem;color:#1a0a0a;margin-bottom:4px; }
        .umkm-harga { font-weight:800;font-size:1.05rem;color:var(--merah);margin-bottom:6px; }
        .umkm-desc { font-size:0.82rem;color:#7a5c5c;line-height:1.6;margin-bottom:10px; }
        .umkm-owner { font-size:0.78rem;color:#a08080;margin-bottom:14px;display:flex;align-items:center;gap:5px; }
        .badge-verified { background:var(--merah-muda);color:var(--merah);font-size:0.68rem;font-weight:700;padding:2px 8px;border-radius:50px; }

        .btn-beli { background:var(--merah);border:none;color:white;border-radius:10px;font-size:0.8rem;font-weight:700;padding:8px 14px;transition:all 0.2s; }
        .btn-beli:hover { background:var(--merah-tua);color:white;transform:translateY(-1px); }
        .btn-lokasi { background:var(--emas-muda);border:1px solid rgba(180,83,9,0.2);color:var(--emas);border-radius:10px;font-size:0.8rem;font-weight:700;padding:8px 12px;transition:all 0.2s; }
        .btn-lokasi:hover { background:var(--emas-terang);color:white; }

        /* EMPTY STATE */
        .empty-state { text-align:center;padding:80px 20px; }
        .empty-icon { width:80px;height:80px;background:var(--merah-muda);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2rem;color:var(--merah);margin:0 auto 20px; }

        /* MODAL PETA */
        #modalPeta { display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.65);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(4px); }

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
                <li class="breadcrumb-item active">UMKM Binaan</li>
            </ol>
        </nav>
        <h1>UMKM Binaan</h1>
        <p>Produk dan usaha lokal warga Desa Waru yang dibina oleh Karang Taruna untuk bersama tumbuh dan berkembang.</p>
        <div>
            <span class="hero-stat"><i class="bi bi-shop-window"></i> <?= count($umkm) ?> UMKM Terdaftar</span>
            <span class="hero-stat"><i class="bi bi-geo-alt-fill"></i> Desa Waru, Kab. Bogor</span>
        </div>
    </div>
</div>

<!-- KONTEN -->
<div style="padding:60px 0;">
    <div class="container">

        <!-- INFO BOX -->
        <div class="reveal" style="background:var(--emas-muda);border-left:4px solid var(--emas-terang);border-radius:14px;padding:18px 24px;margin-bottom:28px;">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-info-circle-fill" style="color:var(--emas-terang);font-size:1.3rem;flex-shrink:0;"></i>
                <p style="margin:0;color:#5a3a1a;font-size:0.93rem;line-height:1.7;">
                    <strong>Lapak Karang Taruna</strong> merupakan media promosi produk lokal Desa Waru yang bertujuan membantu warga memasarkan dan memperkenalkan produknya kepada masyarakat luas.
                </p>
            </div>
        </div>

        <!-- FILTER -->
        <div class="filter-bar reveal">
            <div class="row align-items-center g-3">
                <div class="col-md-5">
                    <div style="position:relative;">
                        <i class="bi bi-search" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#a08080;"></i>
                        <input type="text" id="searchUmkm" class="search-input" placeholder="Cari produk, pemilik..." onkeyup="filterUmkm()" style="padding-left:40px;">
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="totalHasil" style="font-size:0.85rem;color:#7a5c5c;font-weight:600;">
                        Menampilkan <strong><?= count($umkm) ?></strong> produk
                    </div>
                </div>
            </div>
        </div>

        <!-- GRID -->
        <div class="row g-4" id="umkmGrid">
            <?php if(!empty($umkm)): ?>
                <?php foreach($umkm as $i => $u): ?>
                <?php
                    $noWa = preg_replace('/[^0-9]/', '', $u->no_hp ?? '');
                    if(substr($noWa, 0, 1) == '0') $noWa = '62'.substr($noWa, 1);
                    $pesanWa = urlencode("Halo, saya tertarik dengan produk {$u->nama_umkm}. Boleh saya tahu lebih lanjut?");
                ?>
                <div class="col-md-4 col-sm-6 col-lg-3 umkm-item reveal delay-<?= ($i % 4) + 1 ?>">
                    <div class="umkm-card">
                        <?php if($u->foto): ?>
                            <img src="<?= base_url('uploads/'.$u->foto) ?>" class="umkm-img" alt="<?= $u->nama_umkm ?>">
                        <?php else: ?>
                            <div class="umkm-placeholder">
                                <i class="bi bi-shop" style="font-size:3rem;color:var(--merah);opacity:0.35;"></i>
                            </div>
                        <?php endif; ?>
                        <div class="umkm-body">
                            <div class="umkm-name"><?= $u->nama_umkm ?></div>
                            <?php if($u->harga): ?>
                            <div class="umkm-harga"><?= $u->harga ?></div>
                            <?php endif; ?>
                            <div class="umkm-desc"><?= strlen($u->deskripsi) > 70 ? substr($u->deskripsi, 0, 70).'...' : $u->deskripsi ?></div>
                            <div class="umkm-owner">
                                <i class="bi bi-person-circle"></i>
                                <strong><?= strtoupper($u->pemilik) ?></strong>
                                <span class="badge-verified">✓ Terverifikasi</span>
                            </div>
                            <div class="d-flex gap-2">
                                <?php if($u->no_hp): ?>
                                <a href="https://wa.me/<?= $noWa ?>?text=<?= $pesanWa ?>" target="_blank" class="btn btn-beli flex-fill">
                                    <i class="bi bi-whatsapp me-1"></i>Beli Sekarang
                                </a>
                                <?php endif; ?>
                                <?php if(!empty($u->lokasi)): ?>
                                <button onclick="lihatLokasi('<?= $u->lokasi ?>','<?= $u->nama_umkm ?>')" class="btn btn-lokasi">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state">
                        <div class="empty-icon"><i class="bi bi-shop"></i></div>
                        <h5 style="font-weight:700;color:#1a0a0a;">Belum Ada Produk</h5>
                        <p style="color:#7a5c5c;">UMKM binaan akan segera hadir di sini.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- NO RESULT -->
        <div id="noResult" style="display:none;" class="text-center py-5">
            <div class="empty-icon" style="margin:0 auto 16px;"><i class="bi bi-search"></i></div>
            <h6 style="font-weight:700;color:#1a0a0a;">Produk tidak ditemukan</h6>
            <p style="color:#7a5c5c;font-size:0.88rem;">Coba kata kunci yang berbeda.</p>
        </div>

    </div>
</div>

<!-- MODAL PETA -->
<div id="modalPeta" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.65);z-index:9999;align-items:center;justify-content:center;backdrop-filter:blur(4px);">
    <div style="background:white;border-radius:20px;width:90%;max-width:600px;overflow:hidden;box-shadow:0 24px 80px rgba(0,0,0,0.3);">
        <div style="padding:18px 22px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid #f0e8e8;">
            <h5 id="judulPeta" style="margin:0;font-weight:800;color:var(--merah-tua);"></h5>
            <button onclick="tutupPeta()" style="background:none;border:none;font-size:1.5rem;cursor:pointer;color:#999;line-height:1;">&times;</button>
        </div>
        <div id="mapContainer" style="height:380px;"></div>
        <div style="padding:14px 22px;border-top:1px solid #f0e8e8;">
            <a id="linkGmaps" href="#" target="_blank" class="btn w-100" style="background:var(--merah);color:white;border-radius:12px;font-weight:700;">
                <i class="bi bi-geo-alt-fill me-2"></i>Buka di Google Maps
            </a>
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
                <h5>Navigasi</h5>
                <ul class="list-unstyled mt-3" style="font-size:0.87rem;">
                    <li class="mb-2"><a href="<?= site_url('/') ?>">Beranda</a></li>
                    <li class="mb-2"><a href="<?= site_url('anggota-publik') ?>">Anggota</a></li>
                    <li class="mb-2"><a href="<?= site_url('berita') ?>">Kegiatan</a></li>
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
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
window.addEventListener('scroll', () => {
    const doc = document.documentElement;
    document.getElementById('readingProgress').style.width = (doc.scrollTop / (doc.scrollHeight - doc.clientHeight) * 100) + '%';
    document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 50);
});
const observer = new IntersectionObserver(e => e.forEach(x => { if(x.isIntersecting) x.target.classList.add('visible'); }), { threshold:0.1, rootMargin:'0px 0px -40px 0px' });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

function filterUmkm() {
    const q = document.getElementById('searchUmkm').value.toLowerCase();
    const items = document.querySelectorAll('.umkm-item');
    let visible = 0;
    items.forEach(item => {
        const show = item.innerText.toLowerCase().includes(q);
        item.style.display = show ? '' : 'none';
        if(show) visible++;
    });
    document.getElementById('totalHasil').innerHTML = 'Menampilkan <strong>' + visible + '</strong> produk';
    document.getElementById('noResult').style.display = visible === 0 ? 'block' : 'none';
}

var petaInstance = null;
function lihatLokasi(koordinat, nama) {
    var parts = koordinat.split(',');
    var lat = parseFloat(parts[0]), lng = parseFloat(parts[1]);
    document.getElementById('judulPeta').innerText = 'Lokasi ' + nama;
    document.getElementById('linkGmaps').href = 'https://www.google.com/maps?q=' + lat + ',' + lng;
    document.getElementById('modalPeta').style.display = 'flex';
    setTimeout(() => {
        if (petaInstance) { petaInstance.remove(); petaInstance = null; }
        petaInstance = L.map('mapContainer').setView([lat, lng], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution:'© OpenStreetMap' }).addTo(petaInstance);
        L.marker([lat, lng]).addTo(petaInstance).bindPopup('<b>' + nama + '</b>').openPopup();
    }, 100);
}
function tutupPeta() {
    document.getElementById('modalPeta').style.display = 'none';
    if (petaInstance) { petaInstance.remove(); petaInstance = null; }
}
</script>
</body>
</html>