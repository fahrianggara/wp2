<div class="tab-pane fade show" id="password">
    <form id="changePasswordForm" method="POST" action="<?= route_to('profile.change_password') ?>" 
        class="form-horizontal" autocomplete="off">
        
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="POST">

        <div class="form-group row">
            <label for="oldpass" class="col-sm-2 col-form-label">
                Sandi Lama
            </label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="oldpass" placeholder="Kata sandi kamu yang sekarang"
                    name="oldpass" data-error="#oldpass_error">
                <div class="d-flex align-items-center justify-content-between mt-1">
                    <span class="invalid-feedback d-block error-text m-0 w-75" id="oldpass_error"></span>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="newpass" class="col-sm-2 col-form-label">
                Sandi Baru
            </label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="newpass" placeholder="Kata sandi baru kamu"
                    name="newpass" data-error="#newpass_error">
                <div class="d-flex align-items-center justify-content-between mt-1">
                    <span class="invalid-feedback d-block error-text m-0 w-75" id="newpass_error"></span>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="confpass" class="col-sm-2 col-form-label">
                Konfirmasi Sandi
            </label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="confpass" placeholder="Konfirmasi kata sandi baru kamu"
                    name="confpass" data-error="#confpass_error">
                <div class="d-flex align-items-center justify-content-between mt-1">
                    <span class="invalid-feedback d-block error-text m-0 w-75" id="confpass_error"></span>
                </div>
            </div>
        </div>

        <div class="form-group row my-0">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-sm btn-primary">
                    Ganti Password
                </button>
                <button type="button" class="btn btn-sm btn-secondary" id="showHidePass">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
    </form>
</div>
