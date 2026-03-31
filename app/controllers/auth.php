<?php
// Nama file: app/controllers/auth.php

class Auth {
    public $model;

    public function __construct() {
        // Pastikan model sudah diload dengan benar
        require_once '../app/models/aspirasi_model.php';
        $this->model = new Aspirasi_model();
    }

    public function login() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        // Hanya redirect jika SUDAH benar-benar login
        if (isset($_SESSION['siswa'])) {
            header('Location: index.php?url=aspirasi');
            exit;
        }

        if (isset($_POST['nis'])) {
            $nis = $_POST['nis'];
            $pass = $_POST['password'];
            
            $user = $this->model->cekLoginSiswa($nis, $pass);
            if ($user) {
                $_SESSION['siswa'] = $user;
                header('Location: index.php?url=aspirasi');
                exit;
            } else {
                echo "<script>alert('NIS atau Password Salah!'); window.location.href='index.php?url=auth/login';</script>";
                exit;
            }
        }
        
        $data['judul'] = 'Login Siswa';
        // Pastikan file ini ADA di folder app/views/auth/login.php
        require_once '../app/views/auth/login.php';
    }

    public function register() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (isset($_POST['nis'])) {
            if ($this->model->registrasiSiswa($_POST) > 0) {
                echo "<script>alert('Berhasil Daftar! Silahkan Login'); window.location.href='index.php?url=auth/login';</script>";
                exit;
            }
        }
        $data['judul'] = 'Register Siswa';
        require_once '../app/views/auth/register.php';
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_unset();
        session_destroy();
        header('Location: index.php?url=auth/login');
        exit;
    }
}