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

<body>
    <?= $this->renderSection('content') ?>

    <script src="<?= base_url('plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('plugins/bootstrap4/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
    <script src="<?= base_url('js/app.js') ?>"></script>
    <script src="<?= base_url('js/custom.js') ?>"></script>

    <?= $this->renderSection('js') ?>
</body>

</html>