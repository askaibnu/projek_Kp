<!DOCTYPE html>
<html>
<head>
    <title>Edit Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Edit Anggota</h2>

    <form method="post" action="<?= site_url('anggota/update/'.$anggota->id) ?>">
        <input type="text" name="nama" class="form-control mb-2" value="<?= $anggota->nama ?>">
        <textarea name="alamat" class="form-control mb-2"><?= $anggota->alamat ?></textarea>
        <input type="text" name="no_hp" class="form-control mb-2" value="<?= $anggota->no_hp ?>">

        <button class="btn btn-success">Update</button>
    </form>

</div>

</body>
</html>