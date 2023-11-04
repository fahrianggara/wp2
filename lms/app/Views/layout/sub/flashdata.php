<?php if (session()->getFlashdata('success')) : ?>
    <div class="toast-alert success" data-title="Berhasil" 
        data-message="<?= session()->getFlashdata('success') ?>"></div>
<?php elseif (session()->getFlashdata('error')) : ?>
    <div class="toast-alert error" data-title="Gagal" 
        data-message="<?= session()->getFlashdata('error') ?>"></div>
<?php elseif (session()->getFlashdata('warning')) : ?>
    <div class="toast-alert warning" data-title="Peringatan" 
        data-message="<?= session()->getFlashdata('warning') ?>"></div>
<?php elseif (session()->getFlashdata('info')) : ?>
    <div class="toast-alert info" data-title="Informasi"
        data-message="<?= session()->getFlashdata('info') ?>"></div>
<?php endif ?>