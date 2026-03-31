<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['judul']; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --sb-width: 280px;
            --primary: #fbbf24; /* Emas Terang */
            --primary-hover: #d97706; /* Emas Gelap */
            --dark-sidebar: #0f172a; /* Obsidian Navy */
            --bg-light: #f8fafc;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg-light);
            margin: 0;
            overflow-x: hidden;
        }

        /* --- SIDEBAR MODERN --- */
        .sidebar-modern {
            width: var(--sb-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--dark-sidebar);
            background-image: url("https://www.transparenttextures.com/patterns/carbon-fibre.png");
            z-index: 1000;
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(251, 191, 36, 0.1);
        }

        .sidebar-brand {
            padding: 40px 25px;
            text-align: center;
        }
        
        .sidebar-brand h4 { 
            color: #ffffff; 
            font-weight: 800;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .sidebar-modern .nav-link {
            padding: 14px 25px;
            color: #94a3b8;
            font-weight: 600;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            border-radius: 15px;
            margin: 4px 18px;
            text-decoration: none;
        }

        .sidebar-modern .nav-link i {
            font-size: 1.25rem;
            margin-right: 15px;
            transition: 0.3s;
        }

        .sidebar-modern .nav-link:hover {
            background: rgba(251, 191, 36, 0.05);
            color: var(--primary);
        }

        .sidebar-modern .nav-link.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            color: #1e293b !important;
            box-shadow: 0 10px 20px rgba(251, 191, 36, 0.2);
        }

        .sidebar-modern .nav-link.active i {
            color: #1e293b;
        }

        .menu-label {
            padding: 20px 35px 10px;
            text-transform: uppercase;
            font-size: 11px;
            font-weight: 800;
            color: rgba(251, 191, 36, 0.5);
            letter-spacing: 1.5px;
        }

        .main-container {
            margin-left: var(--sb-width);
            min-height: 100vh;
            width: calc(100% - var(--sb-width));
        }

        .top-bar {
            height: 80px;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-profile-btn {
            background: #f1f5f9;
            padding: 8px 15px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid #e2e8f0;
        }

        .content-padding {
            padding: 40px;
        }

        @media print {
            .sidebar-modern, .top-bar, .btn-group, .btn { display: none !important; }
            .main-container { margin-left: 0 !important; width: 100% !important; }
            .content-padding { padding: 0 !important; }
        }
    </style>
</head>
<body>

<?php 
// Mengambil role dari session secara aman
$role = 'siswa';
if (isset($_SESSION['admin'])) {
    $role = 'admin';
} elseif (isset($_SESSION['siswa'])) {
    $role = 'siswa';
}
?>

<div class="sidebar-modern shadow-lg">
    <div class="sidebar-brand">
        <h4 class="mb-0">
            <i class="bi bi-megaphone-fill" style="color: var(--primary);"></i> EH-ULIL
        </h4>
        <small style="color: rgba(251, 191, 36, 0.6); font-size: 10px; font-weight: 700; letter-spacing: 1px;">LAPOR ASPIRASI</small>
    </div>

    <nav class="nav flex-column flex-grow-1 mt-2">
    <?php if($role == 'admin') : ?>
        <div class="menu-label">MENU UTAMA</div>
        
        <a class="nav-link <?php echo ($data['judul'] == 'Dashboard Admin') ? 'active' : ''; ?>" 
           href="<?php echo BASEURL; ?>/index.php?url=aspirasi/admin">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>


        <div class="menu-label">PENGATURAN</div>

        <a class="nav-link <?php echo ($data['judul'] == 'Profil Admin') ? 'active' : ''; ?>" 
           href="<?php echo BASEURL; ?>/index.php?url=profil/admin">
            <i class="bi bi-person-vcard-fill"></i> Profil Admin
        </a>
        
        <a class="nav-link <?php echo ($data['judul'] == 'Cetak Rekap') ? 'active' : ''; ?>" 
           href="<?php echo BASEURL; ?>/index.php?url=laporan">
            <i class="bi bi-printer-fill"></i> Cetak Rekap
        </a>

    <?php else : ?>
        <div class="menu-label">SISWA PANEL</div>
        
        <a class="nav-link <?php echo ($data['judul'] == 'Form Pengaduan Siswa') ? 'active' : ''; ?>" 
           href="<?= BASEURL; ?>/index.php?url=aspirasi/index">
            <i class="bi bi-pencil-square"></i> Buat Laporan
        </a>
        
        <a class="nav-link <?php echo ($data['judul'] == 'Riwayat Laporan Saya') ? 'active' : ''; ?>" 
           href="<?= BASEURL; ?>/index.php?url=aspirasi/riwayat">
            <i class="bi bi-clock-history"></i> Riwayat Saya
        </a>
    <?php endif; ?>
    </nav>

    <div class="p-4 border-top" style="border-color: rgba(255,255,255,0.05) !important;">
        <a href="<?php echo BASEURL; ?>/index.php?url=login/logout" class="btn btn-outline-warning w-100 rounded-pill fw-bold" style="border-width: 2px;">
            <i class="bi bi-box-arrow-left me-2"></i> Keluar
        </a>
    </div>
</div>

<div class="main-container">
    <header class="top-bar">
        <h5 class="fw-bold text-dark mb-0"><?php echo $data['judul']; ?></h5>
        
        <div class="user-profile-btn">
            <div class="text-end">
                <p class="mb-0 small fw-bold text-dark text-capitalize">
                    <?php 
                        if($role == 'admin') {
                            echo $_SESSION['admin']['nama'] ?? 'Admin';
                        } else {
                            echo $_SESSION['siswa']['nama'] ?? 'Siswa';
                        }
                    ?>
                </p>
                <p class="mb-0 small text-muted text-uppercase" style="font-size: 9px; font-weight: 700; color: var(--primary-hover) !important;">
                    <?php echo $role; ?>
                </p>
            </div>
            <?php 
                $nama_avatar = ($role == 'admin') ? ($_SESSION['admin']['nama'] ?? 'A') : ($_SESSION['siswa']['nama'] ?? 'S');
            ?>
            <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($nama_avatar); ?>&background=fbbf24&color=1e293b&bold=true" 
                 class="rounded-circle" width="38">
        </div>
    </header>
    <div class="content-padding">