<?php

class profil {
    public function __construct() {
        // PHP_SESSION_NONE harus kapital karena ini konstanta bawaan PHP
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // satpam: cek apakah sudah login admin
        if (!isset($_SESSION['admin'])) {
            // BASEURL juga harus kapital sesuai yang didefinisikan di config
            header('location: ' . BASEURL . '/index.php?url=login');
            exit;
        }
    }

    public function admin() {
        $data['judul'] = 'profil admin';
        $data['admin_name'] = $_SESSION['admin']; 
        $data['role'] = $_SESSION['role'];

        require_once '../app/views/templates/header.php';
        require_once '../app/views/profil/admin.php';
        require_once '../app/views/templates/footer.php';
    }
}