<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Karang Taruna</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-color: #f4f6f9;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 12px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2 sidebar p-3">
            <h4>Karang Taruna</h4>
            <hr>

            <a href="<?= site_url('dashboard') ?>">Dashboard</a>
            <a href="<?= site_url('anggota') ?>">Data Anggota</a>

            <hr>
            <a href="<?= site_url('logout') ?>" class="text-danger">Logout</a>
        </div>

        <!-- CONTENT -->
        <div class="col-md-10 p-4">

            <h3>Dashboard</h3>
            <p>Selamat datang, Admin 👋</p>

            <!-- CARD -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow p-3">
                        <h5>👥 Anggota</h5>
                        <p>Total anggota</p>
                        <h3><?= $totalAnggota ?></h3>
                        <a href="<?= site_url('anggota') ?>" class="btn btn-primary">Masuk</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow p-3">
                        <h5>📅 Kegiatan</h5>
                        <p>Kelola kegiatan desa</p>
                        <a href="#" class="btn btn-success">Masuk</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow p-3">
                        <h5>🛒 UMKM</h5>
                        <p>Promosi UMKM lokal</p>
                        <a href="#" class="btn btn-warning">Masuk</a>
                    </div>
                </div>
            </div>

            <!-- GRAFIK -->
            <div class="row mt-4">

                <div class="col-md-6">
                    <div class="card shadow p-3">
                        <h5>Grafik Anggota per Jabatan</h5>
                        <canvas id="chartJabatan" height="120"></canvas>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow p-3">
                        <h5>Grafik Anggota per Bulan</h5>
                        <canvas id="chartBulan" height="120"></canvas>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<script>
/* ===== JABATAN ===== */
var jabatanLabel = [
<?php foreach($jabatan as $j): ?>
    "<?= $j->jabatan ?>",
<?php endforeach; ?>
];

var jabatanData = [
<?php foreach($jabatan as $j): ?>
    <?= $j->total ?>,
<?php endforeach; ?>
];

new Chart(document.getElementById('chartJabatan'), {
    type: 'bar',
    data: {
        labels: jabatanLabel,
        datasets: [{
            label: 'Jumlah',
            data: jabatanData,
            backgroundColor: ['#007bff','#28a745','#ffc107','#dc3545']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});


/* ===== BULAN ===== */
var bulanLabel = ["Bulan Ini"];
var bulanData = [
<?php foreach($bulan as $b): ?>
    <?= $b->total ?>,
<?php endforeach; ?>
];

new Chart(document.getElementById('chartBulan'), {
    type: 'line',
    data: {
        labels: bulanLabel,
        datasets: [{
            label: 'Anggota',
            data: bulanData,
            borderColor: '#007bff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>

</body>
</html>