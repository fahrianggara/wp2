<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-user text-primary"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                    <div class="dropdown-header">
                        Ilham Ramadan
                    </div>
                    <a class="dropdown-item" href="javascript:void(0);">
                        <i class="fas fa-user mr-2"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0);">
                        <form action="<?= base_url('logout') ?>" method="post" id="logout-form">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn p-0 dropdown-item" id="btn-logout">
                                <i class="fas fa-sign-out-alt text-danger mr-2"></i> Logout
                            </button>
                        </form>
                    </a>
                </div>
            </div>
        </li>
    </ul>
</nav>
