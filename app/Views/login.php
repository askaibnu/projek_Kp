<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #198754 0%, #0f5132 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }
        .login-logo {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #198754, #0f5132);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 16px;
            border: 1.5px solid #e0e0e0;
            font-size: 0.95rem;
        }
        .form-control:focus {
            border-color: #198754;
            box-shadow: 0 0 0 3px rgba(25,135,84,0.15);
        }
        .input-group-text {
            border-radius: 10px 0 0 10px;
            background: #f8f9fa;
            border: 1.5px solid #e0e0e0;
            border-right: none;
            color: #198754;
        }
        .input-group .form-control {
            border-radius: 0 10px 10px 0;
            border-left: none;
        }
        .input-group .form-control:focus {
            border-left: none;
        }
        .btn-login {
            background: linear-gradient(135deg, #198754, #0f5132);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(25,135,84,0.4);
        }
        .back-link {
            color: #198754;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .back-link:hover {
            color: #0f5132;
        }
    </style>
</head>
<body>

<div class="login-card">

        
   <!-- LOGO -->
<div class="text-center mb-3">
    <img src="<?= base_url('uploads/logo.png') ?>" height="80">
</div>

    <!-- JUDUL -->
    <div class="text-center mb-4">
        <h4 style="font-weight:700;color:#1a1a1a;margin:0;">Login Admin</h4>
        <p style="color:#888;font-size:0.9rem;margin-top:4px;">Karang Taruna Desa Waru</p>
    </div>

    <!-- FORM -->
    <form method="post" action="<?= site_url('login/proses') ?>">
        <?= csrf_field() ?>

        <div class="mb-3">
    <label style="font-size:0.9rem;font-weight:600;color:#444;margin-bottom:6px;display:block;">Email</label>
    <div class="input-group">
        <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
        <input type="email" name="email" class="form-control" placeholder="Masukkan email">
    </div>
</div>
        <div class="mb-4">
            <label style="font-size:0.9rem;font-weight:600;color:#444;margin-bottom:6px;display:block;">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password">
            </div>
        </div>

        <button type="submit" class="btn btn-login btn-success w-100 text-white">
            <i class="bi bi-box-arrow-in-right me-2"></i>Login
        </button>

    </form>

    <!-- BACK -->
    <div class="text-center mt-3">
        <a href="<?= site_url('/') ?>" class="back-link">
            <i class="bi bi-arrow-left me-1"></i>Kembali ke Halaman Utama
        </a>
    </div>

</div>

</body>
</html>