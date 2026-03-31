<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pengaduan Sarana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 15px; border: none; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-5">
            <div class="card shadow-lg p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-dark">Daftar Akun</h3>
                    <p class="text-muted small">Lengkapi data diri untuk mulai melapor</p>
                </div>
                <form action="index.php?url=auth/register" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">NIS</label>
                            <input type="number" name="nis" class="form-control" placeholder="NIS" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Kelas</label>
                        <input type="text" name="kelas" class="form-control" placeholder="Contoh: XII RPL 2" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Buat password" required>
                    </div>
                    <button type="submit" class="btn btn-dark w-100 fw-bold py-2 shadow-sm">DAFTAR SEKARANG</button>
                    <div class="text-center mt-3">
                        <span class="small text-muted">Sudah punya akun? <a href="index.php?url=auth/login" class="text-decoration-none fw-bold text-primary">Login</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>