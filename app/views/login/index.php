<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lapor Aspirasi</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            /* Tema Emas & Hitam Obsidian */
            --primary: #fbbf24; /* Emas Terang */
            --primary-hover: #d97706; /* Emas Gelap */
            --bg-dark: #0f172a; /* Navy Gelap / Obsidian */
            --card-bg: rgba(15, 23, 42, 0.8);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            /* --- MOTIF BACKGROUND --- */
            background-image: 
                linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)),
                url("https://www.transparenttextures.com/patterns/carbon-fibre.png"), 
                radial-gradient(circle at 50% 50%, #1e293b 0%, var(--bg-dark) 80%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        /* Dekorasi Lingkaran Bercahaya Emas */
        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: var(--primary);
            filter: blur(120px);
            border-radius: 50%;
            z-index: -1;
            opacity: 0.1; /* Cahaya emas tipis agar mewah */
            animation: move 12s infinite alternate ease-in-out;
        }

        @keyframes move {
            from { transform: translate(-150px, -150px) scale(1); }
            to { transform: translate(150px, 150px) scale(1.2); }
        }

        .login-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(251, 191, 36, 0.2); /* Border emas transparan */
            border-radius: 30px;
            width: 100%;
            max-width: 400px;
            padding: 45px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.9);
            transition: all 0.4s ease;
        }
        
        .login-card:hover {
            border-color: rgba(251, 191, 36, 0.5);
            box-shadow: 0 25px 50px -12px rgba(251, 191, 36, 0.1);
        }

        .icon-box {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            border-radius: 20px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e293b; /* Ikon warna gelap agar kontras dengan emas */
            box-shadow: 0 10px 25px rgba(251, 191, 36, 0.3);
        }

        h2 { color: #fff; font-weight: 800; margin-bottom: 8px; letter-spacing: -1px; }
        p.subtitle { color: #94a3b8; font-size: 14px; margin-bottom: 35px; }

        .form-label { color: #e2e8f0; font-weight: 600; font-size: 13px; margin-left: 4px; }
        
        .form-control {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid #334155;
            border-radius: 15px;
            padding: 14px 18px;
            color: white !important;
            transition: all 0.3s;
        }

        .form-control::placeholder { color: #64748b; }

        .form-control:focus {
            background: rgba(30, 41, 59, 0.8);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(251, 191, 36, 0.15);
            outline: none;
        }

        .btn-login {
            background: linear-gradient(to right, var(--primary), #f59e0b);
            color: #1e293b; /* Teks gelap di tombol terang */
            border: none;
            border-radius: 15px;
            padding: 15px;
            font-weight: 800;
            letter-spacing: 1px;
            transition: all 0.3s;
            margin-top: 15px;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -5px rgba(251, 191, 36, 0.4);
            color: #000;
        }

        .footer-text {
            text-align: center;
            margin-top: 30px;
            color: #94a3b8;
            font-size: 14px;
        }

        .footer-text a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 800;
            transition: 0.2s;
        }
        
        .footer-text a:hover {
            color: #fff;
            text-shadow: 0 0 10px rgba(251, 191, 36, 0.5);
        }
    </style>
</head>
<body>

<div class="blob"></div>

<div class="login-card">
    <div class="icon-box">
        <i class="bi bi-megaphone-fill" style="font-size: 28px;"></i>
    </div>
    
    <h2>Lapor Aspirasi</h2>
    <p class="subtitle">Sampaikan keluhan sarana anda disini</p>
    
    <form action="<?= BASEURL; ?>/index.php?url=login/proses" method="POST">
        <div class="mb-3">
            <label class="form-label">NIS</label>
            <input type="text" name="username" class="form-control" placeholder="ID Akun" required autofocus>
        </div>
        
        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-login shadow-lg">
                MASUK <i class="bi bi-chevron-right ms-1"></i>
            </button>
        </div>
    </form>

    <div class="footer-text">
        Belum punya akun? <a href="<?= BASEURL; ?>/index.php?url=login/registrasi">Daftar Sekarang</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>