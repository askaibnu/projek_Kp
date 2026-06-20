<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event - <?= $event->judul ?? 'Lomba Agustusan' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --red:    #D72638;
            --white:  #FFFFFF;
            --cream:  #FFF8F0;
            --navy:   #0D1B2A;
            --gold:   #F5A623;
            --gray:   #6B7280;
            --light:  #F3F4F6;
            --radius: 20px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--cream);
            color: var(--navy);
            min-height: 100vh;
        }

        /* ── HEADER / HERO ── */
        .hero {
            position: relative;
            background: #fff;
        }

        .hero-img {
            width: 100%;
            height: auto;
            display: block;
        }

        .hero-overlay { display: none; }

        .hero-back {
            position: absolute;
            top: 16px;
            left: 16px;
            background: rgba(255,255,255,.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,.25);
            color: #fff;
            border-radius: 50px;
            padding: 8px 18px;
            font-size: .85rem;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background .2s;
        }
        .hero-back:hover { background: rgba(255,255,255,.3); color: #fff; }

        .badge-free {
            position: absolute;
            top: 16px;
            right: 16px;
            background: var(--red);
            color: #fff;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: .8rem;
            letter-spacing: .08em;
            padding: 6px 16px;
            border-radius: 50px;
            text-transform: uppercase;
        }

        /* ── CARD CONTENT ── */
        .card-main {
            background: var(--white);
            position: relative;
            z-index: 2;
            padding: 28px 24px 0;
        }

        .event-title {
            font-family: 'Sora', sans-serif;
            font-size: 1.55rem;
            font-weight: 800;
            line-height: 1.25;
            text-transform: capitalize;
            margin-bottom: 6px;
        }

        .event-id {
            font-size: .75rem;
            color: var(--gray);
            letter-spacing: .05em;
            margin-bottom: 20px;
        }

        /* ── META PILLS ── */
        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 24px;
        }

        .meta-pill {
            display: flex;
            align-items: center;
            gap: 7px;
            background: var(--light);
            border-radius: 50px;
            padding: 8px 16px;
            font-size: .85rem;
            font-weight: 600;
            color: var(--navy);
        }
        .meta-pill i { color: var(--red); font-size: 1rem; }
        .meta-pill.gold-pill { background: #FFF3DC; }
        .meta-pill.gold-pill i { color: var(--gold); }

        /* ── DIVIDER ── */
        .section-label {
            font-family: 'Sora', sans-serif;
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 10px;
        }

        /* ── DESCRIPTION ── */
        .desc-box {
            background: var(--light);
            border-radius: 14px;
            padding: 18px;
            font-size: .92rem;
            line-height: 1.7;
            color: #374151;
            margin-bottom: 24px;
        }

        /* ── MAP PLACEHOLDER ── */
        .map-box {
            border-radius: 14px;
            overflow: hidden;
            height: 200px;
            background: #e5e7eb;
            margin-bottom: 24px;
            position: relative;
        }
        .map-box iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        .map-coords {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background: rgba(255,255,255,.9);
            border-radius: 8px;
            padding: 4px 10px;
            font-size: .75rem;
            font-weight: 600;
            color: var(--navy);
        }

        /* ── ORGANIZER ── */
        .organizer-box {
            display: flex;
            align-items: center;
            gap: 14px;
            background: var(--light);
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 28px;
        }
        .org-avatar {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: var(--red);
            color: #fff;
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .org-name { font-weight: 700; font-size: .95rem; }
        .org-role { font-size: .8rem; color: var(--gray); }

        /* ── STICKY BOTTOM CTA ── */
        .cta-bar {
            position: sticky;
            bottom: 0;
            background: var(--white);
            border-top: 1px solid #e5e7eb;
            padding: 16px 24px;
            z-index: 100;
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-daftar {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #25D366;
            color: #fff;
            border: none;
            border-radius: 14px;
            padding: 15px;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            letter-spacing: .03em;
            text-decoration: none;
            transition: background .2s, transform .1s;
            width: 100%;
        }
        .btn-daftar:hover { background: #1ebe5d; color: #fff; }
        .btn-daftar:active { transform: scale(.98); }

        .btn-daftar {
            flex: 1;
            background: var(--red);
            color: #fff;
            border: none;
            border-radius: 14px;
            padding: 14px;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            letter-spacing: .03em;
            transition: background .2s, transform .1s;
        }
        .btn-daftar:hover { background: #b51e2e; }
        .btn-daftar:active { transform: scale(.98); }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .card-main { animation: fadeUp .45s ease both; }
        .fade-1 { animation: fadeUp .45s .1s ease both; }
        .fade-2 { animation: fadeUp .45s .2s ease both; }
        .fade-3 { animation: fadeUp .45s .3s ease both; }

        /* ── RESPONSIVE ── */
        @media (min-width: 600px) {
            body { max-width: 480px; margin: 0 auto; box-shadow: 0 0 40px rgba(0,0,0,.08); }
        }
    </style>
</head>
<body>

<!-- ══ HERO ══ -->
<div class="hero">
    <?php if (!empty($event->foto)): ?>
        <img src="<?= base_url('uploads/' . $event->foto) ?>" alt="<?= htmlspecialchars($event->judul) ?>" class="hero-img">
    <?php else: ?>
        <!-- Fallback gradient banner -->
        <div style="height:320px;background:linear-gradient(135deg,#0D1B2A 0%,#1a3a5c 100%);display:flex;align-items:center;justify-content:center;">
            <i class="bi bi-calendar-event" style="font-size:5rem;color:rgba(255,255,255,.15);"></i>
        </div>
    <?php endif; ?>

    <div class="hero-overlay"></div>

    <a href="<?= site_url('events') ?>" class="hero-back">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <?php
        $harga = $event->harga ?? 0;
        $labelHarga = ($harga == 0) ? 'GRATIS' : 'Rp ' . number_format($harga, 0, ',', '.');
    ?>
    <span class="badge-free"><?= $labelHarga ?></span>
</div>

<!-- ══ MAIN CARD ══ -->
<div class="card-main">

    <!-- Title -->
    <h1 class="event-title"><?= htmlspecialchars($event->judul ?? 'Lomba Agustusan') ?></h1>
    <p class="event-id fade-1">ID: <?= htmlspecialchars($event->kode ?? 'ygweIIIIIIIFF') ?></p>

    <!-- Meta Pills -->
    <div class="meta-row fade-1">
        <div class="meta-pill">
            <i class="bi bi-calendar3"></i>
            <?= date('d M Y', strtotime($event->tanggal ?? '2026-04-30')) ?>
        </div>
        <?php if (!empty($event->waktu_mulai)): ?>
        <div class="meta-pill">
            <i class="bi bi-clock"></i>
            <?= date('H:i', strtotime($event->waktu_mulai)) ?>
            <?php if (!empty($event->waktu_selesai)): ?> – <?= date('H:i', strtotime($event->waktu_selesai)) ?><?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="meta-pill gold-pill">
            <i class="bi bi-tag-fill"></i>
            <?= $labelHarga ?>
        </div>
    </div>

    <!-- Description -->
    <p class="section-label fade-2">Deskripsi</p>
    <div class="desc-box fade-2">
        <?php if (!empty($event->deskripsi)): ?>
            <?= nl2br(htmlspecialchars($event->deskripsi)) ?>
        <?php else: ?>
            Ikuti semarak Lomba Agustusan! Berbagai lomba tersedia untuk jenjang SD/MI, SMP/MTS, SMA/MA,
            hingga kategori Umum. Daftarkan diri sekarang melalui QR Code yang tersedia.<br><br>
            <strong>Hadiah total Rp 33 Juta</strong> menanti para pemenang. Pendaftaran dilakukan melalui
            scan QR Code di bawah flyer atau hubungi panitia.
        <?php endif; ?>
    </div>

    <!-- Location -->
    <p class="section-label fade-3">Lokasi</p>
    <div class="meta-pill mb-3 fade-3" style="border-radius:14px;padding:14px 16px;background:var(--light);">
        <i class="bi bi-geo-alt-fill" style="font-size:1.2rem;"></i>
        <div>
            <div style="font-weight:700;font-size:.9rem;"><?= htmlspecialchars($event->lokasi ?? 'Lihat koordinat') ?></div>
            <div style="font-size:.75rem;color:var(--gray);margin-top:2px;">
                <?= htmlspecialchars($event->koordinat ?? '-6.422465, 106.7195695') ?>
            </div>
        </div>
    </div>

    <!-- Embedded Map -->
    <?php
        $lat = $event->lat ?? '-6.422465';
        $lng = $event->lng ?? '106.7195695';
        $mapSrc = "https://maps.google.com/maps?q={$lat},{$lng}&z=16&output=embed";
    ?>
    <div class="map-box fade-3">
        <iframe src="<?= $mapSrc ?>" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <span class="map-coords"><?= $lat ?>, <?= $lng ?></span>
    </div>

    <!-- Organizer -->
    <p class="section-label fade-3">Penyelenggara</p>
    <div class="organizer-box fade-3">
        <div class="org-avatar">P</div>
        <div>
            <div class="org-name"><?= htmlspecialchars($event->penyelenggara ?? 'Panitia Lomba') ?></div>
            <div class="org-role">Event Organizer</div>
        </div>
        <a href="#" class="ms-auto btn btn-sm" style="background:#FFE8EB;color:var(--red);font-weight:600;border-radius:10px;font-size:.8rem;">
            <i class="bi bi-chat-dots-fill"></i> Hubungi
        </a>
    </div>

    <!-- spacer for sticky bar -->
    <div style="height:90px;"></div>
</div>

<!-- ══ STICKY CTA ══ -->
<div class="cta-bar">
    <a class="btn-daftar"
       href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $event->wa_admin ?? '6281234567890') ?>?text=<?= urlencode('Halo Admin, saya mau daftar event: ' . ($event->judul ?? 'Event') . '. Nama saya: ') ?>"
       target="_blank">
        <i class="bi bi-whatsapp me-2"></i>Daftar &amp; Hubungi via WhatsApp
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function daftarEvent() {
        Swal.fire({
            title: 'Daftar Event',
            html: `
                <input type="text"  id="nama"  class="swal2-input"  placeholder="Nama Lengkap">
                <input type="tel"   id="wa"    class="swal2-input"  placeholder="No. WhatsApp">
                <input type="email" id="email" class="swal2-input"  placeholder="Email (opsional)">
            `,
            confirmButtonText: 'Daftar',
            confirmButtonColor: '#D72638',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            preConfirm: () => {
                const nama = document.getElementById('nama').value.trim();
                const wa   = document.getElementById('wa').value.trim();
                if (!nama || !wa) {
                    Swal.showValidationMessage('Nama dan No. WA wajib diisi!');
                    return false;
                }
                return { nama, wa, email: document.getElementById('email').value };
            }
        }).then(r => {
            if (r.isConfirmed) {
                const fd = new FormData();
                fd.append('nama',     r.value.nama);
                fd.append('wa',       r.value.wa);
                fd.append('email',    r.value.email);
                fd.append('event_id', '<?= $event->id ?? 1 ?>');
                fd.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

                fetch("<?= site_url('events/daftar') ?>", { method: 'POST', body: fd })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'ok') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Pendaftaran Berhasil! 🎉',
                                text: 'Kamu sudah terdaftar. Informasi lebih lanjut akan dikirim ke WhatsApp kamu.',
                                confirmButtonColor: '#D72638'
                            });
                        } else {
                            Swal.fire('Gagal', data.message ?? 'Terjadi kesalahan.', 'error');
                        }
                    })
                    .catch(() => Swal.fire('Error', 'Server tidak merespon!', 'error'));
            }
        });
    }
</script>
</body>
</html>