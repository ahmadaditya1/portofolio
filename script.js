$(document).ready(function () {

    // ===== NAVBAR SCROLL EFFECT =====
    const nav = document.getElementById('primary-nav');

    function updateNavStyle() {
        if (window.pageYOffset > 60) {
            nav.classList.add('nav-scrolled');
        } else {
            nav.classList.remove('nav-scrolled');
        }
    }

    window.addEventListener('scroll', updateNavStyle);
    updateNavStyle(); // init

    // ===== FADE-IN ON SCROLL =====
    const fadeElements = document.querySelectorAll('.fade-in-up');

    const fadeObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                // trigger counter animation jika ada
                const counters = entry.target.querySelectorAll('[data-count]');
                counters.forEach(counter => animateCounter(counter));
            }
        });
    }, {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    });

    fadeElements.forEach(el => fadeObserver.observe(el));

    // ===== COUNTER ANIMATION =====
    function animateCounter(el) {
        if (el.dataset.animated) return; // prevent double
        el.dataset.animated = 'true';

        const target = parseInt(el.dataset.count);
        const suffix = el.dataset.suffix || '';
        const duration = 1500;
        const start = performance.now();

        function update(now) {
            const elapsed = now - start;
            const progress = Math.min(elapsed / duration, 1);
            // ease out cubic
            const eased = 1 - Math.pow(1 - progress, 3);
            const current = Math.floor(eased * target);
            el.textContent = current + suffix;

            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }

        requestAnimationFrame(update);
    }

    // ===== NAVIGASI SCROLL SPY =====
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

    // ===== MOBILE NAV TOGGLE =====
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

    // ===== SMOOTH SCROLL =====
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

    // ===== FILTER CHIP =====
    $(".filter-chip").click(function () {
        let filterValue = $(this).attr("data-filter");

        $(".filter-chip").removeClass("active");
        $(this).addClass("active");

        if (filterValue === "all") {
            $(".product-card").show();
        } else {
            $(".product-card").each(function () {
                if ($(this).attr("data-category") === filterValue) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
        updateHorizontalScroll();
    });

    // ===== HORIZONTAL SCROLL PORTOFOLIO =====
    const portoSection = document.getElementById('portofolio');
    const portoTrack = document.getElementById('portfolio-track');
    const portoSticky = document.getElementById('portfolio-sticky');

    function updateHorizontalScroll() {
        if (!portoSection || !portoTrack) return;

        const navHeight = 60;
        const rect = portoSection.getBoundingClientRect();
        const stickyHeight = portoSticky ? portoSticky.offsetHeight : (window.innerHeight - navHeight);
        const maxScroll = portoSection.offsetHeight - stickyHeight;
        if (maxScroll <= 0) {
            portoTrack.style.transform = 'translateX(0px)';
            return;
        }

        const scrolled = navHeight - rect.top;
        const progress = Math.max(0, Math.min(1, scrolled / maxScroll));
        const maxTranslate = portoTrack.scrollWidth - window.innerWidth + 96;

        if (maxTranslate <= 0) {
            portoTrack.style.transform = 'translateX(0px)';
        } else {
            portoTrack.style.transform = `translateX(-${progress * maxTranslate}px)`;
        }
    }

    window.addEventListener('scroll', updateHorizontalScroll, { passive: true });
    window.addEventListener('resize', updateHorizontalScroll);
    updateHorizontalScroll();

    // ===== HIRE ME MODAL OVERLAY =====
    const hireModal = $('#hire-modal');

    function openHireModal() {
        hireModal.removeClass('hidden').addClass('flex');
        setTimeout(function () {
            hireModal.removeClass('opacity-0').addClass('opacity-100');
            hireModal.find('.hire-modal-card').removeClass('scale-95').addClass('scale-100');
        }, 10);
        $('body').css('overflow', 'hidden');
        $('#hire-name').focus();
    }

    function closeHireModal() {
        hireModal.removeClass('opacity-100').addClass('opacity-0');
        hireModal.find('.hire-modal-card').removeClass('scale-100').addClass('scale-95');
        setTimeout(function () {
            hireModal.removeClass('flex').addClass('hidden');
            $('body').css('overflow', '');
        }, 250);
    }

    $('#btn-hire-me').on('click', function (e) {
        e.preventDefault();
        openHireModal();
    });

    $('#btn-close-modal').on('click', function () {
        closeHireModal();
    });

    hireModal.on('click', function (e) {
        if (e.target === this) {
            closeHireModal();
        }
    });

    $(document).on('keydown', function (e) {
        if (e.key === 'Escape' && !hireModal.hasClass('hidden')) {
            closeHireModal();
        }
    });

    // Character counter
    $('#hire-message').on('input', function () {
        const len = $(this).val().length;
        $('#hire-char-count').text(len.toLocaleString('id-ID') + ' / 5.000');
    });

    // Form submit
    $('#hire-form').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);
        const submitBtn = $('#btn-submit-hire');
        const name = $('#hire-name').val().trim();
        const email = $('#hire-email').val().trim();
        const subject = $('#hire-subject').val().trim();
        const message = $('#hire-message').val().trim();

        if (!name) {
            showToast('Mohon isi nama Anda.', 'error');
            $('#hire-name').focus();
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email || !emailRegex.test(email)) {
            showToast('Mohon isi alamat email yang valid.', 'error');
            $('#hire-email').focus();
            return;
        }

        if (!message) {
            showToast('Mohon isi pesan Anda.', 'error');
            $('#hire-message').focus();
            return;
        }

        submitBtn.prop('disabled', true).addClass('opacity-70 cursor-not-allowed').html('<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...');

        $.ajax({
            url: 'https://formsubmit.co/ajax/ahmadadityan94@gmail.com',
            method: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            headers: {
                'Accept': 'application/json'
            },
            data: JSON.stringify({
                name: name,
                email: email,
                _subject: subject ? `[Portofolio] ${subject}` : `[Portofolio] Pesan dari ${name}`,
                message: message,
                _template: 'table',
                _captcha: 'false'
            }),
            success: function (response) {
                showToast('Pesan berhasil terkirim ke email! Terima kasih.', 'success');
                form[0].reset();
                $('#hire-char-count').text('0 / 5.000');
                closeHireModal();
            },
            error: function () {
                showToast('Gagal mengirim pesan. Silakan coba lagi nanti.', 'error');
            },
            complete: function () {
                submitBtn.prop('disabled', false).removeClass('opacity-70 cursor-not-allowed').html('Kirim Pesan <i class="fa-regular fa-paper-plane text-sm"></i>');
            }
        });
    });

    // Toast notification
    function showToast(message, type = 'success') {
        const container = $('#toast-container');
        const icon = type === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation';
        const toastClass = type === 'success' ? 'toast-success' : 'toast-error';

        const toast = $(`
            <div class="toast ${toastClass}">
                <i class="fa-solid ${icon}"></i>
                <span>${message}</span>
            </div>
        `);

        container.append(toast);

        setTimeout(function () {
            toast.css('animation', 'toast-out 0.4s ease forwards');
            setTimeout(function () {
                toast.remove();
            }, 400);
        }, 4000);
    }

    // ===== GSAP HERO KINETIC TEXT ANIMATION =====
    function initHeroTextAnimation() {
        const title = document.getElementById('hero-title');
        if (!title || typeof gsap === 'undefined') return;

        const chars = title.querySelectorAll('.hero-char');
        const scrambleChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789*#%&!?';

        function playEntrance() {
            const tl = gsap.timeline({ defaults: { ease: 'power2.out' } });

            chars.forEach((char, index) => {
                const finalChar = char.getAttribute('data-char') || char.textContent;
                const randomRot = (Math.random() - 0.5) * 36; // -18deg s/d +18deg

                // reset state
                gsap.set(char, {
                    opacity: 0,
                    y: 65,
                    scale: 0.25,
                    rotation: randomRot,
                    color: '#faf9f5'
                });

                // animate in with stagger
                tl.to(char, {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    rotation: 0,
                    duration: 0.8,
                    ease: 'back.out(2.4)',
                    onStart: function () {
                        // scramble effect
                        let iterations = 0;
                        const maxIterations = 4;
                        const interval = setInterval(() => {
                            if (iterations < maxIterations) {
                                char.textContent = scrambleChars[Math.floor(Math.random() * scrambleChars.length)];
                                iterations++;
                            } else {
                                char.textContent = finalChar;
                                clearInterval(interval);
                            }
                        }, 35);
                    }
                }, index * 0.04);
            });
        }

        // Jalankan intro animation saat pertama kali load
        playEntrance();

        // Interactive hover physics per character
        chars.forEach((char) => {
            char.addEventListener('mouseenter', function () {
                gsap.killTweensOf(this);
                const jumpRot = (Math.random() - 0.5) * 28;
                gsap.timeline()
                    .to(this, {
                        y: -22,
                        scale: 1.22,
                        rotation: jumpRot,
                        color: '#60a5fa',
                        duration: 0.16,
                        ease: 'power2.out'
                    })
                    .to(this, {
                        y: 0,
                        scale: 1,
                        rotation: 0,
                        color: '#faf9f5',
                        duration: 0.75,
                        ease: 'elastic.out(1.4, 0.35)'
                    });
            });
        });

        // Klik judul untuk putar ulang animasi
        title.addEventListener('click', function () {
            playEntrance();
        });
    }

    // Jalankan inisialisasi GSAP
    initHeroTextAnimation();
});
