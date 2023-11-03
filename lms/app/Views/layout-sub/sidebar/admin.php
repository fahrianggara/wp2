<li class="nav-header">Menu</li>

<li class="nav-item">
    <a href="<?= route_to('admin.dash') ?>"
        class="nav-link <?= $menu === 'dashboard' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link <?= $menu === 'profile' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Profile
        </p>
    </a>
</li>

<li class="nav-header">Master Data</li>

<li class="nav-item">
    <a href="<?= route_to('admin.siswa') ?>"
        class="nav-link <?= $menu === 'siswa' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-user-graduate"></i>
        <p>
            Siswa
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link <?= $menu === 'guru' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-user-tie"></i>
        <p>
            Guru
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link <?= $menu === 'kelas' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-chalkboard-teacher"></i>
        <p>
            Kelas
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link <?= $menu === 'mapel' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>
            Jadwal Kelas
        </p>
    </a>
</li>

<li class="nav-header">Aksi</li>

<li class="nav-item">
    <a href="<?= route_to('logout') ?>" class="nav-link bg-danger" id="btn-logout">
        <i class="nav-icon fas fa-sign-out-alt "></i>
        <p>
            Logout
        </p>
    </a>
</li>