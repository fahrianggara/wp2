<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Di-Lemas</title>

    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/sweetalert2/sweetalert2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/custom.css') ?>">
</head>

<body class="sidebar-mini layout-fixed layout-footer-fixed">

    <?= $this->include('layout/sub/navbar') ?>

    <?= $this->include('layout/sub/sidebar') ?>

    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h5 class="m-0"><?= $title ?></h5>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content mt-2">
                <?= $this->renderSection('content') ?>
            </section>
        </div>

        <?= $this->include('layout/sub/footer') ?>
    </div>

    <!-- Logout modal -->
    <div class="modal fade modal-logout">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    Hmmm <?= $user->getFullName() ?>, apakah kamu yakin ingin keluar dari aplikasi?
                </div>
                <div class="modal-footer p-1">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

                    <a href="<?= route_to('logout') ?>" type="button" class="btn btn-danger btn-logout">
                        Keluar

                        <form id="logout-form" action="<?= route_to('logout') ?>" method="POST" class="d-none">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                        </form>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('plugins/bootstrap4/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
    <script src="<?= base_url('js/app.js') ?>"></script>
    <script src="<?= base_url('js/custom.js') ?>"></script>

    <?= $this->renderSection('js') ?>

    <script>
        $(document).ready(function () {
            $(document).on("click", "#btn-logout", function (e) {
                e.preventDefault();
                $(".modal-logout").modal("show");
            });

            $(document).on("click", ".btn-logout", function (e) {
                e.preventDefault();
                $("#logout-form").submit();
            });
        });
    </script>
</body>

</html>