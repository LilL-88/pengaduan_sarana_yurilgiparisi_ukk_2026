<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pengaduan Sarana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 15px; border: none; }
        .btn-primary { border-radius: 10px; padding: 10px; background-color: #0d6efd; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-4">
            <div class="card shadow-lg p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-dark">Lapor Sarana</h3>
                    <p class="text-muted small">Silahkan masuk dengan NIS Anda</p>
                </div>
                <form action="index.php?url=auth/login" method="POST">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">NIS</label>
                        <input type="number" name="nis" class="form-control form-control-lg" placeholder="Contoh: 12345" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="******" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm">MASUK SEKARANG</button>
                    <div class="text-center mt-4">
                        <span class="small text-muted">Belum punya akun? <a href="index.php?url=auth/register" class="text-decoration-none fw-bold">Daftar Akun</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>