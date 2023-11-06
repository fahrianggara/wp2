/**
 * Show/Hide password
 *
 * @param {object} inputFields
*/
$('#showHidePass').click(function () {
    var inputFields = $('#oldpass, #newpass, #confpass');
    var icon = $(this).find('i');
    var isPasswordVisible = (inputFields.attr('type') === 'password');

    inputFields.attr('type', isPasswordVisible ? 'text' : 'password');
    icon.removeClass(isPasswordVisible ? 'fa-eye' : 'fa-eye-slash')
        .addClass(isPasswordVisible ? 'fa-eye-slash' : 'fa-eye');
});

$(document).ready(function () {
    const form = $('#changePasswordForm');
    const submit = form.find('button[type="submit"]');

    form.on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function () {
                submit.attr('disabled', true);
                submit.html('<i class="fa fa-spinner fa-spin"></i> Loading...');
                form.find('span.error-text').text('');
                form.find('.form-control').removeClass('is-invalid');
            },
            complete: function () {
                submit.attr('disabled', false);
                submit.html('Ganti Password');
            },
            success: function (res) {
                console.log(res);
                if (res.status === 400) {
                    if (res.val === true) {
                        $.each(res.message, function (key, value) {
                            $(`#${key}_error`).html(value);
                            $(`#${key}`).addClass('is-invalid');
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: res.message,
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'success',
                        text: res.message,
                        allowOutsideClick: false,
                    }).then(function () {
                        location.href = res.redirect;
                    });
                }
            }
        });
    });
});