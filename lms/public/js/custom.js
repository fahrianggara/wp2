const toastAlert = $('.toast-alert');
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});

if (toastAlert.length) {
    var message = toastAlert.data('message');
    var icon = toastAlert.attr('class').split(' ')[1];

    Toast.fire({
        icon: icon,
        title: message
    });
}

/**
     * Validate file type
     *
     * @param {string} file_type
     */
function validateFileType(file_type) {
    var valid_files = ['image/jpeg', 'image/png', 'image/jpg'];
    return valid_files.includes(file_type);
}

/**
 * Validate file size
 *
 * @param {File} file
 */
function validateFileSize(file) {
    var max_size = 1 * 1024 * 1024; // 1 MB
    return file.size <= max_size;
}

/**
 * Alert Swal
 * 
 * @param {string} icon
 * @param {string} title
 * @param {string} text
 */
function alertSwal(icon, title, text, allowOutsideClick = false) {
    let swalOptions = {
        icon: icon,
        title: title,
        html: text
    };

    if (allowOutsideClick) {
        swalOptions.allowOutsideClick = allowOutsideClick;
    }

    Swal.fire(swalOptions);
}

$(document).ready(function () 
{
    $(document).on("click", "#btn-logout", function (e) {
        e.preventDefault();
        $(".modal-logout").modal("show");
    });

    $(document).on("click", ".btn-logout", function (e) {
        e.preventDefault();
        $("#logout-form").submit();
    });

    // Show file name on file input
    $(document).on("change", ".custom-file-input", function (e) {
        var fileName = e.target.files[0] ? e.target.files[0].name : 'Silahkan cari..';
        $(this).next(".custom-file-label").html(fileName);
    });

    // Extend DataTables
    $.extend(true, $.fn.dataTable.defaults, {
        pageLength: 25,
        lengthMenu: [
            [25, 50, 100, 250, 500],
            [25, 50, 100, 250, 500]
        ],
        language: {
            url: `${origin}/plugins/datatables/datatables-language/idn.json`
        },
        fnDrawCallback: function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover'
            }).on('click', function () {
                $(this).tooltip('hide');
            });
        }
    });
});