<!DOCTYPE html>
<html>
<head>
    <title>Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container mt-4">
    <h2>Data Kegiatan</h2>
    <button onclick="tambah()" class="btn btn-primary mb-3">+ Tambah</button>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        <?php $no=1; foreach($kegiatan as $k): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td>
                <?php if($k->foto): ?>
                <img src="<?= base_url('uploads/'.$k->foto) ?>" width="60">
                <?php endif; ?>
            </td>
            <td><?= $k->nama ?></td>
            <td><?= $k->tanggal ?></td>
            <td><?= strlen($k->deskripsi) > 50 ? substr($k->deskripsi, 0, 50).'...' : $k->deskripsi ?></td>
            <td>
                <button 
                    class="btn btn-warning btn-sm"
                    data-id="<?= $k->id ?>"
                    data-nama="<?= htmlspecialchars($k->nama, ENT_QUOTES) ?>"
                    data-deskripsi="<?= htmlspecialchars(str_replace(["\r\n", "\r", "\n"], ' ', $k->deskripsi), ENT_QUOTES) ?>"
                    data-tanggal="<?= $k->tanggal ?>"
                    data-fotos="<?= htmlspecialchars(json_encode(
                        array_map(fn($f) => ['id'=>$f->id,'foto'=>$f->foto], $k->foto_tambahan)
                    ), ENT_QUOTES) ?>"
                    onclick="editData(this)">Edit</button>
                <button onclick="hapus(<?= $k->id ?>)" class="btn btn-danger btn-sm">Hapus</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">Kembali</a>
</div>

<script>
function tambah(){
    Swal.fire({
        title: 'Tambah Kegiatan',
        html: `
            <input id="nama" class="swal2-input" placeholder="Nama Kegiatan">
            <input type="date" id="tanggal" class="swal2-input">
            <textarea id="deskripsi" class="swal2-textarea" placeholder="Tulis deskripsi kegiatan..." style="height:150px;"></textarea>
            <p style="margin:8px 16px 0;text-align:left;font-size:0.85rem;color:#666;">Foto Utama:</p>
            <input type="file" id="foto" class="swal2-file" style="margin-bottom:4px;">
            <p style="margin:8px 16px 0;text-align:left;font-size:0.85rem;color:#666;">Foto Tambahan (bisa pilih banyak):</p>
            <input type="file" id="foto_tambahan" class="swal2-file" multiple>
        `,
        confirmButtonText: 'Simpan',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        preConfirm: () => {
            let nama = document.getElementById('nama').value;
            let tanggal = document.getElementById('tanggal').value;
            if (!nama || !tanggal) {
                Swal.showValidationMessage('Nama dan Tanggal wajib diisi!');
                return false;
            }
            return {
                nama: nama,
                deskripsi: document.getElementById('deskripsi').value,
                tanggal: tanggal,
                foto: document.getElementById('foto').files[0],
                foto_tambahan: document.getElementById('foto_tambahan').files
            }
        }
    }).then(r => {
        if (r.isConfirmed) {
            let fd = new FormData();
            fd.append('nama', r.value.nama);
            fd.append('deskripsi', r.value.deskripsi);
            fd.append('tanggal', r.value.tanggal);
            if (r.value.foto) fd.append('foto', r.value.foto);

            if (r.value.foto_tambahan) {
                for (let i = 0; i < r.value.foto_tambahan.length; i++) {
                    fd.append('foto_tambahan[]', r.value.foto_tambahan[i]);
                }
            }

            fd.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

            fetch("<?= site_url('kegiatan/simpan') ?>", { method: 'POST', body: fd })
            .then(res => res.json())
            .then(data => {
                if (data.status == 'ok') {
                    Swal.fire('Berhasil!', 'Data kegiatan tersimpan', 'success').then(() => location.reload());
                } else {
                    Swal.fire('Error', 'Gagal simpan data', 'error');
                }
            }).catch(() => Swal.fire('Error', 'Server tidak merespon!', 'error'));
        }
    });
}

function editData(btn) {
    let id        = btn.dataset.id;
    let nama      = btn.dataset.nama;
    let deskripsi = btn.dataset.deskripsi;
    let tanggal   = btn.dataset.tanggal;
    let fotos     = JSON.parse(btn.dataset.fotos || '[]');

    let fotosHtml = '';
    if (fotos.length > 0) {
        fotosHtml += `<p style="margin:8px 16px 0;text-align:left;font-size:0.85rem;color:#666;">Foto Tambahan Saat Ini (centang untuk hapus):</p>`;
        fotosHtml += `<div style="display:flex;flex-wrap:wrap;gap:8px;padding:8px 16px;">`;
        fotos.forEach(f => {
            fotosHtml += `
                <div style="text-align:center;">
                    <img src="<?= base_url('uploads/') ?>${f.foto}" 
                         style="width:70px;height:70px;object-fit:cover;border-radius:6px;border:1px solid #ddd;">
                    <br>
                    <label style="font-size:0.75rem;color:red;">
                        <input type="checkbox" class="hapus-foto" value="${f.id}"> Hapus
                    </label>
                </div>`;
        });
        fotosHtml += `</div>`;
    }

    Swal.fire({
        title: 'Edit Kegiatan',
        html: `
            <input id="nama" class="swal2-input" value="${nama}" placeholder="Nama Kegiatan">
            <input type="date" id="tanggal" class="swal2-input" value="${tanggal}">
            <textarea id="deskripsi" class="swal2-textarea" style="height:150px;">${deskripsi}</textarea>
            <p style="margin:8px 16px 0;text-align:left;font-size:0.85rem;color:#666;">Ganti Foto Utama (kosongkan jika tidak diganti):</p>
            <input type="file" id="foto" class="swal2-file">
            ${fotosHtml}
            <p style="margin:8px 16px 0;text-align:left;font-size:0.85rem;color:#666;">Tambah Foto Baru (bisa pilih banyak):</p>
            <input type="file" id="foto_tambahan" class="swal2-file" multiple>
        `,
        confirmButtonText: 'Update',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        preConfirm: () => {
            let nama = document.getElementById('nama').value;
            let tanggal = document.getElementById('tanggal').value;
            if (!nama || !tanggal) {
                Swal.showValidationMessage('Nama dan Tanggal wajib diisi!');
                return false;
            }

            let hapusFoto = [];
            document.querySelectorAll('.hapus-foto:checked').forEach(cb => {
                hapusFoto.push(cb.value);
            });

            return {
                nama,
                deskripsi: document.getElementById('deskripsi').value,
                tanggal,
                foto: document.getElementById('foto').files[0],
                foto_tambahan: document.getElementById('foto_tambahan').files,
                hapusFoto
            };
        }
    }).then(r => {
        if (r.isConfirmed) {
            let fd = new FormData();
            fd.append('id', id);
            fd.append('nama', r.value.nama);
            fd.append('deskripsi', r.value.deskripsi);
            fd.append('tanggal', r.value.tanggal);
            if (r.value.foto) fd.append('foto', r.value.foto);

            r.value.hapusFoto.forEach(fid => fd.append('hapus_foto[]', fid));

            for (let i = 0; i < r.value.foto_tambahan.length; i++) {
                fd.append('foto_tambahan[]', r.value.foto_tambahan[i]);
            }

            fd.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

            fetch("<?= site_url('kegiatan/update') ?>", { method: 'POST', body: fd })
            .then(res => res.json())
            .then(data => {
                if (data.status == 'ok') {
                    Swal.fire('Berhasil', 'Data diupdate', 'success').then(() => location.reload());
                } else {
                    Swal.fire('Error', 'Gagal update data', 'error');
                }
            }).catch(() => Swal.fire('Error', 'Server tidak merespon!', 'error'));
        }
    });
}

function hapus(id) {
    Swal.fire({
        title: 'Yakin?',
        text: 'Data akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= site_url('kegiatan/hapus/') ?>" + id;
        }
    });
}
</script>

</body>
</html>