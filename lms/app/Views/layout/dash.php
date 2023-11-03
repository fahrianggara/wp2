<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dash - Di-Lemas</title>

    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/sweetalert2/sweetalert2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/custom.css') ?>">
</head>

<body class="sidebar-mini layout-fixed layout-footer-fixed">

    <?= $this->include('layout/component/navbar') ?>

    <?= $this->include('layout/component/sidebar') ?>

    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h5 class="m-0">Dash</h5>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content mt-2">
                <?= $this->renderSection('content') ?>
            </section>
        </div>

        <?= $this->include('layout/component/footer') ?>
    </div>

    <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('plugins/bootstrap4/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
    <script src="<?= base_url('js/app.js') ?>"></script>
    <script src="<?= base_url('js/custom.js') ?>"></script>

    <?= $this->renderSection('js') ?>
</body>

</html>