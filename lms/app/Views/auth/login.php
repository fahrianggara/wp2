<?= $this->extend('layout/auth') ?>

<?= $this->section('content') ?>

    <section class="authentication">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-5">
                    <form action="<?= base_url('login') ?>" class="card" method="post" 
                        autocomplete="off">

                        <input type="hidden" name="_method" value="POST">
                        <?= csrf_field(); ?>

                        <div class="card-header">
                            Silahkan Masuk ke Akun Anda
                        </div>

                        <div class="card-body">

                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-default-danger alert-dismissible fade show" 
                                    role="alert">
                                    <strong>Perhatian!</strong> <br>
                                    <small><?= session()->getFlashdata('error') ?></small>
                                    <button type="button" class="close" data-dismiss="alert" 
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            
                            <div class="form-group">
                                <label for="id_number" wajib>Nomer Induk</label>

                                <input type="text" id="id_number" name="id_number" value="<?= old('id_number') ?>"
                                    class="form-control <?= validation_show_error('id_number') ? 'is-invalid' : '' ?>" 
                                    placeholder="Masukkan Nomer Induk">
                                
                                <div class="invalid-feedback d-block">
                                    <?= validation_show_error('id_number') ?>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <label for="password" wajib>Kata Sandi</label>

                                <input type="password"
                                    id="password" name="password" placeholder="Masukkan Kata Sandi"
                                    class="form-control <?= validation_show_error('password') ? 'is-invalid' : '' ?>">

                                <div class="invalid-feedback d-block">
                                    <?= validation_show_error('password') ?>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer p-2">
                            <button type="submit" class="btn btn-sm btn-primary">Masuk</button>
                            <div class="btn-group dropup">
                                <button class="btn btn-info dropdown-toggle dropdown-toggle-split btn-action"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,3">
                                    <i class="fas fa-users"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-start py-1">
                                    <h6 class="dropdown-header" style="position: relative; bottom: 4px;">
                                        Akun Default
                                    </h6>
                                    <?php foreach ($users as $user): ?>
                                        <button value="<?= $user->id_number ?>" type="button"
                                            class="dropdown-item d-flex align-items-center default-login">
                                            <img src="<?= $user->photo ?>" alt="avatar <?= $user->full_name ?>"
                                                class="rounded-circle mr-2" width="20" height="20">
                                            <?= $user->full_name ?> <small class="text-muted ml-1">(<?= ucfirst($user->roleId) ?>)</small>
                                        </button>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>
    $(document).ready(function () {
        $(document).on('click', '.default-login', function () {
            let id_number = $(this).val();
            
            $('#id_number').val(id_number);
            $('#password').val(id_number);

            $("button[type='submit']").trigger("click");
        });
    });
</script>

<?= $this->endSection() ?>