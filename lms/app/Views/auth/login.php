<?= $this->extend('layout/auth') ?>

<?= $this->section('content') ?>

    <?php 
        $flashDataIdNumber = session()->getFlashdata('errIdNumber');
        $invalidIdNumber = $flashDataIdNumber ? 'is-invalid' : '';

        $flashDataPassword = session()->getFlashdata('errPassword');
        $invalidPassword = $flashDataPassword ? 'is-invalid' : '';
    ?>

    <section class="authentication">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-5">
                    <form action="<?= base_url('login') ?>" class="card" method="post" 
                        autocomplete="off">
                        <?= csrf_field(); ?>

                        <div class="card-header">
                            Silahkan Masuk ke Akun Anda
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="id_number">Nomer Induk</label>
                                <input type="text" class="form-control <?= $invalidIdNumber ?>" 
                                    id="id_number" name="id_number" value="<?= old('id_number') ?>"
                                    placeholder="Masukkan Nomer Induk">
                                
                                <?php if ($flashDataIdNumber ): ?>
                                    <div class="invalid-feedback"><?= $flashDataIdNumber ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-1">
                                <label for="password">Kata Sandi</label>
                                <input type="password" class="form-control <?= $invalidPassword ?>" 
                                    id="password" name="password" placeholder="Masukkan Kata Sandi">

                                <?php if ($flashDataPassword ): ?>
                                    <div class="invalid-feedback"><?= $flashDataPassword ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card-footer p-2">
                            <button type="submit" class="btn btn-primary">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>