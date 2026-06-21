<?php
// api portofolio dan dukungan oop dengan server-side validation

header('Content-Type: application/json; charset=utf-8');
require_once 'config.php';

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

switch ($action) {

    // tambah portofolio
    case 'create':
        // validasi input sisi server
        if (!isset($_POST['judul']) || empty(trim($_POST['judul']))) {
            echo json_encode(['status' => 'error', 'message' => 'judul proyek tidak boleh kosong.']);
            exit;
        }
        if (!isset($_POST['kategori']) || empty(trim($_POST['kategori']))) {
            echo json_encode(['status' => 'error', 'message' => 'kategori tidak boleh kosong.']);
            exit;
        }
        if (!isset($_POST['lencana']) || empty(trim($_POST['lencana']))) {
            echo json_encode(['status' => 'error', 'message' => 'lencana tidak boleh kosong.']);
            exit;
        }
        if (!isset($_POST['ringkasan']) || empty(trim($_POST['ringkasan']))) {
            echo json_encode(['status' => 'error', 'message' => 'ringkasan tidak boleh kosong.']);
            exit;
        }
        if (!isset($_POST['deskripsi']) || empty(trim($_POST['deskripsi']))) {
            echo json_encode(['status' => 'error', 'message' => 'deskripsi tidak boleh kosong.']);
            exit;
        }
        if (!empty($_POST['video_url']) && !filter_var($_POST['video_url'], FILTER_VALIDATE_URL)) {
            echo json_encode(['status' => 'error', 'message' => 'format url video tidak valid.']);
            exit;
        }

        // validasi file gambar jika diunggah
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedExtensions)) {
                echo json_encode(['status' => 'error', 'message' => 'format gambar tidak didukung. gunakan jpg, jpeg, png, atau gif.']);
                exit;
            }
            $maxSize = 5 * 1024 * 1024; // 5mb
            if ($_FILES['gambar']['size'] > $maxSize) {
                echo json_encode(['status' => 'error', 'message' => 'ukuran gambar terlalu besar. maksimal 5mb.']);
                exit;
            }
        }

        $judul     = $conn->real_escape_string($_POST['judul']);
        $kategori  = $conn->real_escape_string($_POST['kategori']);
        $lencana   = $conn->real_escape_string($_POST['lencana']);
        $ringkasan = $conn->real_escape_string($_POST['ringkasan']);
        $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
        $pencapaian = $conn->real_escape_string($_POST['pencapaian']);
        $video_url = $conn->real_escape_string($_POST['video_url']);
        $waktu_pelaksanaan = !empty($_POST['waktu_pelaksanaan']) ? "'" . $conn->real_escape_string($_POST['waktu_pelaksanaan']) . "'" : "NULL";

        $gambar = 'default.jpg';
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $gambar = 'porto_' . time() . '.' . $ext;
            move_uploaded_file($_FILES['gambar']['tmp_name'], 'img/' . $gambar);
        }

        $sql = "INSERT INTO portofolio (judul, kategori, lencana, ringkasan, deskripsi, pencapaian, gambar, video_url, waktu_pelaksanaan)
                VALUES ('$judul', '$kategori', '$lencana', '$ringkasan', '$deskripsi', '$pencapaian', '$gambar', '$video_url', $waktu_pelaksanaan)";

        if ($conn->query($sql)) {
            echo json_encode(['status' => 'success', 'message' => 'Portofolio berhasil ditambahkan!', 'id' => $conn->insert_id]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal: ' . $conn->error]);
        }
        break;

    // ambil portofolio
    case 'read':
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($id > 0) {
            $sql = "SELECT * FROM portofolio WHERE id = $id";
            $result = $conn->query($sql);
            $data = $result->fetch_assoc();
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            $sql = "SELECT * FROM portofolio ORDER BY created_at DESC";
            $result = $conn->query($sql);
            $items = [];
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
            echo json_encode(['status' => 'success', 'data' => $items]);
        }
        break;

    // update portofolio
    case 'update':
        // validasi input sisi server
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            echo json_encode(['status' => 'error', 'message' => 'id tidak valid untuk diperbarui.']);
            exit;
        }
        if (!isset($_POST['judul']) || empty(trim($_POST['judul']))) {
            echo json_encode(['status' => 'error', 'message' => 'judul proyek tidak boleh kosong.']);
            exit;
        }
        if (!isset($_POST['kategori']) || empty(trim($_POST['kategori']))) {
            echo json_encode(['status' => 'error', 'message' => 'kategori tidak boleh kosong.']);
            exit;
        }
        if (!isset($_POST['lencana']) || empty(trim($_POST['lencana']))) {
            echo json_encode(['status' => 'error', 'message' => 'lencana tidak boleh kosong.']);
            exit;
        }
        if (!isset($_POST['ringkasan']) || empty(trim($_POST['ringkasan']))) {
            echo json_encode(['status' => 'error', 'message' => 'ringkasan tidak boleh kosong.']);
            exit;
        }
        if (!isset($_POST['deskripsi']) || empty(trim($_POST['deskripsi']))) {
            echo json_encode(['status' => 'error', 'message' => 'deskripsi tidak boleh kosong.']);
            exit;
        }
        if (!empty($_POST['video_url']) && !filter_var($_POST['video_url'], FILTER_VALIDATE_URL)) {
            echo json_encode(['status' => 'error', 'message' => 'format url video tidak valid.']);
            exit;
        }

        // validasi file gambar jika diunggah
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileExtension = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $allowedExtensions)) {
                echo json_encode(['status' => 'error', 'message' => 'format gambar tidak didukung. gunakan jpg, jpeg, png, atau gif.']);
                exit;
            }
            $maxSize = 5 * 1024 * 1024; // 5mb
            if ($_FILES['gambar']['size'] > $maxSize) {
                echo json_encode(['status' => 'error', 'message' => 'ukuran gambar terlalu besar. maksimal 5mb.']);
                exit;
            }
        }

        $id        = intval($_POST['id']);
        $judul     = $conn->real_escape_string($_POST['judul']);
        $kategori  = $conn->real_escape_string($_POST['kategori']);
        $lencana   = $conn->real_escape_string($_POST['lencana']);
        $ringkasan = $conn->real_escape_string($_POST['ringkasan']);
        $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
        $pencapaian = $conn->real_escape_string($_POST['pencapaian']);
        $video_url = $conn->real_escape_string($_POST['video_url']);
        $waktu_pelaksanaan = !empty($_POST['waktu_pelaksanaan']) ? "'" . $conn->real_escape_string($_POST['waktu_pelaksanaan']) . "'" : "NULL";

        $gambar_sql = '';
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $gambar = 'porto_' . time() . '.' . $ext;
            move_uploaded_file($_FILES['gambar']['tmp_name'], 'img/' . $gambar);
            $gambar_sql = ", gambar = '$gambar'";
        }

        $sql = "UPDATE portofolio SET
                    judul = '$judul',
                    kategori = '$kategori',
                    lencana = '$lencana',
                    ringkasan = '$ringkasan',
                    deskripsi = '$deskripsi',
                    pencapaian = '$pencapaian',
                    video_url = '$video_url',
                    waktu_pelaksanaan = $waktu_pelaksanaan
                    $gambar_sql
                WHERE id = $id";

        if ($conn->query($sql)) {
            echo json_encode(['status' => 'success', 'message' => 'Portofolio berhasil diperbarui!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal: ' . $conn->error]);
        }
        break;

    // hapus portofolio
    case 'delete':
        $id = intval($_POST['id']);

        // ambil nama gambar
        $result = $conn->query("SELECT gambar FROM portofolio WHERE id = $id");
        $row = $result->fetch_assoc();

        $sql = "DELETE FROM portofolio WHERE id = $id";

        if ($conn->query($sql)) {
            // hapus file gambar jika bukan default
            if ($row && $row['gambar'] !== 'default.jpg' && file_exists('img/' . $row['gambar'])) {
                // jangan hapus gambar bawaan
                $seed_images = ['jemariusang.jpg', 'warisan.jpg', 'aftermovie.jpg', 'gif.jpg', 'stud1.jpg'];
                if (!in_array($row['gambar'], $seed_images)) {
                    unlink('img/' . $row['gambar']);
                }
            }
            echo json_encode(['status' => 'success', 'message' => 'Portofolio berhasil dihapus!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal: ' . $conn->error]);
        }
        break;

    // simpan dukungan
    case 'dukungan':
        // validasi input sisi server
        if (!isset($_POST['nama']) || empty(trim($_POST['nama']))) {
            echo json_encode(['status' => 'error', 'message' => 'nama tidak boleh kosong.']);
            exit;
        }
        // validasi huruf dan spasi saja untuk nama
        if (!preg_match("/^[a-zA-Z\s]*$/", $_POST['nama'])) {
            echo json_encode(['status' => 'error', 'message' => 'nama hanya boleh berisi huruf dan spasi.']);
            exit;
        }

        if (!isset($_POST['email']) || empty(trim($_POST['email']))) {
            echo json_encode(['status' => 'error', 'message' => 'email tidak boleh kosong.']);
            exit;
        }
        // validasi format email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['status' => 'error', 'message' => 'format email tidak valid.']);
            exit;
        }

        if (!isset($_POST['pesan']) || empty(trim($_POST['pesan']))) {
            echo json_encode(['status' => 'error', 'message' => 'pesan dukungan tidak boleh kosong.']);
            exit;
        }

        $nama  = $conn->real_escape_string($_POST['nama']);
        $email = $conn->real_escape_string($_POST['email']);
        $pesan = $conn->real_escape_string($_POST['pesan']);

        $sql = "INSERT INTO dukungan (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";

        if ($conn->query($sql)) {
            echo json_encode(['status' => 'success', 'message' => 'Dukungan berhasil disimpan!', 'nama' => $nama]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal: ' . $conn->error]);
        }
        break;

    // ambil semua dukungan
    case 'read_dukungan':
        $sql = "SELECT * FROM dukungan ORDER BY created_at DESC";
        $result = $conn->query($sql);
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        echo json_encode(['status' => 'success', 'data' => $items]);
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Action tidak valid.']);
        break;
}

$conn->close();
