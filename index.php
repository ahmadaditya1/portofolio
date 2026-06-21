<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portofolio Ahmad Aditya Nugraha — Kreator visual, pembuat film, dan desainer grafis">
    <title>Ahmad Aditya Nugraha — Portofolio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

    <!-- navigasi utama -->
    <header class="primary-nav" id="primary-nav">
        <div class="nav-container">

            <nav class="nav-center" id="nav-center">
                <ul class="nav-list">
                    <li><a href="#beranda" class="nav-link active" id="link-beranda">Beranda</a></li>
                    <li><a href="#tentang" class="nav-link" id="link-tentang">Tentang</a></li>
                    <li><a href="#portofolio" class="nav-link" id="link-portofolio">Portofolio</a></li>
                    <li><a href="#dukungan" class="nav-link" id="link-dukungan">Dukungan</a></li>
                </ul>
            </nav>

            <div class="nav-right">
                <a href="crud.php" class="nav-icon-btn" id="nav-manage-btn" title="Tambah Portofolio">
                    <i class="fa-solid fa-plus"></i>
                </a>
                <button class="nav-toggle" id="toggle-menu" aria-label="Toggle Navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <main>

        <!-- beranda -->
        <section id="beranda" class="campaign-hero">
            <div class="campaign-overlay">
                <div class="campaign-content">
                    <h1 class="campaign-headline">
                        ADITYA<br>NUGRAHA
                    </h1>
                    <p class="campaign-subtitle">
                        Mahasiswa UNS · <span class="typing-text" id="teks-peran">Kreator Visual & Pembuat Film</span>
                    </p>
                    <div class="campaign-cta">
                        <a href="#portofolio" class="btn-pill btn-pill-primary" id="tombol-lihat-karya">
                            Lihat Karya <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="#dukungan" class="btn-pill btn-pill-outline" id="tombol-beri-dukungan">
                            Beri Dukungan
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- tentang saya -->
        <section id="tentang" class="section">
            <div class="content-container">
                <div class="section-header">
                    <h2 class="section-title">TENTANG SAYA</h2>
                </div>

                <div class="about-grid">
                    <div class="about-text">
                        <p class="body-text">
                            Halo! Saya <strong>Ahmad Aditya Nugraha</strong>. Saya adalah seorang mahasiswa UNS jurusan Informatika angkatan 2024 yang memiliki minat pada bidang kreator visual, pembuat film, dan desainer grafis. Saya suka menggabungkan keindahan estetika dengan fungsionalitas untuk menceritakan kisah yang memikat.
                        </p>
                        <p class="body-text">
                            Dengan ketertarikan mendalam dalam dunia sinematografi dan desain visual, saya telah menyutradarai beberapa proyek film pendek yang berhasil meraih penghargaan di kompetisi tingkat provinsi.
                        </p>

                        <div class="awards-section">
                            <h3 class="awards-title"><i class="fa-solid fa-trophy"></i> Penghargaan Utama</h3>
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-content">
                                        <span class="timeline-year">2023</span>
                                        <h4>Juara 3 Film Pendek FLS2N</h4>
                                        <p>Tingkat Provinsi Jawa Timur — <strong>"Jemari Usang"</strong></p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-content">
                                        <span class="timeline-year">2022</span>
                                        <h4>Juara 2 Film Pendek FLS2N</h4>
                                        <p>Tingkat Provinsi Jawa Timur — <strong>"Warisan"</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-card">
                            <span class="stat-number">3+</span>
                            <span class="stat-label">Tahun Pengalaman</span>
                        </div>
                        <div class="stat-card">
                            <span class="stat-number">12+</span>
                            <span class="stat-label">Proyek Selesai</span>
                        </div>
                        <div class="stat-card">
                            <span class="stat-number">2×</span>
                            <span class="stat-label">Pemenang FLS2N</span>
                        </div>
                        <div class="stat-card">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Semangat</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- portofolio -->
        <section id="portofolio" class="section">
            <div class="content-container">
                <div class="section-header">
                    <h2 class="section-title">PORTOFOLIO</h2>
                </div>

                <div class="filter-container">
                    <button class="filter-chip active" data-filter="all" id="filter-semua">Semua</button>
                    <button class="filter-chip" data-filter="film" id="filter-film">Film & Video</button>
                    <button class="filter-chip" data-filter="design" id="filter-desain">Desain Grafis</button>
                    <button class="filter-chip" data-filter="kepanitiaan" id="filter-kepanitiaan">Kepanitiaan</button>
                </div>

                <div class="product-grid" id="portfolio-items">
                    <!-- diisi oleh javascript via ajax -->
                    <div class="loading-state" style="grid-column: 1/-1; text-align: center; padding: 60px 0;">
                        <i class="fa-solid fa-spinner fa-spin" style="font-size: 24px; color: var(--mute);"></i>
                        <p style="margin-top: 12px; color: var(--mute); font-size: 14px;">Memuat portofolio...</p>
                    </div>
                </div>
            </div>
        </section>


        <!-- dukungan -->
        <section id="dukungan" class="section">
            <div class="content-container">
                <div class="section-header">
                    <h2 class="section-title">BERIKAN DUKUNGAN</h2>
                    <p class="section-subtitle">Tinggalkan pesan dukungan, kesan, atau kritik membangun untuk menyemangati perjalanan kreatif saya.</p>
                </div>

                <div class="support-layout">
                    <div class="support-form-panel">
                        <form id="form-dukungan">
                            <div class="form-group">
                                <label for="nama-dukungan">Nama Lengkap</label>
                                <input type="text" id="nama-dukungan" name="name" placeholder="Masukkan nama Anda" required>
                            </div>

                            <div class="form-group">
                                <label for="email-dukungan">Alamat Email</label>
                                <input type="email" id="email-dukungan" name="email" placeholder="contoh@mail.com" required>
                            </div>

                            <div class="form-group">
                                <label for="pesan-dukungan">Kata-kata Pendukung</label>
                                <textarea id="pesan-dukungan" name="message" rows="5" placeholder="Tuliskan pesan penyemangat Anda..." required></textarea>
                            </div>

                            <button type="submit" class="btn-pill btn-pill-primary btn-full" id="tombol-kirim-dukungan">
                                Kirim Dukungan <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>

                    <div class="support-messages-panel" id="panel-pesan-dukungan">
                        <h3 class="messages-title">Pesan Terbaru</h3>
                        <div class="messages-list" id="daftar-pesan-dukungan">
                            <!-- diisi oleh javascript -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- footer -->
    <footer class="site-footer">
        <div class="content-container">
            <div class="footer-bottom">
                <p class="footer-legal">© 2025 Ahmad Aditya Nugraha. Praktikum Pemrograman Web — UNS.</p>
            </div>
        </div>
    </footer>

    <!-- modal detail portofolio -->
    <div class="modal-overlay" id="modal-detail" aria-hidden="true" role="dialog">
        <div class="modal-card">
            <button class="modal-close-btn" id="tombol-tutup-detail" aria-label="Tutup Modal">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="modal-grid">
                <div class="modal-visual" id="wadah-media-modal"></div>
                <div class="modal-info">
                    <div class="modal-meta">
                        <span class="modal-tag" id="tag-kat-modal">Film & Video</span>
                        <span class="modal-achievement" id="tag-prestasi-modal">🏆 Juara 3 FLS2N</span>
                    </div>
                    <h3 id="judul-modal" class="modal-title">Nama Proyek</h3>
                    <div class="modal-desc-scroll">
                        <p id="deskripsi-modal" class="modal-desc">Deskripsi proyek...</p>
                    </div>
                    <div class="modal-cta">
                        <a href="#dukungan" class="btn-pill btn-pill-primary btn-full modal-support-btn" id="tombol-diskusi-modal">
                            Berikan Dukungan <i class="fa-solid fa-heart"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal terima kasih -->
    <div class="modal-overlay" id="modal-terimakasih" aria-hidden="true" role="dialog">
        <div class="modal-card modal-card-small">
            <button class="modal-close-btn" id="tombol-tutup-terimakasih" aria-label="Tutup Modal">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="thankyou-content">
                <div class="thankyou-icon">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h3 class="thankyou-title">Dukungan Diterima!</h3>
                <p class="thankyou-text" id="teks-pesan-terimakasih">Terimakasih telah mendukung...</p>
                <button class="btn-pill btn-pill-primary btn-full" id="tombol-oke-terimakasih">Tutup</button>
            </div>
        </div>
    </div>



    <!-- toast notification -->
    <div class="toast-container" id="toast-container"></div>

    <script src="script.js"></script>
</body>
</html>
