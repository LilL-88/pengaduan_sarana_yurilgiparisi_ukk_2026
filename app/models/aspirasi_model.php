<?php

class Aspirasi_model {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // ============================================================
    // 1. FUNGSI AUTH
    // ============================================================

    public function cekLoginSiswa($nis, $password) {
        $this->db->query("SELECT * FROM siswa WHERE nis = :nis AND password = :password");
        $this->db->bind('nis', $nis);
        $this->db->bind('password', $password); 
        return $this->db->single();
    }

    public function cekLoginAdmin($username, $password) {
        $this->db->query("SELECT * FROM admin WHERE username = :username AND password = :password");
        $this->db->bind('username', $username);
        $this->db->bind('password', $password); 
        return $this->db->single();
    }

    public function registrasiSiswa($data) {
        $this->db->query("SELECT * FROM siswa WHERE nis = :nis");
        $this->db->bind('nis', $data['nis']);
        $this->db->execute();
        
        if($this->db->rowCount() > 0) return 0;

        $query = "INSERT INTO siswa (nis, password, kelas) VALUES (:nis, :password, :kelas)";
        $this->db->query($query);
        $this->db->bind('nis', $data['nis']);
        $this->db->bind('password', $data['password']); 
        $this->db->bind('kelas', $data['kelas']);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    // ============================================================
    // 2. FUNGSI MANAJEMEN ASPIRASI (Tabel: input_aspirasi)
    // ============================================================

   public function tambahaspirasi($data) {
    // Pastikan kolom 'foto' ada di query INSERT
    $query = "INSERT INTO input_aspirasi (nis, id_kategori, lokasi, ket, foto, status, feedback) 
              VALUES (:nis, :id_kategori, :lokasi, :ket, :foto, 'Menunggu', '')";
    
    $this->db->query($query);
    $this->db->bind('nis', $data['nis']);
    $this->db->bind('id_kategori', $data['id_kategori']);
    $this->db->bind('lokasi', $data['lokasi']);
    $this->db->bind('ket', $data['ket']);
    $this->db->bind('foto', $data['foto']); // Mengikat data foto
    
    $this->db->execute();
    return $this->db->rowCount();
}
    public function getallaspirasi() {
        $query = "SELECT a.*, k.ket_kategori 
                  FROM input_aspirasi a
                  LEFT JOIN kategori k ON a.id_kategori = k.id_kategori
                  ORDER BY a.id_pelaporan DESC";
                  
        $this->db->query($query);
        return $this->db->resultset();
    }

    public function getAspirasiByNIS($nis) {
        $query = "SELECT a.*, k.ket_kategori 
                  FROM input_aspirasi a
                  LEFT JOIN kategori k ON a.id_kategori = k.id_kategori
                  WHERE a.nis = :nis
                  ORDER BY a.id_pelaporan DESC";
                  
        $this->db->query($query);
        $this->db->bind('nis', $nis);
        return $this->db->resultset();
    }

    public function get_aspirasi_by_id($id) {
        $query = "SELECT a.*, k.ket_kategori 
                  FROM input_aspirasi a
                  LEFT JOIN kategori k ON a.id_kategori = k.id_kategori
                  WHERE a.id_pelaporan = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function hapusData($id) {
        $this->db->query("DELETE FROM input_aspirasi WHERE id_pelaporan = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }   

    public function updateAspirasiSiswa($data) {
        $query = "UPDATE input_aspirasi 
                  SET lokasi = :lokasi, 
                      ket = :ket 
                  WHERE id_pelaporan = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('lokasi', $data['lokasi']);
        $this->db->bind('ket', $data['ket']);
        
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function update_status($id, $status) {
        $query = "UPDATE input_aspirasi SET status = :status WHERE id_pelaporan = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('status', $status);
        $this->db->execute();
        return $this->db->rowCount();
    }
 // === notif
   public function countLaporan() {
    $this->db->query("SELECT COUNT(*) as total FROM input_aspirasi");
    return $this->db->single()['total'];
}

    public function updateData($id, $status, $feedback) {
        $query = "UPDATE input_aspirasi SET 
                    status = :status, 
                    feedback = :feedback 
                  WHERE id_pelaporan = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('status', $status);
        $this->db->bind('feedback', $feedback);
        
        $this->db->execute();
        return $this->db->rowCount();
    }



    public function cariDataAspirasi($keyword) {
        $query = "SELECT a.*, k.ket_kategori 
                  FROM input_aspirasi a
                  LEFT JOIN kategori k ON a.id_kategori = k.id_kategori
                  WHERE a.ket LIKE :keyword 
                  OR a.lokasi LIKE :keyword 
                  OR a.status LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultset();
    }

    public function getAspirasiByRange($awal, $akhir) {
    // Sekarang query ini nggak bakal error lagi karena kolomnya sudah ada
    $this->db->query("SELECT * FROM input_aspirasi WHERE tgl_pelaporan BETWEEN :awal AND :akhir ORDER BY id_pelaporan DESC");
    $this->db->bind('awal', $awal);
    $this->db->bind('akhir', $akhir);
    return $this->db->resultSet();
}
}