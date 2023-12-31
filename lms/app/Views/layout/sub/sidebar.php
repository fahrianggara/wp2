<aside class="main-sidebar sidebar-light-primary elevation-1">

    <a href="javascript:void(0)" class="brand-link text-center d-flex align-items-center">
        <i class="fa fa-graduation-cap fa-lg px-0 brand-image text-primary"></i>
        <span class="brand-text font-weight-bold">Di-Lemas</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="<?= $user->photo ?>" class="img-circle profile-photo" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= route_to('profile') ?>" class="d-block">
                    <?= $user->full_name ?>
                </a>
                <small class="text-secondary">
                    <?= $user->id_number ?>
                </small>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <?php if (session()->get('role') === 'admin'): ?>
                    <?= $this->include('layout/sub/sidebar/admin') ?>
                <?php elseif (session()->get('role') === 'teacher'): ?>
                    <?= $this->include('layout/sub/sidebar/teacher') ?>
                <?php elseif (session()->get('role') === 'student'): ?>
                    <?= $this->include('layout/sub/sidebar/student') ?>
                <?php endif; ?>

                <li class="nav-header">Aksi</li>
                <li class="nav-item">
                    <a href="<?= route_to('logout') ?>" class="nav-link bg-danger" id="btn-logout">
                        <i class="nav-icon fas fa-sign-out-alt "></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>
