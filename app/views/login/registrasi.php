<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container-reg { min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { width: 400px; border: none; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
<div class="container-reg">
    <div class="card p-4">
        <h4 class="text-center mb-4">DAFTAR AKUN</h4>
        
        <form action="index.php?url=login/proses_registrasi" method="POST">
            <div class="mb-3">
                <label class="form-label">NIS</label>
                <input type="text" name="nis" class="form-control" placeholder="Input NIS" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Input Nama" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Input Password" required>
            </div>
            <button type="submit" class="btn btn-success w-100 py-2">DAFTAR SEKARANG</button>
        </form>

        <div class="text-center mt-3">
            <a href="index.php?url=login" style="color: gray; text-decoration: none;">&larr; Kembali ke Login</a>
        </div>
    </div>
</div>
</body>
</html>