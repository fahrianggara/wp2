<aside class="main-sidebar sidebar-light-primary elevation-4">

    <a href="javascript:void(0)" class="brand-link text-center d-flex align-items-center">
        <i class="fa fa-graduation-cap fa-lg px-0 brand-image text-primary"></i>
        <span class="brand-text font-weight-bold">Di-Lemas</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="<?= base_url('images/avatar.png') ?>" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    Ilham Ramadan
                </a>
                <small class="text-secondary">
                    10220001
                </small>
            </div>
        </div>


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <?php if (session()->get('role') === 'admin'): ?>
                    <?= $this->include('layout-sub/sidebar/admin') ?>
                <?php elseif (session()->get('role') === 'teacher'): ?>
                    <?= $this->include('layout-sub/sidebar/teacher') ?>
                <?php elseif (session()->get('role') === 'student'): ?>
                    <?= $this->include('layout-sub/sidebar/student') ?>
                <?php endif; ?>

            </ul>
        </nav>

    </div>
</aside>
