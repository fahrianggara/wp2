<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            Hello, <?= $user->full_name ?>!
        </div>
    </div>
</div>
<?= $this->endSection() ?>