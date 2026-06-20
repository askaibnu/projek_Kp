<!DOCTYPE html>
<html>
<head>
    <title>Data UMKM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container mt-4">
    <h2>Data UMKM</h2>
    <button onclick="tambah()" class="btn btn-primary mb-3">+ Tambah</button>
    <table class="table table-bordered">
        <tr>
            <th>No</th><th>Foto</th><th>Nama</th><th>Pemilik</th>
            <th>No HP</th><th>Harga</th><th>Lokasi</th><th>Aksi</th>
        </tr>
        <?php $no=1; foreach($umkm as $u): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?php if($u->foto): ?><img src="<?= base_url('uploads/'.$u->foto) ?>" width="60"><?php else: ?>-<?php endif; ?></td>
            <td><?= $u->nama_umkm ?></td>
            <td><?= $u->pemilik ?></td>
            <td><?= $u->no_hp ?></td>
            <td><?= $u->harga ?></td>
            <td><?php if($u->lokasi): ?><a href="<?= $u->lokasi ?>" target="_blank">Lihat</a><?php else: ?>-<?php endif; ?></td>
            <td>
                <button onclick="editData(<?= $u->id ?>,'<?= addslashes($u->nama_umkm) ?>','<?= addslashes($u->pemilik) ?>','<?= addslashes($u->deskripsi) ?>','<?= $u->no_hp ?>','<?= $u->harga ?>','<?= addslashes($u->lokasi) ?>')" class="btn btn-warning btn-sm">Edit</button>
                <button onclick="hapus(<?= $u->id ?>)" class="btn btn-danger btn-sm">Hapus</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">Kembali</a>
</div>
<script>
// FUNGSI AMBIL LOKASI OTOMATIS
function ambilLokasi(inputId) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                let lat = position.coords.latitude;
                let lng = position.coords.longitude;
                document.getElementById(inputId).value = lat + ',' + lng;
            },
            function(error) {
                alert('Gagal ambil lokasi. Izinkan akses lokasi di browser!');
            }
        );
    } else {
        alert('Browser tidak mendukung geolocation!');
    }
}

function tambah() {
    Swal.fire({
        title: 'Tambah UMKM',
        html: `
            <input type="text" id="nama" class="swal2-input" placeholder="Nama UMKM">
            <input type="text" id="pemilik" class="swal2-input" placeholder="Pemilik">
            <textarea id="deskripsi" class="swal2-textarea" placeholder="Deskripsi"></textarea>
            <input type="text" id="no_hp" class="swal2-input" placeholder="No HP">
            <input type="text" id="harga" class="swal2-input" placeholder="Harga (contoh: Rp. 10.000)">
            <div style="display:flex;gap:8px;align-items:center;padding:0 16px;margin-top:8px;">
                <input type="text" id="lokasi" class="swal2-input" style="margin:0;flex:1;" placeholder="Koordinat lokasi (otomatis)">
                <button type="button" onclick="ambilLokasi('lokasi')" style="background:#198754;color:white;border:none;border-radius:8px;padding:10px 12px;cursor:pointer;white-space:nowrap;">
                    📍 Ambil
                </button>
            </div>
            <input type="file" id="foto" class="swal2-file" style="margin-top:8px;">
        `,
        confirmButtonText: 'Simpan',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        preConfirm: () => {
            let nama = document.getElementById('nama').value;
            let pemilik = document.getElementById('pemilik').value;
            if (!nama || !pemilik) {
                Swal.showValidationMessage('Nama & Pemilik wajib diisi!');
                return false;
            }
            return {
                nama, pemilik,
                deskripsi: document.getElementById('deskripsi').value,
                no_hp: document.getElementById('no_hp').value,
                harga: document.getElementById('harga').value,
                lokasi: document.getElementById('lokasi').value,
                foto: document.getElementById('foto').files[0]
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            let formData = new FormData();
            formData.append('nama', result.value.nama);
            formData.append('pemilik', result.value.pemilik);
            formData.append('deskripsi', result.value.deskripsi);
            formData.append('no_hp', result.value.no_hp);
            formData.append('harga', result.value.harga);
            formData.append('lokasi', result.value.lokasi);
            formData.append('foto', result.value.foto);
            fetch("<?= site_url('umkm/simpan') ?>", { method: "POST", body: formData })
            .then(res => res.json())
            .then(data => {
                if (data.status == 'ok') {
                    Swal.fire('Berhasil!', 'Data UMKM tersimpan', 'success').then(() => location.reload());
                } else {
                    Swal.fire('Error', 'Gagal simpan data', 'error');
                }
            }).catch(() => Swal.fire('Error', 'Server tidak merespon!', 'error'));
        }
    })
}

function hapus(id) {
    Swal.fire({ title: 'Yakin?', text: 'Data akan dihapus!', icon: 'warning', showCancelButton: true, confirmButtonText: 'Ya, hapus' })
    .then((result) => { if (result.isConfirmed) window.location = "<?= site_url('umkm/hapus/') ?>" + id; })
}

function editData(id, nama, pemilik, deskripsi, no_hp, harga, lokasi) {
    Swal.fire({
        title: 'Edit UMKM',
        html: `
            <input type="text" id="nama" class="swal2-input" value="${nama}" placeholder="Nama UMKM">
            <input type="text" id="pemilik" class="swal2-input" value="${pemilik}" placeholder="Pemilik">
            <textarea id="deskripsi" class="swal2-textarea">${deskripsi}</textarea>
            <input type="text" id="no_hp" class="swal2-input" value="${no_hp}" placeholder="No HP">
            <input type="text" id="harga" class="swal2-input" value="${harga}" placeholder="Harga">
            <div style="display:flex;gap:8px;align-items:center;padding:0 16px;margin-top:8px;">
                <input type="text" id="lokasi" class="swal2-input" style="margin:0;flex:1;" value="${lokasi}" placeholder="Koordinat lokasi (otomatis)">
                <button type="button" onclick="ambilLokasi('lokasi')" style="background:#198754;color:white;border:none;border-radius:8px;padding:10px 12px;cursor:pointer;white-space:nowrap;">
                    📍 Ambil
                </button>
            </div>
            <input type="file" id="foto" class="swal2-file" style="margin-top:8px;">
        `,
        confirmButtonText: 'Update',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        preConfirm: () => ({
            id,
            nama: document.getElementById('nama').value,
            pemilik: document.getElementById('pemilik').value,
            deskripsi: document.getElementById('deskripsi').value,
            no_hp: document.getElementById('no_hp').value,
            harga: document.getElementById('harga').value,
            lokasi: document.getElementById('lokasi').value,
            foto: document.getElementById('foto').files[0]
        })
    }).then((result) => {
        if (result.isConfirmed) {
            let formData = new FormData();
            formData.append('id', result.value.id);
            formData.append('nama', result.value.nama);
            formData.append('pemilik', result.value.pemilik);
            formData.append('deskripsi', result.value.deskripsi);
            formData.append('no_hp', result.value.no_hp);
            formData.append('harga', result.value.harga);
            formData.append('lokasi', result.value.lokasi);
            if (result.value.foto) formData.append('foto', result.value.foto);
            fetch("<?= site_url('umkm/update') ?>", { method: "POST", body: formData })
            .then(res => res.json())
            .then(data => {
                if (data.status == 'ok') {
                    Swal.fire('Berhasil!', 'Data berhasil diupdate', 'success').then(() => location.reload());
                } else {
                    Swal.fire('Error', 'Gagal update data', 'error');
                }
            });
        }
    })
}
</script>
</body>
</html>