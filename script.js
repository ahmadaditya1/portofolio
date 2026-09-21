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

    // ===== NUGRAHA ALIGNMENT (posisi setelah akhir aditya) =====
    function alignNugraha() {
        const aditya = document.getElementById('word-aditya');
        const nugrahaLine = document.getElementById('nugraha-line');
        const titleEl = document.getElementById('hero-title');
        if (!aditya || !nugrahaLine || !titleEl) return;

        const titleLeft = titleEl.getBoundingClientRect().left;
        const adityaRight = aditya.getBoundingClientRect().right;
        const offset = adityaRight - titleLeft;
        nugrahaLine.style.paddingLeft = offset + 'px';
    }

    // Run on load, resize, and after fonts settle
    alignNugraha();
    window.addEventListener('resize', alignNugraha);
    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(alignNugraha);
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
        // Re-align Nugraha setelah animasi selesai
        setTimeout(alignNugraha, 1200);

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
            setTimeout(alignNugraha, 1200);
        });
    }

    // ===== CONTACT 3D CARD STACK & TILT =====
    function initContactCardStack() {
        const stackWrapper = document.getElementById('contact-card-stack');
        if (!stackWrapper || typeof gsap === 'undefined') return;

        const card1 = stackWrapper.querySelector('[data-id="1"]');
        const card2 = stackWrapper.querySelector('[data-id="2"]');
        const card3 = stackWrapper.querySelector('[data-id="3"]');
        if (!card1 || !card2 || !card3) return;

        // Slot positions & pull directions:
        // Card 1: Ahmad (atas / top-left)
        // Card 2: Aditya (tengah / center)
        // Card 3: Nugraha (bawah / bottom-right)
        const cardMap = {
            1: { el: card1, slot: { left: '6%', top: '6%', baseRot: -2 }, pull: { x: -85, y: -45, rot: -16 } },
            2: { el: card2, slot: { left: '28%', top: '28%', baseRot: 1.5 }, pull: { x: -80, y: 35, rot: -12 } },
            3: { el: card3, slot: { left: '50%', top: '50%', baseRot: -1 }, pull: { x: 85, y: 45, rot: 16 } }
        };

        // Stacking order: [bottom, middle, top]
        // Posisi awal persis seperti di gambar posisi awal.png:
        // Card 1 (Ahmad) di paling belakang (zIndex 10)
        // Card 2 (Aditya) di tengah (zIndex 20)
        // Card 3 (Nugraha) paling depan (zIndex 30, menindih Card 2 & 1)
        let stackOrder = [1, 2, 3];
        const zIndexes = [10, 20, 30];

        // Inisialisasi posisi awal di slot masing-masing
        [1, 2, 3].forEach((id) => {
            const item = cardMap[id];
            gsap.set(item.el, {
                left: item.slot.left,
                top: item.slot.top,
                x: 0,
                y: 0,
                rotation: item.slot.baseRot,
                transformOrigin: 'center center'
            });
        });

        // Floating idle animation saat tidak ada interaksi hover
        const floatTweens = {};
        function startFloat(id, delay = 0) {
            const item = cardMap[id];
            if (floatTweens[id]) floatTweens[id].kill();
            
            const durations = { 1: 3.4, 2: 2.8, 3: 3.1 };
            const amplitudes = { 1: 4, 2: 5, 3: 4 };
            
            floatTweens[id] = gsap.to(item.el, {
                y: `+=${amplitudes[id]}`,
                duration: durations[id],
                repeat: -1,
                yoyo: true,
                ease: 'sine.inOut',
                delay: delay
            });
        }

        function stopAllFloats() {
            [1, 2, 3].forEach(id => {
                if (floatTweens[id]) floatTweens[id].kill();
            });
        }

        function resumeAllFloats() {
            [1, 2, 3].forEach((id, i) => startFloat(id, i * 0.2));
        }

        // Terapkan z-index, class visual, dan shadow depth
        function applyStackClasses() {
            stackOrder.forEach((id, idx) => {
                const item = cardMap[id];
                const z = zIndexes[idx];
                item.el.style.zIndex = z;
                if (idx === 2) {
                    item.el.classList.add('is-front');
                    item.el.classList.remove('is-behind');
                } else {
                    item.el.classList.remove('is-front');
                    item.el.classList.add('is-behind');
                }
            });
        }

        applyStackClasses();
        resumeAllFloats();

        // Parameter Fan-out (melebar seperti kipas kartu saat hover area tumpukan)
        const fanOffsets = {
            1: { x: -32, y: -24, rot: -8 },
            2: { x: -6, y: 0, rot: 2 },
            3: { x: 32, y: 24, rot: 8 }
        };

        let isHoveringStack = false;
        let isAnimating = false;

        function applyFanOut() {
            if (isAnimating) return;
            stopAllFloats();
            [1, 2, 3].forEach((id) => {
                const item = cardMap[id];
                const fan = fanOffsets[id];
                gsap.to(item.el, {
                    x: fan.x,
                    y: fan.y,
                    rotation: fan.rot,
                    duration: 0.38,
                    ease: 'power2.out',
                    overwrite: 'auto'
                });
            });
        }

        function resetFanOut() {
            if (isAnimating) return;
            [1, 2, 3].forEach((id) => {
                const item = cardMap[id];
                gsap.to(item.el, {
                    x: 0,
                    y: 0,
                    scale: 1,
                    rotation: item.slot.baseRot,
                    duration: 0.45,
                    ease: 'power3.out',
                    overwrite: 'auto',
                    onComplete: () => {
                        if (!isHoveringStack && !isAnimating) {
                            startFloat(id);
                        }
                    }
                });
            });
        }

        // Hover event pada container deck (Kipas melebar saat cursor masuk, merapat saat keluar)
        stackWrapper.addEventListener('mouseenter', function () {
            isHoveringStack = true;
            applyFanOut();
        });

        stackWrapper.addEventListener('mouseleave', function () {
            isHoveringStack = false;
            resetFanOut();
        });

        // Hover fokus per kartu: kartu yang ditunjuk kursor sedikit terangkat & membesar
        [1, 2, 3].forEach((id) => {
            const item = cardMap[id];
            item.el.addEventListener('mouseenter', function () {
                if (isAnimating) return;
                gsap.to(item.el, {
                    scale: 1.05,
                    duration: 0.22,
                    ease: 'power2.out'
                });
            });
            item.el.addEventListener('mouseleave', function () {
                if (isAnimating) return;
                gsap.to(item.el, {
                    scale: 1,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });
        });

        // Animasi mencabut kartu (pull out), menukar z-index, lalu meluncur kembali ke atas tumpukan
        function bringCardToFront(id) {
            if (isAnimating) return;
            isAnimating = true;
            stopAllFloats();

            const item = cardMap[id];

            // Susun ulang stack: letakkan kartu ini di index teratas (2)
            stackOrder = stackOrder.filter(x => x !== id);
            stackOrder.push(id);

            const tl = gsap.timeline({
                onComplete: () => {
                    isAnimating = false;
                    if (isHoveringStack) {
                        applyFanOut();
                    } else {
                        resetFanOut();
                    }
                }
            });

            // 1. Cabut kartu ke arah luar dengan rotasi dinamis & membesar
            tl.to(item.el, {
                x: item.pull.x * 1.1,
                y: item.pull.y * 1.1,
                rotation: item.pull.rot,
                scale: 1.1,
                duration: 0.26,
                ease: 'power2.out'
            })
            // 2. Di posisi luar, z-index kartu diangkat ke paling depan
            .add(() => {
                applyStackClasses();
            })
            // 3. Meluncur masuk kembali ke posisi slotnya menindih kartu lain
            .to(item.el, {
                x: isHoveringStack ? fanOffsets[id].x : 0,
                y: isHoveringStack ? fanOffsets[id].y : 0,
                rotation: isHoveringStack ? fanOffsets[id].rot : item.slot.baseRot,
                scale: isHoveringStack ? 1.05 : 1,
                duration: 0.42,
                ease: 'back.out(1.6)'
            });
        }

        // Jika kartu yang sedang paling depan diklik, selipkan ke belakang deck
        function sendFrontCardToBack() {
            if (isAnimating) return;
            isAnimating = true;
            stopAllFloats();

            const frontId = stackOrder[2];
            const item = cardMap[frontId];

            // Putar antrean: kartu depan pindah ke paling belakang
            stackOrder.unshift(stackOrder.pop());

            const tl = gsap.timeline({
                onComplete: () => {
                    isAnimating = false;
                    if (isHoveringStack) {
                        applyFanOut();
                    } else {
                        resetFanOut();
                    }
                }
            });

            // Cabut kartu keluar sedikit
            tl.to(item.el, {
                x: item.pull.x * 0.8,
                y: item.pull.y * 0.8,
                rotation: item.pull.rot * 0.8,
                scale: 1.04,
                duration: 0.22,
                ease: 'power2.out'
            })
            // Turunkan z-index ke belakang
            .add(() => {
                applyStackClasses();
            })
            // Selipkan kembali ke belakang tumpukan
            .to(item.el, {
                x: isHoveringStack ? fanOffsets[frontId].x : 0,
                y: isHoveringStack ? fanOffsets[frontId].y : 0,
                rotation: isHoveringStack ? fanOffsets[frontId].rot : item.slot.baseRot,
                scale: 1,
                duration: 0.36,
                ease: 'power2.out'
            });
        }

        // Click handler per card
        [1, 2, 3].forEach((id) => {
            const item = cardMap[id];
            item.el.addEventListener('click', function (e) {
                e.stopPropagation();
                const currentIdx = stackOrder.indexOf(id);
                if (currentIdx === 2) {
                    sendFrontCardToBack();
                } else {
                    bringCardToFront(id);
                }
            });
        });
    }

    // Jalankan inisialisasi GSAP
    initHeroTextAnimation();
    initContactCardStack();
});
