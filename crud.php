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

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ink: '#111111',
                        canvas: '#ffffff',
                        'soft-cloud': '#f5f5f5',
                        charcoal: '#39393b',
                        ash: '#4b4b4d',
                        mute: '#707072',
                        stone: '#9e9ea0',
                        hairline: '#cacacb',
                        'hairline-soft': '#e5e5e5',
                        sale: '#d30005',
                        'sale-deep': '#780700',
                        success: '#007d48',
                        'success-bright': '#1eaa52',
                        info: '#1151ff',
                    },
                    fontFamily: {
                        display: ['Anton', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                    },
                    borderRadius: {
                        'sm': '18px',
                        'md': '24px',
                        'lg': '30px',
                    },
                    transitionTimingFunction: {
                        'smooth': 'cubic-bezier(0.16, 1, 0.3, 1)',
                    }
                }
            }
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <!-- navigasi utama -->
    <header class="sticky top-0 left-0 w-full z-[100] bg-canvas h-[60px] flex items-center border-b border-hairline-soft transition-all duration-350 ease-smooth" id="primary-nav">
        <div class="w-full max-w-[1440px] mx-auto px-6 flex justify-between items-center">

            <div class="flex-grow flex justify-center">
                <span class="font-body text-sm font-semibold tracking-[1.5px] text-ink uppercase">KELOLA PORTOFOLIO</span>
            </div>

            <div class="flex items-center gap-3">
                <a href="index.php" class="w-10 h-10 rounded-full bg-soft-cloud text-ink flex items-center justify-center text-base hover:bg-ink hover:text-canvas transition-all duration-200" title="Kembali ke Portofolio">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </header>


    </header>

    <main class="py-12 min-h-screen">
        <div class="w-full max-w-[1440px] mx-auto px-6">

            <!-- form tambah/edit -->
            <div class="bg-soft-cloud p-10 mb-12 max-[599px]:px-4 max-[599px]:py-6" id="crud-form-section">
                <div class="mb-[30px]">
                    <h2 class="font-display text-[clamp(28px,4vw,40px)] font-normal leading-[1.1] tracking-[1px] uppercase text-ink mb-2" id="crud-form-title">TAMBAH PROYEK BARU</h2>
                    <p class="text-base text-mute max-w-[600px] leading-normal" id="crud-form-subtitle">Isi detail proyek portofolio Anda</p>
                </div>

                <form id="form-portofolio" enctype="multipart/form-data">
                    <input type="hidden" id="porto-id" name="id" value="">
                    <input type="hidden" id="porto-action" name="action" value="create">

                    <div class="grid grid-cols-2 gap-4 max-lg:grid-cols-1">
                        <div class="mb-5">
                            <label for="porto-judul" class="block text-sm font-medium text-ink mb-2" id="label-judul">Judul Proyek</label>
                            <input type="text" id="porto-judul" class="w-full px-4 py-3 bg-canvas border border-hairline rounded-none text-ink font-body text-base transition-all duration-200 focus:outline-none focus:border-ink focus:shadow-[0_0_0_2px_rgba(17,17,17,0.1)] placeholder-stone" name="judul" placeholder="Nama proyek Anda" required>
                        </div>
                        <div class="mb-5">
                            <label for="porto-kategori" class="block text-sm font-medium text-ink mb-2">Kategori</label>
                            <select id="porto-kategori" class="w-full px-4 py-3 bg-canvas border border-hairline rounded-none text-ink font-body text-base transition-all duration-200 focus:outline-none focus:border-ink focus:shadow-[0_0_0_2px_rgba(17,17,17,0.1)] placeholder-stone" name="kategori" required>
                                <option value="film">Film & Video</option>
                                <option value="design">Desain Grafis</option>
                                <option value="kepanitiaan">Kepanitiaan</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 max-lg:grid-cols-1">
                        <div class="mb-5">
                            <label for="porto-lencana" class="block text-sm font-medium text-ink mb-2" id="label-lencana">Label Lencana</label>
                            <input type="text" id="porto-lencana" class="w-full px-4 py-3 bg-canvas border border-hairline rounded-none text-ink font-body text-base transition-all duration-200 focus:outline-none focus:border-ink focus:shadow-[0_0_0_2px_rgba(17,17,17,0.1)] placeholder-stone" name="lencana" placeholder="Film Pendek, Videografi, dll." required>
                        </div>
                        <div class="mb-5" id="group-pencapaian">
                            <label for="porto-pencapaian" class="block text-sm font-medium text-ink mb-2">Pencapaian</label>
                            <input type="text" id="porto-pencapaian" class="w-full px-4 py-3 bg-canvas border border-hairline rounded-none text-ink font-body text-base transition-all duration-200 focus:outline-none focus:border-ink focus:shadow-[0_0_0_2px_rgba(17,17,17,0.1)] placeholder-stone" name="pencapaian" placeholder="🏆 Juara 1 Lomba...">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="porto-waktu" class="block text-sm font-medium text-ink mb-2">Waktu Pelaksanaan</label>
                        <input type="date" id="porto-waktu" class="w-full px-4 py-3 bg-canvas border border-hairline rounded-none text-ink font-body text-base transition-all duration-200 focus:outline-none focus:border-ink focus:shadow-[0_0_0_2px_rgba(17,17,17,0.1)] placeholder-stone" name="waktu_pelaksanaan">
                    </div>

                    <div class="mb-5">
                        <label for="porto-ringkasan" class="block text-sm font-medium text-ink mb-2" id="label-ringkasan">Ringkasan Singkat</label>
                        <textarea id="porto-ringkasan" class="w-full px-4 py-3 bg-canvas border border-hairline rounded-none text-ink font-body text-base transition-all duration-200 focus:outline-none focus:border-ink focus:shadow-[0_0_0_2px_rgba(17,17,17,0.1)] placeholder-stone" name="ringkasan" rows="2" placeholder="Deskripsi singkat proyek..." required></textarea>
                    </div>

                    <div class="mb-5">
                        <label for="porto-deskripsi" class="block text-sm font-medium text-ink mb-2" id="label-deskripsi">Deskripsi Lengkap</label>
                        <textarea id="porto-deskripsi" class="w-full px-4 py-3 bg-canvas border border-hairline rounded-none text-ink font-body text-base transition-all duration-200 focus:outline-none focus:border-ink focus:shadow-[0_0_0_2px_rgba(17,17,17,0.1)] placeholder-stone" name="deskripsi" rows="4" placeholder="Ceritakan proyek ini secara detail..." required></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 max-lg:grid-cols-1">
                        <div class="mb-5">
                            <label for="porto-gambar" class="block text-sm font-medium text-ink mb-2">Gambar Proyek</label>
                            <input type="file" id="porto-gambar" class="w-full px-4 py-3 bg-canvas border border-hairline rounded-none text-ink font-body text-base transition-all duration-200 focus:outline-none focus:border-ink focus:shadow-[0_0_0_2px_rgba(17,17,17,0.1)] placeholder-stone" name="gambar" accept="image/*">
                            <span class="text-xs text-mute mt-1 block" id="hint-gambar">Format: JPG, PNG. Maks 5MB.</span>
                        </div>
                        <div class="mb-5" id="group-video">
                            <label for="porto-video" class="block text-sm font-medium text-ink mb-2">URL Video Embed</label>
                            <input type="url" id="porto-video" class="w-full px-4 py-3 bg-canvas border border-hairline rounded-none text-ink font-body text-base transition-all duration-200 focus:outline-none focus:border-ink focus:shadow-[0_0_0_2px_rgba(17,17,17,0.1)] placeholder-stone" name="video_url" placeholder="https://youtube.com/embed/...">
                        </div>
                    </div>

                    <div class="flex gap-3 mt-6">
                        <button type="submit" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full text-base font-medium leading-normal cursor-pointer transition-all duration-350 ease-smooth bg-ink text-canvas hover:bg-charcoal hover:scale-[1.02] active:scale-[0.97] active:opacity-80" id="btn-submit-porto">
                            <i class="fa-solid fa-plus"></i> Tambah Proyek
                        </button>
                        <button type="button" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full text-base font-medium leading-normal cursor-pointer transition-all duration-350 ease-smooth bg-soft-cloud text-ink hover:bg-hairline-soft" id="btn-reset-form" style="display: none;">
                            Batal Edit
                        </button>
                    </div>
                </form>
            </div>

            <!-- tabel data -->
            <div class="mb-12">
                <div class="flex justify-between items-baseline mb-6">
                    <h2 class="font-display text-[clamp(28px,4vw,40px)] font-normal leading-[1.1] tracking-[1px] uppercase text-ink mb-2">DATA PORTOFOLIO</h2>
                    <span class="text-sm font-medium text-mute" id="total-items">0 item</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse" id="tabel-portofolio">
                        <thead>
                            <tr>
                                <th class="text-left p-3.5 px-6 text-xs font-semibold uppercase tracking-[0.5px] text-mute border-b-2 border-ink">No</th>
                                <th class="text-left p-3.5 px-6 text-xs font-semibold uppercase tracking-[0.5px] text-mute border-b-2 border-ink">Gambar</th>
                                <th class="text-left p-3.5 px-6 text-xs font-semibold uppercase tracking-[0.5px] text-mute border-b-2 border-ink">Judul</th>
                                <th class="text-left p-3.5 px-6 text-xs font-semibold uppercase tracking-[0.5px] text-mute border-b-2 border-ink">Kategori</th>
                                <th class="text-left p-3.5 px-6 text-xs font-semibold uppercase tracking-[0.5px] text-mute border-b-2 border-ink">Pencapaian</th>
                                <th class="text-left p-3.5 px-6 text-xs font-semibold uppercase tracking-[0.5px] text-mute border-b-2 border-ink">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-portofolio">
                            <tr>
                                <td colspan="6" class="text-center p-10 text-mute col-span-full">
                                    <i class="fa-solid fa-spinner fa-spin"></i> Memuat data...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- pesan dukungan -->
            <div class="mb-12">
                <div class="flex justify-between items-baseline mb-6">
                    <h2 class="font-display text-[clamp(28px,4vw,40px)] font-normal leading-[1.1] tracking-[1px] uppercase text-ink mb-2">PESAN DUKUNGAN</h2>
                    <span class="text-sm font-medium text-mute" id="total-dukungan">0 pesan</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse" id="tabel-dukungan">
                        <thead>
                            <tr>
                                <th class="text-left p-3.5 px-6 text-xs font-semibold uppercase tracking-[0.5px] text-mute border-b-2 border-ink">No</th>
                                <th class="text-left p-3.5 px-6 text-xs font-semibold uppercase tracking-[0.5px] text-mute border-b-2 border-ink">Nama</th>
                                <th class="text-left p-3.5 px-6 text-xs font-semibold uppercase tracking-[0.5px] text-mute border-b-2 border-ink">Email</th>
                                <th class="text-left p-3.5 px-6 text-xs font-semibold uppercase tracking-[0.5px] text-mute border-b-2 border-ink">Pesan</th>
                                <th class="text-left p-3.5 px-6 text-xs font-semibold uppercase tracking-[0.5px] text-mute border-b-2 border-ink">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-dukungan">
                            <tr>
                                <td colspan="5" class="text-center p-10 text-mute col-span-full">
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
    <div class="fixed inset-0 z-[1000] bg-black/60 backdrop-blur-sm hidden justify-center items-center p-5 modal-overlay" id="modal-hapus" aria-hidden="true" role="dialog">
        <div class="w-full max-w-[460px] overflow-hidden relative bg-canvas modal-card">
            <button class="absolute top-4 right-4 w-10 h-10 rounded-full bg-soft-cloud text-ink flex items-center justify-center text-base cursor-pointer z-10 border-none transition-all duration-200 hover:bg-ink hover:text-canvas" id="btn-batal-hapus" aria-label="Tutup Modal">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="p-12 text-center flex flex-col items-center">
                <div class="w-18 h-18 rounded-full flex items-center justify-center text-3xl mb-6 bg-[rgba(211,0,5,0.08)] text-sale p-4">
                    <i class="fa-solid fa-trash-can"></i>
                </div>
                <h3 class="font-display text-2xl font-normal text-ink mb-2 uppercase">Hapus Proyek?</h3>
                <p class="text-sm text-mute leading-relaxed mb-6">Proyek "<span id="nama-hapus"></span>" akan dihapus secara permanen.</p>
                <div class="flex gap-3 w-full">
                    <button class="flex-grow inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full text-base font-medium leading-normal cursor-pointer transition-all duration-350 ease-smooth bg-soft-cloud text-ink hover:bg-hairline-soft" id="btn-cancel-delete">Batal</button>
                    <button class="flex-grow inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full text-base font-medium leading-normal cursor-pointer transition-all duration-350 ease-smooth bg-sale text-canvas hover:bg-sale-deep" id="btn-confirm-delete">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- toast notification -->
    <div class="fixed bottom-6 right-6 z-[9999] flex flex-col gap-2" id="toast-container"></div>

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
