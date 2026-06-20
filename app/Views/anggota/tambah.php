<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Data Anggota</h2>
    <p class="text-muted">Perbarui jumlah anggota Karang Taruna Desa Waru.</p>

    <div class="card" style="max-width: 400px;">
        <div class="card-body">
            <form method="post" action="<?= site_url('anggota/simpan') ?>">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jumlah Anggota</label>
                    <input type="number" name="jumlah_anggota" class="form-control form-control-lg"
                           placeholder="Contoh: 10" min="0" required>
                    <div class="form-text">Masukkan angka total anggota saat ini.</div>
                </div>

                <a href="<?= site_url('anggota') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>