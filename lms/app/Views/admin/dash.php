<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                Halo <?= $user->first_name ?>!
            </div>
        </div>
    </div>
<?= $this->endSection() ?>