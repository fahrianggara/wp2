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