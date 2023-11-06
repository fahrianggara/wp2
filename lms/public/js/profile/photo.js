$(document).ready(function () {
    const btnRemovePhoto = $('#btn-remove-photo');
    const btnChangePhoto = $('#btn-change-photo');
    const formChangePhoto = $('#form-change-photo');
    const fileInput = formChangePhoto.find('[type="file"]');

    btnChangePhoto.on('click', function () {
        fileInput.click();
        fileInput.on('change', function () {
            const file = this.files[0];
            
            if (!validateFileType(file.type)) {
                alertSwal('error', 'Gagal', 'Format gambar harus jpg, jpeg, atau png.')
                return;
            }

            if (!validateFileSize(file)) {
                alertSwal('error', 'Gagal', 'Ukuran gambar maksimal 1MB.')
                return;
            }

            setTimeout(() => {
                formChangePhoto.submit();
            }, 350);
        });
    });

    formChangePhoto.on('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: res.message,
                        allowOutsideClick: false,
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    alertSwal('error', 'Gagal', res.message);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alertSwal('error', 'Gagal', xhr.responseJSON.message);
            },
        });
    });

    btnRemovePhoto.on('click', function (e) {
        e.preventDefault();

        $.ajax({
            method: "POST",
            url: `${origin}/profile/remove-photo`,
            dataType: "json",
            success: function (res) {
                if (res.status === 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: res.message,
                        allowOutsideClick: false,
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    alertSwal('error', 'Gagal', res.message);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alertSwal('error', 'Gagal', xhr.responseJSON.message);
            },
        });
    });
});