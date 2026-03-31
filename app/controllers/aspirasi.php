<?php

class Aspirasi {
    public $model;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (file_exists('../app/models/aspirasi_model.php')) {
            require_once '../app/models/aspirasi_model.php';
            $this->model = new aspirasi_model();
        } else {
            die("Error: File model '../app/models/aspirasi_model.php' tidak ditemukan!");
        }
    }

    // ==========================================
    // BAGIAN SISWA
    // ==========================================

    /**
     * Halaman Utama Siswa (Form Input Pengaduan)
     * FIX: Mengarah ke siswa.php sesuai struktur file Anda
     */
    public function index() {
        if (!isset($_SESSION['siswa'])) {
            header('Location: ' . BASEURL . '/index.php?url=login');
            exit;
        }

        $data['judul'] = 'Form Pengaduan Siswa';
        $data['role'] = 'siswa';
        $data['nama_user'] = $_SESSION['siswa']['nama'];
        $data['nis_user']  = $_SESSION['siswa']['nis'];
        
        // Memanggil riwayat singkat jika diperlukan di view index
        $data['riwayat'] = $this->model->getAspirasiByNIS($data['nis_user']);
        
        require_once '../app/views/templates/header.php';
        
        // Memanggil view siswa.php sebagai form input utama
        if (file_exists('../app/views/aspirasi/siswa.php')) {
            require_once '../app/views/aspirasi/siswa.php';
        } else {
            // Fallback jika file siswa.php tidak ada, coba panggil index.php
            if(file_exists('../app/views/aspirasi/index.php')){
                require_once '../app/views/aspirasi/index.php';
            } else {
                echo "<div class='alert alert-danger'>File view (siswa.php / index.php) tidak ditemukan!</div>";
            }
        }
        
        require_once '../app/views/templates/footer.php';
    }

    /**
     * Halaman Riwayat Laporan Khusus Siswa
     */
    public function riwayat() {
        if (!isset($_SESSION['siswa'])) {
            header('Location: ' . BASEURL . '/index.php?url=login');
            exit;
        }

        $data['judul'] = 'Riwayat Laporan Saya';
        $data['role'] = 'siswa';
        $data['nama_user'] = $_SESSION['siswa']['nama'];
        $data['nis_user']  = $_SESSION['siswa']['nis'];
        
        $data['riwayat'] = $this->model->getAspirasiByNIS($data['nis_user']);
        
        require_once '../app/views/templates/header.php';
        require_once '../app/views/aspirasi/riwayat_siswa.php';
        require_once '../app/views/templates/footer.php';
    }

    /**
     * Proses Simpan Laporan Baru dari Siswa
     */
    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['siswa'])) {
            $foto = '';
            
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
                $namaFile = $_FILES['foto']['name'];
                $ukuranFile = $_FILES['foto']['size'];
                $tmpName = $_FILES['foto']['tmp_name'];
                
                $ekstensiValid = ['jpg', 'jpeg', 'png'];
                $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
                
                if (in_array($ekstensi, $ekstensiValid) && $ukuranFile < 2000000) {
                    $foto = uniqid() . '.' . $ekstensi;
                    $tujuan = '../public/assets/img/laporan/' . $foto;
                    
                    // Pastikan folder tujuan ada
                    if (!file_exists('../public/assets/img/laporan/')) {
                        mkdir('../public/assets/img/laporan/', 0777, true);
                    }
                    
                    move_uploaded_file($tmpName, $tujuan);
                }
            }

            $dataInput = $_POST;
            $dataInput['nis'] = $_SESSION['siswa']['nis'];
            $dataInput['foto'] = $foto;

            if ($this->model->tambahaspirasi($dataInput) > 0) {
                header('Location: ' . BASEURL . '/index.php?url=aspirasi/riwayat&msg=success');
            } else {
                header('Location: ' . BASEURL . '/index.php?url=aspirasi/index&msg=error');
            }
            exit;
        }
    }

    /**
     * Proses Edit Laporan oleh Siswa
     */
    public function edit_siswa() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['siswa'])) {
            if ($this->model->updateAspirasiSiswa($_POST) >= 0) {
                header('Location: ' . BASEURL . '/index.php?url=aspirasi/riwayat&msg=success');
            } else {
                header('Location: ' . BASEURL . '/index.php?url=aspirasi/riwayat&msg=error');
            }
            exit;
        }
    }

    /**
     * Proses Hapus Laporan (Dapat digunakan Siswa atau Admin)
     */
    public function hapus($id) {
        if (!isset($_SESSION['siswa']) && !isset($_SESSION['admin'])) exit;

        if ($this->model->hapusData($id) > 0) {
            $redirect = isset($_SESSION['admin']) ? 'admin' : 'riwayat';
            header('Location: ' . BASEURL . '/index.php?url=aspirasi/' . $redirect . '&msg=deleted');
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '&msg=error');
        }
        exit;
    }

    // ==========================================
    // BAGIAN ADMIN
    // ==========================================

    /**
     * Halaman Dashboard Utama Admin
     */
    public function admin() {
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . BASEURL . '/index.php?url=login');
            exit;
        }

        $data['judul'] = 'Dashboard Admin';
        $data['role'] = 'admin';
        $data['nama_admin'] = $_SESSION['admin']['nama'] ?? 'Admin';
        
        $tgl_awal = $_GET['tgl_awal'] ?? null;
        $tgl_akhir = $_GET['tgl_akhir'] ?? null;

        if ($tgl_awal && $tgl_akhir) {
            $data['aspirasi'] = $this->model->getAspirasiByRange($tgl_awal, $tgl_akhir);
        } else {
            $data['aspirasi'] = $this->model->getallaspirasi();
        }
        
        require_once '../app/views/templates/header.php';
        require_once '../app/views/aspirasi/admin.php';
        require_once '../app/views/templates/footer.php';
    }

    /**
     * Proses Simpan Perubahan (Tanggapan/Status) oleh Admin
     */
    public function simpan_perubahan() {
        if (!isset($_SESSION['admin'])) exit;

        $id = $_POST['id_pelaporan'] ?? $_POST['id']; 
        $status = $_POST['status'];
        $feedback = $_POST['feedback'] ?? '';

        if ($this->model->updateData($id, $status, $feedback) >= 0) {
            header('Location: ' . BASEURL . '/index.php?url=aspirasi/admin&msg=success');
        } else {
            header('Location: ' . BASEURL . '/index.php?url=aspirasi/admin&msg=error');
        }
        exit;
    }

    /**
     * Fitur Pencarian Data untuk Admin
     */
    public function cari() {
        if (!isset($_SESSION['admin'])) exit;

        $data['judul'] = 'Hasil Pencarian';
        $data['role'] = 'admin';
        $data['nama_admin'] = $_SESSION['admin']['nama'] ?? 'Admin';
        $keyword = $_POST['keyword'] ?? '';
        $data['aspirasi'] = $this->model->cariDataAspirasi($keyword);
        
        require_once '../app/views/templates/header.php';
        require_once '../app/views/aspirasi/admin.php';
        require_once '../app/views/templates/footer.php';
    }

    // ==========================================
    // FITUR AJAX / API (JSON)
    // ==========================================

    /**
     * Endpoint untuk Real-time Notification
     */
    public function cek_laporan_baru() {
        if (ob_get_length()) ob_clean();
        $current_count = $this->model->countLaporan();
        header('Content-Type: application/json');
        echo json_encode(['total' => (int)$current_count]);
        exit; 
    }

    /**
     * Endpoint untuk mengambil detail laporan via Modal
     */
    public function get_detail() {
        if (ob_get_length()) ob_clean();
        header('Content-Type: application/json');
        $id = $_POST['id'] ?? null;
        if ($id) {
            $data = $this->model->get_aspirasi_by_id($id);
            echo json_encode($data); 
        }
        exit; 
    }
}