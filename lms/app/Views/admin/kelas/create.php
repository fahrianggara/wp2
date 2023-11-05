<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-xl-6 col-lg-9 col-md-12">

            <form action="<?= route_to('admin.kelas.store') ?>" class="card" 
                autocomplete="off" method="post" enctype="multipart/form-data">

                <input type="hidden" name="_method" value="POST">
                <?= csrf_field() ?>

                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2 py-1">Form Tambah Kelas</span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="name" wajib>Nama Kelas</label>

                        <input type="text" name="name" id="name" 
                            class="form-control text-lowercase <?= validation_show_error('name') ? 'is-invalid' : '' ?>"
                            value="<?= old('name') ?>" placeholder="Masukkan Nama Kelas">

                        <div class="invalid-feedback d-block">
                            <?= validation_show_error('name') ?>
                        </div>
                    </div>
                </div>

                <div class="card-footer p-2 ">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="<?= route_to('admin.kelas') ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-sm btn-success">
                            Simpan Data
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection() ?>