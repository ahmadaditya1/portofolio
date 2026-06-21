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

            <nav class="flex-grow flex justify-center max-md:fixed max-md:top-[60px] max-md:left-0 max-md:w-full max-md:bg-canvas max-md:border-b max-md:border-hairline-soft max-md:py-6 max-md:hidden max-md:z-[99]" id="nav-center">
                <ul class="flex gap-6 max-md:flex-col max-md:items-center max-md:gap-6">
                    <li><a href="#beranda" class="nav-link text-base font-medium text-ink hover:text-mute active" id="link-beranda">Beranda</a></li>
                    <li><a href="#tentang" class="nav-link text-base font-medium text-ink hover:text-mute" id="link-tentang">Tentang</a></li>
                    <li><a href="#portofolio" class="nav-link text-base font-medium text-ink hover:text-mute" id="link-portofolio">Portofolio</a></li>
                    <li><a href="#dukungan" class="nav-link text-base font-medium text-ink hover:text-mute" id="link-dukungan">Dukungan</a></li>
                </ul>
            </nav>

            <div class="flex items-center gap-3">
                <a href="crud.php" class="w-10 h-10 rounded-full bg-soft-cloud text-ink flex items-center justify-center text-base hover:bg-ink hover:text-canvas transition-all duration-200" id="nav-manage-btn" title="Tambah Portofolio">
                    <i class="fa-solid fa-plus"></i>
                </a>
                <button class="hidden max-md:flex w-10 h-10 rounded-full bg-soft-cloud text-ink text-lg items-center justify-center transition-all duration-200" id="toggle-menu" aria-label="Toggle Navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </header>
    <main>
        <!-- beranda -->
        <section id="beranda" class="relative min-h-[90vh] bg-ink flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_20%_50%,rgba(17,17,17,0.3)_0%,transparent_70%)] bg-[radial-gradient(ellipse_at_80%_20%,rgba(113,113,113,0.15)_0%,transparent_50%)] z-[1] pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-full h-[200px] bg-gradient-to-t from-ink to-transparent z-[1] pointer-events-none"></div>
            
            <div class="relative z-[2] w-full max-w-[1440px] mx-auto px-6">
                <div class="max-w-[800px]">
                    <h1 class="font-display text-[clamp(64px,10vw,120px)] font-normal leading-[0.9] tracking-[2px] uppercase text-canvas mb-6">
                        ADITYA<br>NUGRAHA
                    </h1>
                    <p class="text-lg font-normal text-stone mb-10 leading-normal">
                        Mahasiswa UNS · <span class="typing-text text-canvas font-medium relative" id="teks-peran">Kreator Visual & Pembuat Film</span>
                    </p>
                    <div class="flex gap-3 flex-wrap max-md:flex-col">
                        <a href="#portofolio" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full text-base font-medium leading-normal cursor-pointer transition-all duration-350 ease-smooth bg-canvas text-ink hover:bg-soft-cloud hover:scale-[1.02] active:scale-[0.97] active:opacity-80 max-md:w-full" id="tombol-lihat-karya">
                            Lihat Karya <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="#dukungan" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full text-base font-medium leading-normal cursor-pointer transition-all duration-350 ease-smooth border border-canvas text-canvas hover:bg-canvas hover:text-ink hover:scale-[1.02] active:scale-[0.97] active:opacity-80 max-md:w-full" id="tombol-beri-dukungan">
                            Beri Dukungan
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- tentang saya -->
        <section id="tentang" class="py-12">
            <div class="w-full max-w-[1440px] mx-auto px-6">
                <div class="mb-12">
                    <h2 class="font-display text-[clamp(28px,4vw,40px)] font-normal leading-[1.1] tracking-[1px] uppercase text-ink mb-2">TENTANG SAYA</h2>
                </div>

                <div class="grid grid-cols-[1.3fr_1fr] gap-12 items-start max-lg:grid-cols-1 max-lg:gap-8">
                    <div class="about-text">
                        <p class="text-base text-charcoal leading-relaxed mb-5">
                            Halo! Saya <strong>Ahmad Aditya Nugraha</strong>. Saya adalah seorang mahasiswa UNS jurusan Informatika angkatan 2024 yang memiliki minat pada bidang kreator visual, pembuat film, dan desainer grafis. Saya suka menggabungkan keindahan estetika dengan fungsionalitas untuk menceritakan kisah yang memikat.
                        </p>
                        <p class="text-base text-charcoal leading-relaxed mb-5">
                            Dengan ketertarikan mendalam dalam dunia sinematografi dan desain visual, saya telah menyutradarai beberapa proyek film pendek yang berhasil meraih penghargaan di kompetisi tingkat provinsi.
                        </p>

                        <div class="mt-[30px] pt-6 border-t border-hairline">
                            <h3 class="font-body text-base font-semibold text-ink mb-6 flex items-center gap-2"><i class="fa-solid fa-trophy text-amber-500"></i> Penghargaan Utama</h3>
                            <div class="relative pl-6 border-l-2 border-hairline flex flex-col gap-6">
                                <div class="relative">
                                    <div class="absolute left-[-33px] top-1 w-4 h-4 rounded-full bg-canvas border-3 border-ink"></div>
                                    <div class="timeline-content">
                                        <span class="text-xs font-semibold text-mute uppercase tracking-[0.5px] mb-1 inline-block">2023</span>
                                        <h4 class="text-base font-semibold text-ink mb-0.5">Juara 3 Film Pendek FLS2N</h4>
                                        <p class="text-sm text-mute">Tingkat Provinsi Jawa Timur — <strong>"Jemari Usang"</strong></p>
                                    </div>
                                </div>
                                <div class="relative">
                                    <div class="absolute left-[-33px] top-1 w-4 h-4 rounded-full bg-canvas border-3 border-ink"></div>
                                    <div class="timeline-content">
                                        <span class="text-xs font-semibold text-mute uppercase tracking-[0.5px] mb-1 inline-block">2022</span>
                                        <h4 class="text-base font-semibold text-ink mb-0.5">Juara 2 Film Pendek FLS2N</h4>
                                        <p class="text-sm text-mute">Tingkat Provinsi Jawa Timur — <strong>"Warisan"</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div class="bg-soft-cloud py-6 px-[18px] text-center transition-all duration-200 hover:bg-ink group">
                            <span class="block font-display text-[42px] font-normal text-ink leading-none mb-1 transition-all duration-200 group-hover:text-canvas">3+</span>
                            <span class="text-xs font-medium text-mute uppercase tracking-[0.5px] transition-all duration-200 group-hover:text-canvas">Tahun Pengalaman</span>
                        </div>
                        <div class="bg-soft-cloud py-6 px-[18px] text-center transition-all duration-200 hover:bg-ink group">
                            <span class="block font-display text-[42px] font-normal text-ink leading-none mb-1 transition-all duration-200 group-hover:text-canvas">12+</span>
                            <span class="text-xs font-medium text-mute uppercase tracking-[0.5px] transition-all duration-200 group-hover:text-canvas">Proyek Selesai</span>
                        </div>
                        <div class="bg-soft-cloud py-6 px-[18px] text-center transition-all duration-200 hover:bg-ink group">
                            <span class="block font-display text-[42px] font-normal text-ink leading-none mb-1 transition-all duration-200 group-hover:text-canvas">2×</span>
                            <span class="text-xs font-medium text-mute uppercase tracking-[0.5px] transition-all duration-200 group-hover:text-canvas">Pemenang FLS2N</span>
                        </div>
                        <div class="bg-soft-cloud py-6 px-[18px] text-center transition-all duration-200 hover:bg-ink group">
                            <span class="block font-display text-[42px] font-normal text-ink leading-none mb-1 transition-all duration-200 group-hover:text-canvas">100%</span>
                            <span class="text-xs font-medium text-mute uppercase tracking-[0.5px] transition-all duration-200 group-hover:text-canvas">Semangat</span>
                        </div>
                    </div>
                </div>
            </div>

        <!-- portofolio -->
        <section id="portofolio" class="py-12">
            <div class="w-full max-w-[1440px] mx-auto px-6">
                <div class="mb-12">
                    <h2 class="font-display text-[clamp(28px,4vw,40px)] font-normal leading-[1.1] tracking-[1px] uppercase text-ink mb-2">PORTOFOLIO</h2>
                </div>

                <div class="flex gap-2 mb-10 flex-wrap">
                    <button class="filter-chip active bg-canvas border border-hairline text-ink px-5 py-2 rounded-full text-base font-medium cursor-pointer transition-all duration-200 hover:border-ink" data-filter="all" id="filter-semua">Semua</button>
                    <button class="filter-chip bg-canvas border border-hairline text-ink px-5 py-2 rounded-full text-base font-medium cursor-pointer transition-all duration-200 hover:border-ink" data-filter="film" id="filter-film">Film & Video</button>
                    <button class="filter-chip bg-canvas border border-hairline text-ink px-5 py-2 rounded-full text-base font-medium cursor-pointer transition-all duration-200 hover:border-ink" data-filter="design" id="filter-desain">Desain Grafis</button>
                    <button class="filter-chip bg-canvas border border-hairline text-ink px-5 py-2 rounded-full text-base font-medium cursor-pointer transition-all duration-200 hover:border-ink" data-filter="kepanitiaan" id="filter-kepanitiaan">Kepanitiaan</button>
                </div>

                <div class="grid grid-cols-3 gap-2 max-lg:grid-cols-2 max-sm:grid-cols-1" id="portfolio-items">
                    <!-- diisi oleh javascript via ajax -->
                    <div class="col-span-full text-center py-[60px]">
                        <i class="fa-solid fa-spinner fa-spin text-2xl text-mute"></i>
                        <p class="mt-3 text-mute text-sm">Memuat portofolio...</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- dukungan -->
        <section id="dukungan" class="py-12">
            <div class="w-full max-w-[1440px] mx-auto px-6">
                <div class="mb-12">
                    <h2 class="font-display text-[clamp(28px,4vw,40px)] font-normal leading-[1.1] tracking-[1px] uppercase text-ink mb-2">BERIKAN DUKUNGAN</h2>
                    <p class="text-base text-mute max-w-[600px] leading-normal">Tinggalkan pesan dukungan, kesan, atau kritik membangun untuk menyemangati perjalanan kreatif saya.</p>
                </div>

                <div class="grid grid-cols-2 gap-12 items-start max-lg:grid-cols-1 max-lg:gap-8">
                    <div class="p-10 bg-soft-cloud max-[599px]:px-4 max-[599px]:py-6">
                        <form id="form-dukungan">
                            <div class="mb-5">
                                <label for="nama-dukungan" class="block text-sm font-medium text-ink mb-2">Nama Lengkap</label>
                                <input type="text" id="nama-dukungan" class="w-full px-4 py-3 bg-canvas border border-hairline rounded-none text-ink font-body text-base transition-all duration-200 focus:outline-none focus:border-ink focus:shadow-[0_0_0_2px_rgba(17,17,17,0.1)] placeholder-stone" name="name" placeholder="Masukkan nama Anda" required>
                            </div>

                            <div class="mb-5">
                                <label for="email-dukungan" class="block text-sm font-medium text-ink mb-2">Alamat Email</label>
                                <input type="email" id="email-dukungan" class="w-full px-4 py-3 bg-canvas border border-hairline rounded-none text-ink font-body text-base transition-all duration-200 focus:outline-none focus:border-ink focus:shadow-[0_0_0_2px_rgba(17,17,17,0.1)] placeholder-stone" name="email" placeholder="contoh@mail.com" required>
                            </div>

                            <div class="mb-5">
                                <label for="pesan-dukungan" class="block text-sm font-medium text-ink mb-2">Kata-kata Pendukung</label>
                                <textarea id="pesan-dukungan" class="w-full px-4 py-3 bg-canvas border border-hairline rounded-none text-ink font-body text-base transition-all duration-200 focus:outline-none focus:border-ink focus:shadow-[0_0_0_2px_rgba(17,17,17,0.1)] placeholder-stone" name="message" rows="5" placeholder="Tuliskan pesan penyemangat Anda..." required></textarea>
                            </div>

                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full text-base font-medium leading-normal cursor-pointer transition-all duration-350 ease-smooth bg-ink text-canvas hover:bg-charcoal hover:scale-[1.02] active:scale-[0.97] active:opacity-80" id="tombol-kirim-dukungan">
                                Kirim Dukungan <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>

                    <div class="max-h-[500px] overflow-y-auto pr-2" id="panel-pesan-dukungan">
                        <h3 class="text-base font-semibold text-ink mb-6 uppercase tracking-[0.5px]">Pesan Terbaru</h3>
                        <div class="messages-list" id="daftar-pesan-dukungan">
                            <!-- diisi oleh javascript -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- footer -->
    <footer class="bg-ink text-stone py-12 pb-6">
        <div class="w-full max-w-[1440px] mx-auto px-6">
            <div class="pt-6 border-t border-[rgba(255,255,255,0.08)]">
                <p class="text-xs text-stone">© 2025 Ahmad Aditya Nugraha. Praktikum Pemrograman Web — UNS.</p>
            </div>
        </div>
    </footer>

    <!-- modal detail portofolio -->
    <div class="fixed inset-0 z-[1000] bg-black/60 backdrop-blur-sm hidden justify-center items-center p-5 modal-overlay" id="modal-detail" aria-hidden="true" role="dialog">
        <div class="w-full max-w-[860px] overflow-hidden relative bg-canvas modal-card">
            <button class="absolute top-4 right-4 w-10 h-10 rounded-full bg-soft-cloud text-ink flex items-center justify-center text-base cursor-pointer z-10 border-none transition-all duration-200 hover:bg-ink hover:text-canvas" id="tombol-tutup-detail" aria-label="Tutup Modal">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="grid grid-cols-2 max-lg:grid-cols-1">
                <div class="w-full min-h-[400px] bg-soft-cloud relative max-lg:min-h-[250px] max-lg:max-h-[300px]" id="wadah-media-modal"></div>
                <div class="p-10 max-lg:p-6 flex flex-col justify-between">
                    <div class="flex flex-col gap-1 mb-3 items-start">
                        <span class="text-xs font-medium text-mute uppercase tracking-[0.5px]" id="tag-kat-modal">Film & Video</span>
                        <span class="text-sm font-medium text-ink" id="tag-prestasi-modal">🏆 Juara 3 FLS2N</span>
                    </div>
                    <h3 id="judul-modal" class="font-display text-3xl font-normal text-ink mb-3 leading-none uppercase">Nama Proyek</h3>
                    <div class="flex-grow overflow-y-auto max-h-[180px] pr-2 mb-6">
                        <p id="deskripsi-modal" class="text-sm text-mute leading-relaxed">Deskripsi proyek...</p>
                    </div>
                    <div class="mt-auto">
                        <a href="#dukungan" class="w-full inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full text-base font-medium leading-normal cursor-pointer transition-all duration-350 ease-smooth bg-ink text-canvas hover:bg-charcoal hover:scale-[1.02] active:scale-[0.97] active:opacity-80 modal-support-btn" id="tombol-diskusi-modal">
                            Berikan Dukungan <i class="fa-solid fa-heart"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal terima kasih -->
    <div class="fixed inset-0 z-[1000] bg-black/60 backdrop-blur-sm hidden justify-center items-center p-5 modal-overlay" id="modal-terimakasih" aria-hidden="true" role="dialog">
        <div class="w-full max-w-[460px] overflow-hidden relative bg-canvas modal-card">
            <button class="absolute top-4 right-4 w-10 h-10 rounded-full bg-soft-cloud text-ink flex items-center justify-center text-base cursor-pointer z-10 border-none transition-all duration-200 hover:bg-ink hover:text-canvas" id="tombol-tutup-terimakasih" aria-label="Tutup Modal">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="p-12 text-center flex flex-col items-center">
                <div class="w-18 h-18 rounded-full bg-[rgba(0,125,72,0.08)] text-success flex items-center justify-center text-3xl mb-6 p-4">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h3 class="font-display text-2xl font-normal text-ink mb-2 uppercase">Dukungan Diterima!</h3>
                <p class="text-sm text-mute leading-relaxed mb-6" id="teks-pesan-terimakasih">Terimakasih telah mendukung...</p>
                <button class="w-full inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full text-base font-medium leading-normal cursor-pointer transition-all duration-350 ease-smooth bg-ink text-canvas hover:bg-charcoal hover:scale-[1.02] active:scale-[0.97] active:opacity-80" id="tombol-oke-terimakasih">Tutup</button>
            </div>
        </div>
    </div>

    <!-- toast notification -->
    <div class="toast-container" id="toast-container"></div>

    <script src="script.js"></script>
</body>
</html>
