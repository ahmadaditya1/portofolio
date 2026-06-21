$(document).ready(function () {
    // load data awal
    loadPortfolio();
    loadDukungan();

    // load data portofolio
    function loadPortfolio() {
        $.ajax({
            url: 'api.php?action=read',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                let tbody = $('#tbody-portofolio');
                tbody.empty();

                if (response.status === 'success' && response.data.length > 0) {
                    $('#total-items').text(response.data.length + ' item');
                    
                    response.data.forEach(function (item, index) {
                        let kategoriLabel = '';
                        if (item.kategori === 'film') {
                            kategoriLabel = 'Film & Video';
                        } else if (item.kategori === 'design') {
                            kategoriLabel = 'Desain Grafis';
                        } else if (item.kategori === 'kepanitiaan') {
                            kategoriLabel = 'Kepanitiaan';
                        } else {
                            kategoriLabel = item.kategori;
                        }

                        let pencapaian = item.pencapaian ? item.pencapaian : '-';
                        let rowHtml = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>
                                    <img src="./img/${item.gambar}" alt="${item.judul}" class="table-thumb" onerror="this.src='./img/default.jpg'">
                                </td>
                                <td><strong>${item.judul}</strong></td>
                                <td><span class="category-pill">${kategoriLabel}</span></td>
                                <td>${pencapaian}</td>
                                <td>
                                    <div class="table-actions">
                                        <button type="button" class="btn-table-edit btn-edit-porto" data-id="${item.id}" title="Edit Proyek">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn-table-delete btn-delete-porto" data-id="${item.id}" data-judul="${item.judul}" title="Hapus Proyek">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `;
                        tbody.append(rowHtml);
                    });
                } else {
                    $('#total-items').text('0 item');
                    tbody.html(`
                        <tr>
                            <td colspan="6" class="table-empty">
                                <i class="fa-regular fa-folder-open" style="font-size: 24px; margin-bottom: 8px; display: block;"></i>
                                Belum ada data portofolio.
                            </td>
                        </tr>
                    `);
                }
            },
            error: function () {
                showToast('Gagal mengambil data portofolio dari server.', 'error');
                let tbody = $('#tbody-portofolio');
                tbody.html(`
                    <tr>
                        <td colspan="6" class="table-empty" style="color: var(--sale);">
                            <i class="fa-solid fa-triangle-exclamation" style="font-size: 24px; margin-bottom: 8px; display: block;"></i>
                            Gagal memuat data dari database. Pastikan server lokal dan database sudah aktif.
                        </td>
                    </tr>
                `);
            }
        });
    }

    // load pesan dukungan
    function loadDukungan() {
        $.ajax({
            url: 'api.php?action=read_dukungan',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                let tbody = $('#tbody-dukungan');
                tbody.empty();

                if (response.status === 'success' && response.data.length > 0) {
                    $('#total-dukungan').text(response.data.length + ' pesan');
                    
                    response.data.forEach(function (msg, index) {
                        let date = new Date(msg.created_at).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'short',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });

                        let rowHtml = `
                            <tr>
                                <td>${index + 1}</td>
                                <td><strong>${msg.nama}</strong></td>
                                <td><a href="mailto:${msg.email}" style="color: var(--info); text-decoration: underline;">${msg.email}</a></td>
                                <td>${msg.pesan}</td>
                                <td><span style="font-size: 12px; color: var(--mute);">${date}</span></td>
                            </tr>
                        `;
                        tbody.append(rowHtml);
                    });
                } else {
                    $('#total-dukungan').text('0 pesan');
                    tbody.html(`
                        <tr>
                            <td colspan="5" class="table-empty">
                                <i class="fa-regular fa-message" style="font-size: 24px; margin-bottom: 8px; display: block;"></i>
                                Belum ada pesan dukungan.
                            </td>
                        </tr>
                    `);
                }
            },
            error: function () {
                showToast('Gagal mengambil data dukungan dari server.', 'error');
                let tbody = $('#tbody-dukungan');
                tbody.html(`
                    <tr>
                        <td colspan="5" class="table-empty" style="color: var(--sale);">
                            <i class="fa-solid fa-triangle-exclamation" style="font-size: 24px; margin-bottom: 8px; display: block;"></i>
                            Gagal memuat data dukungan dari database. Pastikan server lokal dan database sudah aktif.
                        </td>
                    </tr>
                `);
            }
        });
    }

    // submit form portofolio
    $('#form-portofolio').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        let action = $('#porto-action').val();
        let submitBtn = $('#btn-submit-porto');
        let originalBtnHtml = submitBtn.html();

        // loading state
        submitBtn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Memproses...');

        $.ajax({
            url: 'api.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                submitBtn.prop('disabled', false).html(originalBtnHtml);

                if (response.status === 'success') {
                    showToast(response.message, 'success');
                    
                    // Reset Form
                    resetForm();
                    
                    // Reload data
                    loadPortfolio();
                } else {
                    showToast(response.message, 'error');
                }
            },
            error: function () {
                submitBtn.prop('disabled', false).html(originalBtnHtml);
                showToast('Terjadi kesalahan koneksi ke server.', 'error');
            }
        });
    });

    // edit portofolio
    $(document).on('click', '.btn-edit-porto', function () {
        let id = $(this).attr('data-id');

        // tarik data detail dari server
        $.ajax({
            url: `api.php?action=read&id=${id}`,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success' && response.data) {
                    let item = response.data;

                    // isi form fields
                    $('#porto-id').val(item.id);
                    $('#porto-action').val('update');
                    $('#porto-judul').val(item.judul);
                    $('#porto-kategori').val(item.kategori).trigger('change');
                    $('#porto-lencana').val(item.lencana);
                    $('#porto-pencapaian').val(item.pencapaian || '');
                    $('#porto-waktu').val(item.waktu_pelaksanaan || '');
                    $('#porto-ringkasan').val(item.ringkasan);
                    $('#porto-deskripsi').val(item.deskripsi);
                    $('#porto-video').val(item.video_url || '');

                    // reset input file
                    $('#porto-gambar').val('');
                    $('#hint-gambar').text(`Gambar saat ini: ${item.gambar}. Biarkan kosong jika tidak ingin diubah.`);

                    // ubah ui form ke edit mode
                    $('#crud-form-title').text('EDIT PROYEK');
                    $('#crud-form-subtitle').text('Perbarui detail proyek portofolio Anda');
                    $('#btn-submit-porto').html('<i class="fa-solid fa-floppy-disk"></i> Perbarui Proyek');
                    $('#btn-reset-form').show();

                    // scroll ke form
                    $('html, body').animate({
                        scrollTop: $('#crud-form-section').offset().top - 80
                    }, 500);
                } else {
                    showToast('Gagal memuat detail proyek.', 'error');
                }
            },
            error: function () {
                showToast('Gagal menghubungi server.', 'error');
            }
        });
    });

    // reset form batal edit
    $('#btn-reset-form').click(function () {
        resetForm();
    });

    function resetForm() {
        $('#form-portofolio')[0].reset();
        $('#porto-id').val('');
        $('#porto-action').val('create');
        
        // reset hint gambar
        $('#hint-gambar').text('Format: JPG, PNG. Maks 5MB.');

        // ubah ui form kembali ke create mode
        $('#crud-form-title').text('TAMBAH PROYEK BARU');
        $('#crud-form-subtitle').text('Isi detail proyek portofolio Anda');
        $('#btn-submit-porto').html('<i class="fa-solid fa-plus"></i> Tambah Proyek');
        $('#btn-reset-form').hide();
        
        // reset label form
        $('#porto-kategori').trigger('change');
    }

    // hapus portofolio
    let idToDelete = null;

    $(document).on('click', '.btn-delete-porto', function () {
        idToDelete = $(this).attr('data-id');
        let judul = $(this).attr('data-judul');

        $('#nama-hapus').text(judul);
        
        // tampilkan modal hapus
        $('#modal-hapus')
            .css('display', 'flex')
            .hide()
            .fadeIn(200, function () {
                $(this).find('.modal-card').slideDown(250);
            })
            .attr('aria-hidden', 'false');
        $('body').css('overflow', 'hidden');
    });

    // tutup modal hapus
    $('#btn-batal-hapus, #btn-cancel-delete, #modal-hapus').click(function (e) {
        if (e.target === this || $(e.target).closest('.modal-close-btn').length || e.target.id === 'btn-cancel-delete') {
            closeDeleteModal();
        }
    });

    function closeDeleteModal() {
        let modal = $('#modal-hapus');
        modal.find('.modal-card').slideUp(200, function () {
            modal.fadeOut(150, function () {
                $('body').css('overflow', 'auto');
                idToDelete = null;
            });
        });
        modal.attr('aria-hidden', 'true');
    }

    // konfirmasi hapus
    $('#btn-confirm-delete').click(function () {
        if (!idToDelete) return;

        let confirmBtn = $(this);
        let originalHtml = confirmBtn.html();
        confirmBtn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Menghapus...');

        $.ajax({
            url: 'api.php',
            type: 'POST',
            data: {
                action: 'delete',
                id: idToDelete
            },
            dataType: 'json',
            success: function (response) {
                confirmBtn.prop('disabled', false).html(originalHtml);
                closeDeleteModal();

                if (response.status === 'success') {
                    showToast(response.message, 'success');
                    loadPortfolio();
                } else {
                    showToast(response.message, 'error');
                }
            },
            error: function () {
                confirmBtn.prop('disabled', false).html(originalHtml);
                closeDeleteModal();
                showToast('Terjadi kesalahan saat menghapus data.', 'error');
            }
        });
    });

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
