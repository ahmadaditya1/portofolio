-- database setup untuk portofolio aditya

CREATE DATABASE IF NOT EXISTS portofolio_aditya
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE portofolio_aditya;

-- tabel utama untuk item portofolio
CREATE TABLE IF NOT EXISTS portofolio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    kategori ENUM('film', 'design', 'kepanitiaan') NOT NULL DEFAULT 'film',
    lencana VARCHAR(100) NOT NULL DEFAULT 'Proyek',
    ringkasan TEXT NOT NULL,
    deskripsi TEXT NOT NULL,
    pencapaian VARCHAR(255) DEFAULT NULL,
    gambar VARCHAR(255) DEFAULT 'default.jpg',
    video_url VARCHAR(500) DEFAULT NULL,
    waktu_pelaksanaan DATE DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- tabel untuk pesan dukungan
CREATE TABLE IF NOT EXISTS dukungan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    pesan TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- data awal

INSERT INTO portofolio (judul, kategori, lencana, ringkasan, deskripsi, pencapaian, gambar, video_url) VALUES
(
    'Film Pendek: Jemari Usang',
    'film',
    'Film Pendek',
    'Juara 3 Film Pendek FLS2N 2023 Provinsi Jawa Timur. Mengisahkan perjuangan seorang orang tua.',
    'Jemari Usang merupakan karya film pendek setiap orang tua akan berkorban apapun dari hal besar maupun kecil demi prestasi dan kebahagiaan anaknya, meskipun dengan kondisi keluarga yang sederhana. Lewat pembelajaran di kelas tentang adab atau akhlak, sang anak teringat semua jerih payah sang emak agar ia dapat berprestasi dan bersekolah pada umumnya. Prestasi tertinggi ialah dimana kita bisa berbarengan mengedepankan ilmu and adab dalam penerapan hidup kita.',
    '🏆 Juara 3 FLS2N Provinsi Jawa Timur 2023',
    'jemariusang.jpg',
    'https://www.youtube.com/embed/ugjf2Ie7J_M'
),
(
    'Film Pendek: Warisan',
    'film',
    'Film Pendek',
    'Juara 2 Film Pendek FLS2N 2022 Provinsi Jawa Timur. Kisah tentang pencarian makna warisan keluarga yang menyentuh.',
    'Warisan disini mempunyai arti khusus yakni warisan kain batik peninggalan dari Ibu si pemain. Kain Batik yang digunakan sang ayah untuk membuat baju batik berasal dari bekas penutup jenazah sang ibu yang sudah meninggal.',
    '🏆 Juara 2 FLS2N Provinsi Jawa Timur 2022',
    'warisan.jpg',
    'https://www.youtube.com/embed/XZuUHl8WnVE'
),
(
    'Videografi: Aftermovie Event',
    'film',
    'Videografi',
    'Dokumentasi video sinematik dengan editing dinamis dan transisi modern untuk event besar kampus.',
    'Proyek dokumentasi video berskala besar (1.3GB+) yang mencakup perayaan PKKMB Fatisda. Dikerjakan dengan gaya editing berkecepatan tinggi, pencocokan ketukan audio (audio beat-matching), koreksi warna profesional, serta transisi mulus yang menyampaikan energi meriah secara maksimal.',
    '🎥 Event Aftermovie Production',
    'aftermovie.jpg',
    NULL
),
(
    'Motion Graphic: PKKMB 2025',
    'design',
    'Grafis Bergerak',
    'Animasi GIF & grafis transisi modern untuk kegiatan pengenalan kampus mahasiswa baru 2025.',
    'Desain grafis bergerak (motion asset) yang dinamis untuk PKKMB Fatisda.',
    '⚡ Official Media Asset PKKMB 2025',
    'gif.jpg',
    NULL
),
(
    'Visual Design: STUDEX Express',
    'design',
    'Desain Grafis',
    'Identitas visual komprehensif (STUDEX 9 - 17) untuk instagram.',
    'Seri desain grafis publikasi instagram',
    '✨ Visual Branding Instagram',
    'stud1.jpg',
    NULL
);
