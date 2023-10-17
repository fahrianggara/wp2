<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Web Prog II | Merancang Template sederhana dengan codeigniter</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/stylebuku.css") ?>">
</head>

<body>
    <div id="wrapper">

        <?= $this->include('v_header') ?> <!-- Memasukkan file v_header.php untuk Header -->

        <?= $this->renderSection('content') ?> <!-- Memasukkan isi content yang ada di v_index.php -->

        <?= $this->include('v_footer') ?> <!-- Memasukkan file v_footer.php untuk Footer -->
    </div>
</body>

</html>