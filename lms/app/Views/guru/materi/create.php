<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-10">
            <form action="<?= route_to('guru.materi.store') ?>" class="card" autocomplete="off" 
                method="post" enctype="multipart/form-data">

                <input type="hidden" name="jadwal_id" value="<?= base64_encode($jadwal->id) ?>">
                <input type="hidden" name="_method" value="POST">
                <?= csrf_field() ?>

                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2 py-1">Form Tambah Materi</span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="name" wajib>Judul</label>

                        <input type="text" name="name" id="name" 
                            class="form-control <?= validation_show_error('name') ? 'is-invalid' : '' ?>"
                            value="<?= old('name') ?>" placeholder="Masukkan Judul materi">

                        <div class="invalid-feedback d-block">
                            <?= validation_show_error('name') ?>
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-lg-3">
                            <label for="type">Tipe Materi</label>
                            <select class="custom-select" name="type" id="type">
                                <option <?= selected_option(old('type'), 'file') ?> value="file">File</option>
                                <option <?= selected_option(old('type'), 'youtube') ?> value="youtube">YouTube</option>
                            </select>
                        </div>

                        <div class="col-lg-9">
                            <div class="form-group file">
                                <label for="file" wajib>Lampiran</label>

                                <div class="custom-file">
                                    <input type="file" id="file" name="file"
                                        class="custom-file-input <?= validation_show_error('file') ? 'is-invalid' : '' ?>">

                                    <label class="custom-file-label" for="file">
                                        Silahkan pilih file untuk materi
                                    </label>
                                </div>

                                <div class="invalid-feedback d-block">
                                    <?= validation_show_error('file') ?>
                                </div>
                            </div>

                            <div class="form-group youtube d-none">
                                <label for="youtube" wajib>Kode YouTube</label>

                                <input type="text" id="youtube" name="youtube" placeholder="www.youtube.com/watch?v= (?)"
                                    class="form-control <?= validation_show_error('youtube') ? 'is-invalid' : '' ?>">

                                <div class="invalid-feedback d-block">
                                    <?= validation_show_error('youtube') ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" wajib>Deskripsi</label>

                        <textarea name="description" id="description" rows="3" 
                            class="form-control <?= validation_show_error('description') ? 'is-invalid' : '' ?>" 
                            placeholder="Masukkan Deskripsi Materi"><?= old('description') ?></textarea>

                        <div class="invalid-feedback d-block">
                            <?= validation_show_error('description') ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="<?= route_to('guru.materi', base64_encode($jadwal->id)) ?>" 
                            class="btn btn-sm btn-primary">
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

<?= $this->section('js') ?>

<script>
    $(document).ready(function () {
        const form = $('form');
        const selectType = form.find('#type');

        selectType.on('change', function () {
            const value = $(this).val();
            const formGroup = form.find(`.form-group.${value}`);
            const filterType = form.find(".form-group.file, .form-group.youtube");

            filterType.addClass('d-none');
            formGroup.removeClass('d-none').find('input').val('');
            form_group.find(".form-control, .custom-file-input").removeClass("is-invalid");
            form_group.find(".error-text").text("");
        }).trigger('change');
    });
</script>

<?= $this->endSection() ?>