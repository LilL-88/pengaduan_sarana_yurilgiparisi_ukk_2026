<?php

class login {
    public $db;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        require_once '../app/core/database.php';
        $this->db = new Database();
    }

    public function index() {
        if (isset($_SESSION['admin'])) {
            header('Location: ' . BASEURL . '/index.php?url=aspirasi/admin');
            exit;
        } elseif (isset($_SESSION['siswa'])) {
            header('Location: ' . BASEURL . '/index.php?url=aspirasi');
            exit;
        }

        $data['judul'] = 'halaman login';
        require_once '../app/views/login/index.php';
    }

    public function registrasi() {
        $data['judul'] = 'daftar akun siswa';
        require_once '../app/views/login/registrasi.php';
    }

    public function proses_registrasi() {
        $nis      = $_POST['nis'];
        $nama     = $_POST['nama'];
        $password = $_POST['password'];

        if (empty($nis) || empty($nama) || empty($password)) {
            echo "<script>alert('semua kolom wajib diisi!'); window.location.href='".BASEURL."/index.php?url=login/registrasi';</script>";
            exit;
        }

        $this->db->query("SELECT * FROM siswa WHERE nis = :nis");
        $this->db->bind('nis', $nis);
        
        if ($this->db->single()) {
            echo "<script>alert('nis sudah terdaftar!'); window.location.href='".BASEURL."/index.php?url=login/registrasi';</script>";
            exit;
        }

        $this->db->query("INSERT INTO siswa (nis, nama, password) VALUES (:nis, :nama, :password)");
        $this->db->bind('nis', $nis);
        $this->db->bind('nama', $nama);
        $this->db->bind('password', $password);

        if ($this->db->execute()) {
            echo "<script>alert('registrasi berhasil! silakan login.'); window.location.href='".BASEURL."/index.php?url=login';</script>";
            exit;
        }
    }

    public function proses() {
        $u = $_POST['username'];
        $p = $_POST['password'];

        if (empty($u) || empty($p)) {
            echo "<script>alert('username dan password wajib diisi!'); window.location.href='".BASEURL."/index.php?url=login';</script>";
            exit;
        }
        
        // --- CEK ADMIN ---
        $this->db->query("SELECT * FROM admin WHERE username = :u AND password = :p");
        $this->db->bind('u', $u); 
        $this->db->bind('p', $p);
        $admin = $this->db->single();

        if ($admin) {
            $_SESSION['admin'] = $admin['username'];
            $_SESSION['role']  = 'admin'; // Tambahkan ini untuk sidebar
            $_SESSION['nama']  = 'Administrator'; // Nama tampilan admin
            header('Location: ' . BASEURL . '/index.php?url=aspirasi/admin');
            exit;
        } 

        // --- CEK SISWA ---
        $this->db->query("SELECT * FROM siswa WHERE nis = :u AND password = :p");
        $this->db->bind('u', $u); 
        $this->db->bind('p', $p);
        $siswa = $this->db->single();

        if ($siswa) {
            $_SESSION['siswa'] = $siswa;
            $_SESSION['role']  = 'siswa'; // Tambahkan ini untuk sidebar
            $_SESSION['nama']  = $siswa['nama']; // Mengambil nama asli siswa
            header('Location: ' . BASEURL . '/index.php?url=aspirasi');
            exit;
        }

        echo "<script>alert('login gagal! periksa kembali username/password.'); window.location.href='".BASEURL."/index.php?url=login';</script>";
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        session_unset();
        session_destroy();
        header('Location: ' . BASEURL . '/index.php?url=login');
        exit;
    }
} // Penutup Class harus di paling bawah