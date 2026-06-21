<?php
// koneksi database mysql oop

// kelas database untuk enkapsulasi koneksi
class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $pass = ''; // default laragon tanpa password
    private $name = 'portofolio_aditya';
    public $conn;

    // constructor untuk membuat koneksi saat objek diinstansiasi
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name);
        
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
        
        $this->conn->set_charset("utf8mb4");
    }

    // method untuk menjalankan query sql
    public function query($sql) {
        return $this->conn->query($sql);
    }

    // method untuk mengamankan string input
    public function escape($string) {
        return $this->conn->real_escape_string($string);
    }

    // method untuk menutup koneksi
    public function close() {
        $this->conn->close();
    }
}

// instansiasi objek dari kelas database
$db = new Database();
$conn = $db->conn; // diekspos untuk kompatibilitas mysql menggunakan mysqli oop native
