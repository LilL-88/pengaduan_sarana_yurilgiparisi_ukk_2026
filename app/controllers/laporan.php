<?php

class Laporan {
    /**
     * CONSTRUCT: Proteksi Halaman
     * Memastikan hanya Admin yang bisa mengakses halaman rekap ini.
     */
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Jika tidak ada session admin, tendang ke halaman login/dashboard siswa
        // Ini kunci agar Siswa tidak bisa melihat rekap seluruh laporan
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . BASEURL . '/index.php?url=login');
            exit;
        }
    }

    /**
     * INDEX: Menampilkan Tabel Rekap Laporan
     */
    public function index() {
        // Memanggil Model
        require_once '../app/models/aspirasi_model.php';
        $model = new aspirasi_model();
        
        $data['judul'] = 'Rekap Laporan';
        
        // 1. Ambil data filter tanggal dari URL (jika ada)
        $awal  = $_GET['tgl_awal'] ?? null;
        $akhir = $_GET['tgl_akhir'] ?? null;

        // 2. Logika Filter:
        // Jika admin memilih rentang tanggal, panggil fungsi range.
        // Jika tidak, tampilkan semua data laporan yang ada.
        if ($awal && $akhir) {
            $data['aspirasi'] = $model->getAspirasiByRange($awal, $akhir);
        } else {
            $data['aspirasi'] = $model->getallaspirasi();
        }

        // 3. Panggil View Templates & Content
        require_once '../app/views/templates/header.php';
        require_once '../app/views/laporan/index.php';
        require_once '../app/views/templates/footer.php';
    }
}