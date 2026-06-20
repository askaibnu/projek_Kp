<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container mt-4">
    <h2>Data Anggota</h2>
    <p class="text-muted">Jumlah anggota Karang Taruna Desa Waru.</p>

    <div class="card" style="max-width: 400px;">
        <div class="card-body text-center">
            <p class="text-muted mb-1">Total Anggota</p>
            <h1 class="display-3 fw-bold text-success" id="angkaAnggota">
                <?= $anggota->jumlah_anggota ?? 0 ?>
            </h1>
            <p class="text-muted">orang</p>
            <button onclick="editJumlah()" class="btn btn-warning mt-2">✏️ Ubah Jumlah</button>
        </div>
    </div>

    <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary mt-3">Kembali</a>
</div>

<script>
function editJumlah() {
    Swal.fire({
        title: 'Ubah Jumlah Anggota',
        html: `<input type="number" id="jumlah" class="swal2-input" placeholder="Masukkan jumlah" min="0" value="<?= $anggota->jumlah_anggota ?? 0 ?>">`,
        confirmButtonText: 'Simpan',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        preConfirm: () => {
            const val = document.getElementById('jumlah').value;
            if (val === '' || val < 0) {
                Swal.showValidationMessage('Masukkan angka yang valid');
                return false;
            }
            return val;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            let formData = new FormData();
            formData.append('jumlah_anggota', result.value);

            fetch("<?= site_url('anggota/simpan') ?>", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(() => {
                // Update angka langsung tanpa reload
                document.getElementById('angkaAnggota').textContent = result.value;

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Jumlah anggota diperbarui menjadi ' + result.value,
                    timer: 1500,
                    showConfirmButton: false
                });
            })
            .catch(() => {
                Swal.fire('Error', 'Gagal menyimpan data', 'error');
            });
        }
    });
}
</script>

</body>
</html>