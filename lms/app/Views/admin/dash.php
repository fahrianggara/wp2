<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6 col-lg-7 col-md-12">
            <div class="row">
                <div class="col-lg-6 col-md-4 col-6">
                    <a href="<?= route_to('admin.siswa') ?>" class="small-box">
                        <div class="inner">
                            <h3><?= $siswa_count ?></h3>

                            <p>Data Siswa</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-graduate text-primary"></i>
                        </div>
                        <span class="small-box-footer bg-primary">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></span>
                    </a>
                </div>
                <div class="col-lg-6 col-md-4 col-6">
                    <a href="<?= route_to('admin.guru') ?>" class="small-box">
                        <div class="inner">
                            <h3><?= $guru_count ?></h3>

                            <p>Data Guru</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie text-indigo"></i>
                        </div>
                        <span class="small-box-footer bg-indigo">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></span>
                    </a>
                </div>
                <div class="col-lg-6 col-md-4 col-6">
                    <a href="<?= route_to('admin.kelas') ?>" class="small-box">
                        <div class="inner">
                            <h3><?= $kelas_count ?></h3>

                            <p>Data Kelas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chalkboard-teacher text-purple"></i>
                        </div>
                        <span class="small-box-footer bg-purple">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></span>
                    </a>
                </div>
                <div class="col-lg-6 col-md-4 col-6">
                    <a href="<?= route_to('admin.jadwal') ?>" class="small-box">
                        <div class="inner">
                            <h3><?= $jadwal_count ?></h3>

                            <p>Data Jadwal</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt text-red"></i>
                        </div>
                        <span class="small-box-footer bg-red">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></span>
                    </a>
                </div>
                <div class="col-lg-6 col-md-4 col-6">
                    <a href="<?= route_to('admin.mapel') ?>" class="small-box">
                        <div class="inner">
                            <h3><?= $mapel_count ?></h3>

                            <p>Data Mapel</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book text-pink"></i>
                        </div>
                        <span class="small-box-footer bg-pink">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-5 col-md-12">
            <div class="card">
                <div class="card-header">
                    Cara Penggunaan Di-Lemas pada Peran Admin
                </div>
                <div class="card-body">
                    <ol class="m-1 px-3">
                        <li class="mb-1">Buat <a target="_blank" href="<?= route_to('admin.kelas.create') ?>">data kelas</a> terlebih dahulu, minimal ya 2 atau 3 data.</li>
                        <li class="mb-1">Habis itu buat <a target="_blank" href="<?= route_to('admin.mapel.create') ?>">data mata pelajaran</a>, yaa 1 data atau 2 data juga boleh.</li>
                        <li class="mb-1">Jika sudah.. buat <a target="_blank" href="<?= route_to('admin.guru.create') ?>">data guru</a>, minimal 1 data.</li>
                        <li class="mb-1">Dan <a target="_blank" href="<?= route_to('admin.siswa.create') ?>">data siswa</a>, minimal 2 atau 3 data.</li>
                        <li class="mb-1">Yang terakhir buat <a target="_blank" href="<?= route_to('admin.jadwal.create') ?>">data jadwal</a>, minimal 1 data.</li>
                        <li class="mb-1">Sekarang kamu bisa login sebagai siswa atau guru yang kamu buat sebelumnya.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>