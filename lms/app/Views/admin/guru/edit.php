<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-8">

            <form action="<?= route_to('admin.guru.update') ?>" class="card" 
                autocomplete="off" method="post" enctype="multipart/form-data">

                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="id" value="<?= base64_encode($guru->id) ?>">
                <input type="hidden" name="old_picture" value="<?= $guru->picture ?>">

                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2 py-1">Form Edit Guru</span>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="form-group col-lg-6">
                            <label for="first_name" wajib>Nama Awalan</label>

                            <input type="text" name="first_name" id="first_name" 
                                class="form-control <?= validation_show_error('first_name') ? 'is-invalid' : '' ?>"
                                value="<?= $guru->first_name ?>" placeholder="Masukkan Nama Awal Guru">

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('first_name') ?>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="last_name" wajib>Nama Akhiran</label>

                            <input type="text" name="last_name" id="last_name" 
                                class="form-control <?= validation_show_error('last_name') ? 'is-invalid' : '' ?>" 
                                value="<?= $guru->last_name ?>" placeholder="Masukkan Nama Akhir Guru">

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('last_name') ?>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="id_number" wajib>Nomer Induk</label>

                            <input type="text" name="id_number" id="id_number" 
                                class="form-control <?= validation_show_error('id_number') ? 'is-invalid' : '' ?>"  
                                value="<?= $guru->id_number ?>" placeholder="Masukkan Nomer Induk Guru">

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('id_number') ?>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="email" wajib>Email</label>

                            <input type="email" name="email" id="email" 
                                class="form-control <?= validation_show_error('email') ? 'is-invalid' : '' ?>"   
                                value="<?= $guru->email ?>" placeholder="Masukkan Alamat Email Guru">

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('email') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="gender">Jenis Kelamin</label>
                            <select class="custom-select" name="gender" id="gender">
                                <option <?= selected_option($guru->gender, 'laki_laki') ?> 
                                    value="laki_laki">Laki-laki
                                </option>
                                <option <?= selected_option($guru->gender, 'perempuan') ?> 
                                    value="perempuan">Perempuan
                                </option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="religion" wajib>Agama</label>

                            <select id="religion" name="religion" 
                                class="custom-select <?= validation_show_error('religion') ? 'is-invalid' : '' ?>">
                                <option value="" disabled selected>Silahkan pilih</option>

                                <option <?= selected_option($guru->religion, 'islam') ?> value="islam">Islam</option>
                                <option <?= selected_option($guru->religion, 'kristen') ?> value="kristen">Kristen</option>
                                <option <?= selected_option($guru->religion, 'katolik') ?> value="katolik">Katolik</option>
                                <option <?= selected_option($guru->religion, 'budha') ?> value="budha">Budha</option>
                                <option <?= selected_option($guru->religion, 'hindu') ?> value="hindu">Hindu</option>
                                <option <?= selected_option($guru->religion, 'protestan') ?> value="protestan">Protestan</option>
                                <option <?= selected_option($guru->religion, 'khonghucu') ?> value="khonghucu">Khonghucu</option>
                            </select>

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('religion') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="code" wajib>Kode Guru</label>

                            <input type="text" name="code" id="code" 
                                class="form-control <?= validation_show_error('code') ? 'is-invalid' : '' ?>"
                                value="<?= $guru->code ?>" placeholder="Masukkan Kode Guru">

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('code') ?>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="picture">Paspoto</label>
                            <div class="custom-file">
                                <input type="file" id="picture" name="picture" 
                                    class="custom-file-input <?= validation_show_error('picture') ? 'is-invalid' : '' ?>">
                                <label class="custom-file-label" for="picture">
                                    <?= $guru->picture ?>
                                </label>
                            </div>
                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('picture') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="classroom_ids" wajib>Kelas Mengajar</label>

                            <select name="classroom_ids[]" id="classroom_ids" multiple
                                class="custom-select <?= validation_show_error('classroom_ids') ? 'is-invalid' : '' ?>">
                                <?php foreach ($classrooms as $classroom) : ?>
                                    <option <?= in_array($classroom->id, $classroom_ids) ? 'selected' : '' ?>
                                        value="<?= $classroom->id ?>">
                                        <?= upcase($classroom->name) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('classroom_ids') ?>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="subject_ids" wajib>Kelas Mengajar</label>

                            <select name="subject_ids[]" id="subject_ids" multiple
                                class="custom-select <?= validation_show_error('subject_ids') ? 'is-invalid' : '' ?>">
                                <?php foreach ($subjects as $subject) : ?>
                                    <option <?= in_array($subject->id, $subject_ids) ? 'selected' : '' ?>
                                        value="<?= $subject->id ?>">
                                        <?= $subject->name ?>
                                    </option>
                                <?php endforeach ?>
                            </select>

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('subject_ids') ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer p-2 ">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="<?= route_to('admin.guru') ?>" class="btn btn-sm btn-primary">
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