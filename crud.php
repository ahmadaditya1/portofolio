<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kelola Portofolio — CRUD Manager">
    <title>Kelola Portofolio — CRUD Manager</title>

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

            <div class="nav-center-text">
                <span class="crud-nav-title">KELOLA PORTOFOLIO</span>
            </div>

            <div class="nav-right">
                <a href="index.php" class="nav-icon-btn" title="Kembali ke Portofolio">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </header>

    <main class="crud-main">
        <div class="content-container">

            <!-- form tambah/edit -->
            <div class="crud-form-section" id="crud-form-section">
                <div class="crud-form-header">
                    <h2 class="section-title" id="crud-form-title">TAMBAH PROYEK BARU</h2>
                    <p class="section-subtitle" id="crud-form-subtitle">Isi detail proyek portofolio Anda</p>
                </div>

                <form id="form-portofolio" enctype="multipart/form-data" class="crud-form">
                    <input type="hidden" id="porto-id" name="id" value="">
                    <input type="hidden" id="porto-action" name="action" value="create">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="porto-judul" id="label-judul">Judul Proyek</label>
                            <input type="text" id="porto-judul" name="judul" placeholder="Nama proyek Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="porto-kategori">Kategori</label>
                            <select id="porto-kategori" name="kategori" required>
                                <option value="film">Film & Video</option>
                                <option value="design">Desain Grafis</option>
                                <option value="kepanitiaan">Kepanitiaan</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="porto-lencana" id="label-lencana">Label Lencana</label>
                            <input type="text" id="porto-lencana" name="lencana" placeholder="Film Pendek, Videografi, dll." required>
                        </div>
                        <div class="form-group" id="group-pencapaian">
                            <label for="porto-pencapaian">Pencapaian</label>
                            <input type="text" id="porto-pencapaian" name="pencapaian" placeholder="🏆 Juara 1 Lomba...">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="porto-waktu">Waktu Pelaksanaan</label>
                        <input type="date" id="porto-waktu" name="waktu_pelaksanaan">
                    </div>

                    <div class="form-group">
                        <label for="porto-ringkasan" id="label-ringkasan">Ringkasan Singkat</label>
                        <textarea id="porto-ringkasan" name="ringkasan" rows="2" placeholder="Deskripsi singkat proyek..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="porto-deskripsi" id="label-deskripsi">Deskripsi Lengkap</label>
                        <textarea id="porto-deskripsi" name="deskripsi" rows="4" placeholder="Ceritakan proyek ini secara detail..." required></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="porto-gambar">Gambar Proyek</label>
                            <input type="file" id="porto-gambar" name="gambar" accept="image/*">
                            <span class="form-hint" id="hint-gambar">Format: JPG, PNG. Maks 5MB.</span>
                        </div>
                        <div class="form-group" id="group-video">
                            <label for="porto-video">URL Video Embed</label>
                            <input type="url" id="porto-video" name="video_url" placeholder="https://youtube.com/embed/...">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-pill btn-pill-primary" id="btn-submit-porto">
                            <i class="fa-solid fa-plus"></i> Tambah Proyek
                        </button>
                        <button type="button" class="btn-pill btn-pill-secondary" id="btn-reset-form" style="display: none;">
                            Batal Edit
                        </button>
                    </div>
                </form>
            </div>

            <!-- tabel data -->
            <div class="crud-table-section">
                <div class="crud-table-header">
                    <h2 class="section-title">DATA PORTOFOLIO</h2>
                    <span class="item-count" id="total-items">0 item</span>
                </div>

                <div class="table-wrapper">
                    <table class="data-table" id="tabel-portofolio">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Pencapaian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-portofolio">
                            <tr>
                                <td colspan="6" class="table-empty">
                                    <i class="fa-solid fa-spinner fa-spin"></i> Memuat data...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- pesan dukungan -->
            <div class="crud-table-section">
                <div class="crud-table-header">
                    <h2 class="section-title">PESAN DUKUNGAN</h2>
                    <span class="item-count" id="total-dukungan">0 pesan</span>
                </div>

                <div class="table-wrapper">
                    <table class="data-table" id="tabel-dukungan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pesan</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-dukungan">
                            <tr>
                                <td colspan="5" class="table-empty">
                                    <i class="fa-solid fa-spinner fa-spin"></i> Memuat data...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <!-- modal konfirmasi hapus -->
    <div class="modal-overlay" id="modal-hapus" aria-hidden="true" role="dialog">
        <div class="modal-card modal-card-small">
            <button class="modal-close-btn" id="btn-batal-hapus" aria-label="Tutup Modal">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="thankyou-content">
                <div class="thankyou-icon" style="background-color: rgba(211, 0, 5, 0.08); color: #d30005;">
                    <i class="fa-solid fa-trash-can"></i>
                </div>
                <h3 class="thankyou-title">Hapus Proyek?</h3>
                <p class="thankyou-text">Proyek "<span id="nama-hapus"></span>" akan dihapus secara permanen.</p>
                <div style="display: flex; gap: 12px; width: 100%;">
                    <button class="btn-pill btn-pill-secondary" id="btn-cancel-delete" style="flex:1;">Batal</button>
                    <button class="btn-pill btn-pill-danger" id="btn-confirm-delete" style="flex:1;">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- toast notification -->
    <div class="toast-container" id="toast-container"></div>

    <script src="crud.js"></script>
    <script>
    // label form dinamis berdasarkan kategori
    $(document).ready(function() {
        const defaults = {
            judul: { label: 'Judul Proyek', placeholder: 'Nama proyek Anda' },
            lencana: { label: 'Label Lencana', placeholder: 'Film Pendek, Videografi, dll.' },
            ringkasan: { label: 'Ringkasan Singkat', placeholder: 'Deskripsi singkat proyek...' },
            deskripsi: { label: 'Deskripsi Lengkap', placeholder: 'Ceritakan proyek ini secara detail...' }
        };

        const kepanitiaan = {
            judul: { label: 'Nama Kepanitiaan', placeholder: 'Nama kepanitiaan / acara' },
            lencana: { label: 'Peran/Jabatan', placeholder: 'Koordinator, Ketua Divisi, dll.' },
            ringkasan: { label: 'Deskripsi Singkat Acara', placeholder: 'Deskripsi singkat acara kepanitiaan...' },
            deskripsi: { label: 'Deskripsi Lengkap', placeholder: 'Jelaskan apa tugas yang Anda lakukan dan apa efeknya...' }
        };

        $('#porto-kategori').on('change', function() {
            const val = $(this).val();
            const cfg = val === 'kepanitiaan' ? kepanitiaan : defaults;

            $('#label-judul').text(cfg.judul.label);
            $('#porto-judul').attr('placeholder', cfg.judul.placeholder);

            $('#label-lencana').text(cfg.lencana.label);
            $('#porto-lencana').attr('placeholder', cfg.lencana.placeholder);

            $('#label-ringkasan').text(cfg.ringkasan.label);
            $('#porto-ringkasan').attr('placeholder', cfg.ringkasan.placeholder);

            $('#label-deskripsi').text(cfg.deskripsi.label);
            $('#porto-deskripsi').attr('placeholder', cfg.deskripsi.placeholder);

            // sembunyikan pencapaian dan video untuk kepanitiaan
            if (val === 'kepanitiaan') {
                $('#group-pencapaian').hide();
                $('#group-video').hide();
            } else {
                $('#group-pencapaian').show();
                $('#group-video').show();
            }
        });
    });
    </script>
</body>
</html>
