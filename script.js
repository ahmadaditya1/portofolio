$(document).ready(function () {

    // deteksi mode
    const isServerMode = window.location.protocol !== "file:" && !window.location.pathname.includes(".html");

    // navigasi scroll spy & mobile toggle
    $(window).scroll(function () {
        let scrollPos = $(window).scrollTop();

        $("section").each(function () {
            let top = $(this).offset().top - 100;
            let bottom = top + $(this).outerHeight();
            let id = $(this).attr("id");

            if (scrollPos >= top && scrollPos < bottom) {
                $(".nav-link").removeClass("active");
                $("#link-" + id).addClass("active");
            }
        });
    });

    // mobile nav toggle
    $("#toggle-menu").click(function () {
        $("#nav-center").toggleClass("show");
        let icon = $(this).find("i");
        if (icon.hasClass("fa-bars")) {
            icon.removeClass("fa-bars").addClass("fa-xmark");
        } else {
            icon.removeClass("fa-xmark").addClass("fa-bars");
        }
    });

    // tutup mobile nav saat link diklik
    $(".nav-link").click(function () {
        if ($(window).width() <= 768) {
            $("#nav-center").removeClass("show");
            $("#toggle-menu").find("i").removeClass("fa-xmark").addClass("fa-bars");
        }
    });

    // smooth scroll
    $("a[href^='#']").on("click", function (event) {
        if (this.hash !== "") {
            event.preventDefault();
            let hash = this.hash;
            let target = $(hash);
            if (target.length) {
                $("html, body").animate(
                    { scrollTop: target.offset().top - 70 },
                    500
                );
            }
        }
    });

    // animasi mengetik
    const roles = [
        "Kreator Visual & Pembuat Film",
        "Juara 2 FLS2N Jawa Timur 2022",
        "Juara 3 FLS2N Jawa Timur 2023",
        "Founder PortaPic",
    ];
    let roleIndex = 0;

    setInterval(function () {
        roleIndex = (roleIndex + 1) % roles.length;
        $("#teks-peran").fadeOut(300, function () {
            $(this).text(roles[roleIndex]).fadeIn(400);
        });
    }, 3000);

    // load portofolio
    if (isServerMode) {
        loadPortfolioFromDB();
    }

    function loadPortfolioFromDB() {
        $.ajax({
            url: "api.php?action=read",
            type: "GET",
            dataType: "json",
            success: function (response) {
                let container = $("#portfolio-items");
                container.empty();

                if (response.status === "success" && response.data.length > 0) {
                    response.data.forEach(function (item) {
                        let categoryLabel = "";
                        if (item.kategori === "film") {
                            categoryLabel = "Film & Video";
                        } else if (item.kategori === "design") {
                            categoryLabel = "Desain Grafis";
                        } else if (item.kategori === "kepanitiaan") {
                            categoryLabel = "Kepanitiaan";
                        } else {
                            categoryLabel = item.kategori;
                        }
                        let cardHtml = `
                            <div class="bg-canvas overflow-hidden cursor-pointer transition-all duration-350 ease-smooth hover:opacity-85 group product-card" data-category="${item.kategori}">
                                <div class="relative w-full aspect-square bg-soft-cloud overflow-hidden">
                                    <img src="./img/${item.gambar}" alt="${item.judul}" class="w-full h-full object-cover transition-transform duration-600 ease-in-out group-hover:scale-105" loading="lazy">
                                    <span class="absolute top-3 left-3 bg-canvas text-ink text-[12px] font-medium px-3 py-1 rounded-full border border-hairline z-[2]">${item.lencana}</span>
                                    <div class="absolute bottom-3 left-3 z-[2] opacity-0 translate-y-2 transition-all duration-350 ease-smooth group-hover:opacity-100 group-hover:translate-y-0">
                                        <button class="bg-canvas text-ink px-5 py-2.5 rounded-full text-sm font-medium inline-flex items-center gap-2 border-none cursor-pointer transition-all duration-200 hover:bg-soft-cloud btn-detail-porto"
                                            data-title="${item.judul}"
                                            data-category="${categoryLabel}"
                                            data-achievement="${item.pencapaian || ''}"
                                            data-image="./img/${item.gambar}"
                                            data-video="${item.video_url || ''}"
                                            data-desc="${item.deskripsi}">
                                            Lihat Detail <i class="fa-solid fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="py-2">
                                    <p class="text-base font-medium text-ink mb-0.5">${item.judul}</p>
                                    <p class="text-sm font-medium text-mute">${categoryLabel}</p>
                                    ${item.pencapaian ? '<p class="text-sm text-mute mt-1">' + item.pencapaian + '</p>' : ''}
                                </div>
                            </div>
                        `;
                        container.append(cardHtml);
                    });
                }
            },
            error: function () {
                // tampilkan pesan error jika pemuatan dari api gagal
                $("#portfolio-items").html(
                    '<div style="grid-column: 1/-1; text-align: center; color: var(--sale); padding: 40px 0;">' +
                    '<i class="fa-solid fa-triangle-exclamation" style="font-size: 24px; margin-bottom: 12px;"></i>' +
                    '<p>Gagal memuat data dari database. Pastikan Apache & MySQL di Laragon sudah aktif.</p>' +
                    '</div>'
                );
            },
        });
    }

    // filter chip
    $(".filter-chip").click(function () {
        let filterValue = $(this).attr("data-filter");

        $(".filter-chip").removeClass("active");
        $(this).addClass("active");

        if (filterValue === "all") {
            $(".product-card").fadeIn(400);
        } else {
            $(".product-card").each(function () {
                if ($(this).attr("data-category") === filterValue) {
                    $(this).fadeIn(400);
                } else {
                    $(this).fadeOut(200);
                }
            });
        }
    });

    // modal detail portofolio
    $(document).on("click", ".btn-detail-porto", function (e) {
        e.preventDefault();
        e.stopPropagation();

        let title = $(this).attr("data-title");
        let category = $(this).attr("data-category");
        let achievement = $(this).attr("data-achievement");
        let imageSrc = $(this).attr("data-image");
        let videoUrl = $(this).attr("data-video");
        let description = $(this).attr("data-desc");

        $("#judul-modal").text(title);
        $("#tag-kat-modal").text(category);
        $("#tag-prestasi-modal").text(achievement);
        $("#deskripsi-modal").text(description);

        if (videoUrl) {
            $("#wadah-media-modal").html(
                '<iframe src="' + videoUrl + '" width="100%" height="100%" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>'
            );
        } else {
            $("#wadah-media-modal").html(
                '<img src="' + imageSrc + '" alt="' + title + '">'
            );
        }

        $("#modal-detail")
            .css("display", "flex")
            .hide()
            .fadeIn(250, function () {
                $(this).find(".modal-card").slideDown(350);
            });
        $("body").css("overflow", "hidden");
    });

    // tutup modal detail
    $("#tombol-tutup-detail").click(function () {
        closeDetailModal();
    });

    $("#modal-detail").click(function (e) {
        if ($(e.target).hasClass("modal-overlay")) {
            closeDetailModal();
        }
    });

    $(".modal-support-btn").click(function () {
        closeDetailModal();
    });

    function closeDetailModal() {
        let modal = $("#modal-detail");
        modal.find(".modal-card").slideUp(250, function () {
            modal.fadeOut(200, function () {
                $("#wadah-media-modal").html("");
                $("body").css("overflow", "auto");
            });
        });
    }

    // form dukungan
    if (isServerMode) {
        loadSupportMessages();
    }

    // reset error state pada input nama ketika pengguna mengetik/fokus kembali
    $("#nama-dukungan").on("input focus", function () {
        $(this)
            .removeClass("input-error")
            .attr("placeholder", "Masukkan nama Anda");
    });

    $("#form-dukungan").submit(function (e) {
        e.preventDefault();

        let nama = $("#nama-dukungan").val().trim();
        let email = $("#email-dukungan").val().trim();
        let pesan = $("#pesan-dukungan").val().trim();

        if (isServerMode) {
            // simpan ke database via ajax
            $.ajax({
                url: "api.php",
                type: "POST",
                data: {
                    action: "dukungan",
                    nama: nama,
                    email: email,
                    pesan: pesan,
                },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        showThankyou(nama);
                        loadSupportMessages();
                    } else {
                        if (response.message.includes("nama")) {
                            $("#nama-dukungan")
                                .val("")
                                .attr("placeholder", "!nama tidak boleh berisi angka dan spasi")
                                .addClass("input-error");
                        } else {
                            showToast(response.message, "error");
                        }
                    }
                },
                error: function () {
                    showToast("Terjadi kesalahan koneksi ke server.", "error");
                },
            });
        } else {
            // mode statis
            showThankyou(nama);
        }
    });

    function showThankyou(nama) {
        $("#teks-pesan-terimakasih").text(
            "Terima kasih atas dukungan Anda, " + nama + "!"
        );
        $("#form-dukungan")[0].reset();

        $("#modal-terimakasih")
            .css("display", "flex")
            .hide()
            .fadeIn(250, function () {
                $(this).find(".modal-card").slideDown(350);
            });
        $("body").css("overflow", "hidden");
    }

    function loadSupportMessages() {
        $.ajax({
            url: "api.php?action=read_dukungan",
            type: "GET",
            dataType: "json",
            success: function (response) {
                let container = $("#daftar-pesan-dukungan");
                container.empty();

                if (response.status === "success" && response.data.length > 0) {
                    response.data.slice(0, 5).forEach(function (msg) {
                        let date = new Date(msg.created_at).toLocaleDateString("id-ID", {
                            day: "numeric",
                            month: "short",
                            year: "numeric",
                        });
                        container.append(`
                            <div class="py-[18px] border-b border-hairline first:pt-0">
                                <p class="text-sm font-semibold text-ink mb-0.5">${msg.nama}</p>
                                <p class="text-sm text-mute leading-normal mb-1">${msg.pesan}</p>
                                <span class="text-xs text-stone">${date}</span>
                            </div>
                        `);
                    });
                } else {
                    container.html('<p class="text-sm text-stone italic">Belum ada pesan dukungan.</p>');
                }
            },
        });
    }

    // tutup modal terimakasih
    $("#tombol-tutup-terimakasih, #tombol-oke-terimakasih").click(function () {
        closeThankyouModal();
    });

    $("#modal-terimakasih").click(function (e) {
        if ($(e.target).hasClass("modal-overlay")) {
            closeThankyouModal();
        }
    });

    function closeThankyouModal() {
        let modal = $("#modal-terimakasih");
        modal.find(".modal-card").slideUp(250, function () {
            modal.fadeOut(200, function () {
                $("body").css("overflow", "auto");
            });
        });
    }

    // artikel dari api jsonplaceholder
    loadArticlesFromAPI();

    function loadArticlesFromAPI() {
        $.ajax({
            url: "https://jsonplaceholder.typicode.com/posts?_limit=6",
            type: "GET",
            dataType: "json",
            success: function (posts) {
                let container = $("#wadah-artikel-api");
                container.empty();

                posts.forEach(function (post) {
                    let cardHtml = `
                        <div class="article-card">
                            <div>
                                <span class="article-badge">Post #${post.id}</span>
                                <h3 class="article-title">${post.title}</h3>
                                <p class="article-summary">${post.body}</p>
                            </div>
                            <button class="article-read-btn btn-buka-detail-api" data-id="${post.id}">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    `;
                    container.append(cardHtml);
                });
            },
            error: function () {
                $("#wadah-artikel-api").html(
                    '<p style="grid-column: 1/-1; text-align: center; color: var(--sale); padding: 40px 0;"><i class="fa-solid fa-triangle-exclamation"></i> Gagal memuat dari API. Pastikan terhubung ke internet.</p>'
                );
            },
        });
    }

    // modal detail artikel
    $(document).on("click", ".btn-buka-detail-api", function (e) {
        e.preventDefault();
        let postId = $(this).attr("data-id");

        $("#api-post-id").text("...");
        $("#api-post-title").text("Memuat...");
        $("#api-post-body").text("Mengambil isi artikel...");

        $("#modal-artikel-api")
            .css("display", "flex")
            .hide()
            .fadeIn(250, function () {
                $(this).find(".modal-card").slideDown(350);
            });
        $("body").css("overflow", "hidden");

        $.ajax({
            url: `https://jsonplaceholder.typicode.com/posts/${postId}`,
            type: "GET",
            dataType: "json",
            success: function (post) {
                $("#api-post-id").text(post.id);
                $("#api-post-title").text(post.title);
                $("#api-post-body").text(post.body);
            },
            error: function () {
                $("#api-post-title").text("Error!");
                $("#api-post-body").text("Gagal mengambil detail artikel.");
            },
        });
    });

    // tutup modal artikel
    $("#tombol-tutup-artikel-api, #btn-tutup-detail-api").click(function () {
        closeAPIModal();
    });

    $("#modal-artikel-api").click(function (e) {
        if ($(e.target).hasClass("modal-overlay")) {
            closeAPIModal();
        }
    });

    function closeAPIModal() {
        let modal = $("#modal-artikel-api");
        modal.find(".modal-card").slideUp(250, function () {
            modal.fadeOut(200, function () {
                $("body").css("overflow", "auto");
            });
        });
    }

    // fungsi toast
    function showToast(message, type = 'success') {
        let container = $('#toast-container');
        let icon = type === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation';
        let toastClass = type === 'success' ? 'toast-success' : 'toast-error';

        let toast = $(`
            <div class="toast ${toastClass}">
                <i class="fa-solid ${icon}"></i>
                <span>${message}</span>
            </div>
        `);

        container.append(toast);

        // hapus otomatis
        setTimeout(function () {
            toast.css('animation', 'toast-out 0.4s ease forwards');
            setTimeout(function () {
                toast.remove();
            }, 400);
        }, 4000);
    }
});