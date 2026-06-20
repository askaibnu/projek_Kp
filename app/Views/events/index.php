<!DOCTYPE html>
<html>
<head>
    <title>Data Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container mt-4">
    <h2>Data Event</h2>
    <button onclick="tambah()" class="btn btn-primary mb-3">+ Tambah Event</button>

    <table class="table table-bordered">
        <tr>
            <th>No</th><th>Foto</th><th>Judul</th><th>Tanggal</th><th>Lokasi</th><th>No WA Admin</th><th>Aksi</th>
        </tr>
        <?php $no=1; foreach($events as $e): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?php if($e->foto): ?><img src="<?= base_url('uploads/'.$e->foto) ?>" width="70"><?php else: ?>-<?php endif; ?></td>
            <td><?= $e->judul ?></td>
            <td><?= date('d M Y', strtotime($e->tanggal)) ?></td>
            <td><?= $e->lokasi ?></td>
            <td><?= $e->wa_admin ?? '-' ?></td>
            <td>
                <button
                    class="btn btn-warning btn-sm"
                    data-id="<?= $e->id ?>"
                    data-judul="<?= htmlspecialchars($e->judul, ENT_QUOTES) ?>"
                    data-deskripsi="<?= htmlspecialchars(str_replace(["\r\n","\r","\n"],' ',$e->deskripsi), ENT_QUOTES) ?>"
                    data-tanggal="<?= $e->tanggal ?>"
                    data-lokasi="<?= htmlspecialchars($e->lokasi, ENT_QUOTES) ?>"
                    data-wa="<?= htmlspecialchars($e->wa_admin ?? '', ENT_QUOTES) ?>"
                    onclick="editData(this)">Edit</button>
                <button onclick="hapus(<?= $e->id ?>)" class="btn btn-danger btn-sm">Hapus</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">Kembali</a>
</div>

<script>
const csrfName = '<?= csrf_token() ?>';
const csrfHash = '<?= csrf_hash() ?>';

function tambah() {
    Swal.fire({
        title: 'Tambah Event',
        html: `
            <input type="text" id="judul" class="swal2-input" placeholder="Judul Event">
            <input type="date" id="tanggal" class="swal2-input">
            <input type="text" id="lokasi" class="swal2-input" placeholder="Lokasi">
            <textarea id="deskripsi" class="swal2-textarea" placeholder="Deskripsi event..."></textarea>
            <input type="text" id="wa_admin" class="swal2-input" placeholder="No WA Admin (contoh: 6281234567890)">
            <p style="margin:8px 16px 0;text-align:left;font-size:0.85rem;color:#666;">Foto Event:</p>
            <input type="file" id="foto" class="swal2-file">
        `,
        confirmButtonText: 'Simpan',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        preConfirm: () => {
            let judul = document.getElementById('judul').value;
            let tanggal = document.getElementById('tanggal').value;
            if (!judul || !tanggal) {
                Swal.showValidationMessage('Judul dan Tanggal wajib diisi!');
                return false;
            }
            return {
                judul, tanggal,
                lokasi: document.getElementById('lokasi').value,
                deskripsi: document.getElementById('deskripsi').value,
                wa_admin: document.getElementById('wa_admin').value,
                foto: document.getElementById('foto').files[0]
            }
        }
    }).then(r => {
        if (r.isConfirmed) {
            let fd = new FormData();
            fd.append('judul', r.value.judul);
            fd.append('tanggal', r.value.tanggal);
            fd.append('lokasi', r.value.lokasi);
            fd.append('deskripsi', r.value.deskripsi);
            fd.append('wa_admin', r.value.wa_admin);
            if (r.value.foto) fd.append('foto', r.value.foto);
            fd.append(csrfName, csrfHash);
            fetch("<?= site_url('admin/events/simpan') ?>", { method: 'POST', body: fd })
            .then(res => res.json())
            .then(data => {
                if (data.status == 'ok') {
                    Swal.fire('Berhasil!', 'Event tersimpan', 'success').then(() => location.reload());
                } else {
                    Swal.fire('Error', 'Gagal simpan: ' + (data.message ?? ''), 'error');
                }
            }).catch(() => Swal.fire('Error', 'Server tidak merespon!', 'error'));
        }
    });
}

function editData(btn) {
    let id        = btn.dataset.id;
    let judul     = btn.dataset.judul;
    let deskripsi = btn.dataset.deskripsi;
    let tanggal   = btn.dataset.tanggal;
    let lokasi    = btn.dataset.lokasi;
    let wa        = btn.dataset.wa;

    Swal.fire({
        title: 'Edit Event',
        html: `
            <input type="text" id="judul" class="swal2-input" value="${judul}" placeholder="Judul Event">
            <input type="date" id="tanggal" class="swal2-input" value="${tanggal}">
            <input type="text" id="lokasi" class="swal2-input" value="${lokasi}" placeholder="Lokasi">
            <textarea id="deskripsi" class="swal2-textarea">${deskripsi}</textarea>
            <input type="text" id="wa_admin" class="swal2-input" value="${wa}" placeholder="No WA Admin (contoh: 6281234567890)">
            <p style="margin:8px 16px 0;text-align:left;font-size:0.85rem;color:#666;">Ganti Foto (kosongkan jika tidak diganti):</p>
            <input type="file" id="foto" class="swal2-file">
        `,
        confirmButtonText: 'Update',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        preConfirm: () => {
            let judul = document.getElementById('judul').value;
            let tanggal = document.getElementById('tanggal').value;
            if (!judul || !tanggal) {
                Swal.showValidationMessage('Judul dan Tanggal wajib diisi!');
                return false;
            }
            return {
                judul, tanggal,
                lokasi: document.getElementById('lokasi').value,
                deskripsi: document.getElementById('deskripsi').value,
                wa_admin: document.getElementById('wa_admin').value,
                foto: document.getElementById('foto').files[0]
            }
        }
    }).then(r => {
        if (r.isConfirmed) {
            let fd = new FormData();
            fd.append('id', id);
            fd.append('judul', r.value.judul);
            fd.append('tanggal', r.value.tanggal);
            fd.append('lokasi', r.value.lokasi);
            fd.append('deskripsi', r.value.deskripsi);
            fd.append('wa_admin', r.value.wa_admin);
            if (r.value.foto) fd.append('foto', r.value.foto);
            fd.append(csrfName, csrfHash);
            fetch("<?= site_url('admin/events/update') ?>", { method: 'POST', body: fd })
            .then(res => res.json())
            .then(data => {
                if (data.status == 'ok') {
                    Swal.fire('Berhasil!', 'Event diupdate', 'success').then(() => location.reload());
                } else {
                    Swal.fire('Error', 'Gagal update', 'error');
                }
            }).catch(() => Swal.fire('Error', 'Server tidak merespon!', 'error'));
        }
    });
}

function hapus(id) {
    Swal.fire({
        title: 'Yakin?',
        text: 'Event akan dihapus!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
    }).then(r => {
        if (r.isConfirmed) window.location = "<?= site_url('admin/events/hapus/') ?>" + id;
    });
}
</script>
</body>
</html>