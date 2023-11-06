<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header p-1">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-3">Foto Profile</span>
                        <div class="btn-group">
                            <button class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" fdprocessedid="lprwd8">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>

                            <div class="dropdown-menu dashboard-dropdown dropdown-menu-right py-1">

                                <button id="btn-change-photo" class="dropdown-item d-flex align-items-center">
                                    <i class="fas fa-sync text-primary"></i>
                                    <span class="ml-2">
                                        Ganti Foto
                                    </span>
                                </button>

                                <?php if (file_exists("images/pictures/$user->picture")): ?>
                                    <button id="btn-remove-photo" class="dropdown-item d-flex align-items-center">
                                        <i class="fas fa-trash text-danger"></i>
                                        <span class="ml-2">
                                            Hapus Foto
                                        </span>
                                    </button>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img id="user-photo" src="<?= $user->photo ?>"
                            class="profile-user-img img-fluid img-circle profile-photo lg">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="card">
                <div class="card-header p-1">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#information" data-toggle="tab">
                                Biodata Diri
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#password" data-toggle="tab">
                                Kata Sandi
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <?= $this->include('profile/tab-bio') ?>
                        <?= $this->include('profile/tab-password') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="form-change-photo" action="<?= route_to('profile.change_photo') ?>" method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="POST">
    <input type="file" name="picture" class="d-none">
    <button type="submit" class="d-none"></button>
</form>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="<?= base_url('js/profile/photo.js') ?>"></script>
    <script src="<?= base_url('js/profile/password.js') ?>"></script>
    <script>
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('a[href="' + activeTab + '"]').tab('show');
        }
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var activeTab = $(e.target).attr('href');
            localStorage.setItem('activeTab', activeTab);
        });

        /**
         * Remove class is-invalid when click tab no active
         *
         * @return void
         */
        $('a[data-toggle="tab"]:not(.active)').on('click', function() {
            $('form').trigger('reset');
            $('.form-control').removeClass('is-invalid').removeClass('is-valid');
            $('span.error-text').text('');
            $('.limit-text').text($('.limit-text').data('limit'));
        });
    </script>
<?= $this->endSection() ?>