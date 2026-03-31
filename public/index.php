<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('BASEURL', 'http://localhost/pengaduan_sarana/public');
require_once '../app/core/database.php';

if (file_exists('../app/core/Controller.php')) {
    require_once '../app/core/Controller.php';
}

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'aspirasi';

function loadController($namaFile) {
    $pathLower = '../app/controllers/' . strtolower($namaFile) . '.php';
    if (file_exists($pathLower)) {
        require_once $pathLower;
    } else {
        die("Error: File Controller <b>{$namaFile}.php</b> tidak ditemukan di {$pathLower}");
    }
}

// ==========================================
// --- SISTEM ROUTING SATU PINTU (FINAL) ---
// ==========================================

// 1. RUTE ADMIN & DASHBOARD
if ($url == 'admin' || $url == 'aspirasi/admin') {
    loadController('aspirasi');
    $controller = new aspirasi();
    $controller->admin();
} 

// 2. RUTE PROFIL
elseif ($url == 'profil') {
    loadController('profil');
    $controller = new profil();
    $controller->index();
} 
elseif ($url == 'profil/admin') {
    loadController('profil');
    $controller = new profil();
    $controller->admin();
}

// 3. RUTE LOGIN & REGISTRASI
elseif ($url == 'login') {
    loadController('login');
    $controller = new login();
    $controller->index();
} elseif ($url == 'login/proses') {
    loadController('login');
    $controller = new login();
    $controller->proses();
} elseif ($url == 'login/registrasi') {
    loadController('login');
    $controller = new login();
    $controller->registrasi();
} elseif ($url == 'login/proses_registrasi') {
    loadController('login');
    $controller = new login();
    $controller->proses_registrasi();
} elseif ($url == 'logout' || $url == 'login/logout') {
    loadController('login');
    $controller = new login();
    $controller->logout();
} 

// 4. RUTE CETAK LAPORAN (PDF/REKAP)
elseif ($url == 'laporan') {
    if (file_exists('../app/controllers/Laporan.php')) {
        require_once '../app/controllers/Laporan.php';
        $controller = new Laporan();
        $controller->index();
    } else {
        die("Error: File Laporan.php belum ada di folder controllers!");
    }
}

// 5. RUTE ASPIRASI (PUSAT KENDALI)
elseif ($url == 'aspirasi' || $url == 'aspirasi/index') {
    loadController('aspirasi');
    $controller = new aspirasi();
    $controller->index();
} 
elseif ($url == 'aspirasi/riwayat') {
    loadController('aspirasi');
    $controller = new aspirasi();
    $controller->riwayat();
} 
elseif ($url == 'simpan' || $url == 'aspirasi/simpan') {
    loadController('aspirasi');
    $controller = new aspirasi();
    $controller->simpan();
} 
elseif ($url == 'aspirasi/simpan_perubahan') {
    loadController('aspirasi');
    $controller = new aspirasi();
    $controller->simpan_perubahan();
} 
elseif ($url == 'aspirasi/get_detail') {
    loadController('aspirasi');
    $controller = new aspirasi();
    $controller->get_detail();
} 
elseif ($url == 'aspirasi/cek_laporan_baru') {
    loadController('aspirasi');
    $controller = new aspirasi();
    $controller->cek_laporan_baru();
} 
elseif ($url == 'aspirasi/edit_siswa') {
    loadController('aspirasi');
    $controller = new aspirasi();
    $controller->edit_siswa();
} 
elseif ($url == 'aspirasi/cari') {
    loadController('aspirasi');
    $controller = new aspirasi();
    $controller->cari();
} 
elseif (strpos($url, 'aspirasi/hapus') !== false) {
    $urlParts = explode('/', $url);
    $id = end($urlParts);
    loadController('aspirasi');
    $controller = new aspirasi();
    $controller->hapus($id);
}

// 6. RUTE DEFAULT (BACKUP)
else {
    loadController('aspirasi');
    $controller = new aspirasi();
    $controller->index();
}