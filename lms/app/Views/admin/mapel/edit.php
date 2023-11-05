<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-xl-6 col-lg-9 col-md-12">

            <form action="<?= route_to('admin.mapel.update') ?>" class="card" 
                autocomplete="off" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= base64_encode($mapel->id) ?>">
                <input type="hidden" name="_method" value="POST">
                <?= csrf_field() ?>

                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2 py-1">Form Edit Mapel</span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="name" wajib>Nama Mapel</label>

                        <input type="text" name="name" id="name" 
                            class="form-control <?= validation_show_error('name') ? 'is-invalid' : '' ?>"
                            value="<?= $mapel->name ?>" placeholder="Masukkan Nama Mapel">

                        <div class="invalid-feedback d-block">
                            <?= validation_show_error('name') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="code" wajib>Kode Mapel</label>

                        <input type="text" name="code" id="code" 
                            class="form-control text-lowercase <?= validation_show_error('code') ? 'is-invalid' : '' ?>"
                            value="<?= $mapel->code ?>" placeholder="Masukkan Kode Mapel">

                        <div class="invalid-feedback d-block">
                            <?= validation_show_error('code') ?>
                        </div>
                    </div>
                </div>

                <div class="card-footer p-2 ">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="<?= route_to('admin.mapel') ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-sm btn-warning">
                            Perbarui Data
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection() ?>