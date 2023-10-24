<?php $this->extend('v_layout') ?>

<?php $this->section('content') ?>

<section>
    <h1><?= $judul ?></h1>

    <form action="<?= base_url('matakuliah') ?>" method="POST">
        <?= csrf_field() ?>

        <div>
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" value="<?= old('nama') ?>">

            <!-- Menampilkan pesan error -->
            <?php if(session()->has('errors') && session('errors')->getError('nama')): ?>
                <span style="color: red;">
                    <?= session('errors')->getError('nama'); ?>
                </span>
            <?php endif; ?>
        </div>

        <div>
            <label for="kode">Kode:</label>
            <input type="text" name="kode" id="kode" value="<?= old('kode') ?>">

            <!-- Menampilkan pesan error -->
            <?php if(session()->has('errors') && session('errors')->getError('kode')) : ?>
                <span style="color: red;">
                    <?= session('errors')->getError('kode'); ?>
                </span>
            <?php endif; ?>
        </div>

        <div>
            <label for="sks">SKS:</label>
            <input type="number" name="sks" id="sks" min="1" max="6" value="<?= old('sks') ?>">

            <!-- Menampilkan pesan error -->
            <?php if(session()->has('errors') && session('errors')->getError('sks')) : ?>
                <span style="color: red;">
                    <?= session('errors')->getError('sks'); ?>
                </span>
            <?php endif; ?>
        </div>

        <div>
            <input type="submit" value="Submit">
        </div>
    </form>

</section>

<?php $this->endSection() ?>