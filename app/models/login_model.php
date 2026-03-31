<?php
class Login_model {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }
    public function cekAdmin($u, $p) {
        $this->db->query("SELECT * FROM admin WHERE username = :u AND password = :p");
        $this->db->bind('u', $u); $this->db->bind('p', $p);
        return $this->db->single();
    }
    public function cekSiswa($u, $p) {
        $this->db->query("SELECT * FROM siswa WHERE nis = :u AND password = :p");
        $this->db->bind('u', $u); $this->db->bind('p', $p);
        return $this->db->single();
    }
}