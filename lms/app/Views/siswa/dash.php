<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-6 col-lg-7 col-md-12">
            <div class="row">
                <div class="col-lg-6 col-md-4 col-6">
                    <a href="<?= route_to('siswa.jadwal') ?>" class="small-box">
                        <div class="inner">
                            <h3><?= $countJadwal ?></h3>
                            <p>Jadwal Sekolah</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt text-info"></i>
                        </div>
                        <span class="small-box-footer bg-info">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-5 col-md-12">
            <div class="card">
                <div class="card-header">
                    Cara Penggunaan Di-Lemas pada Peran Siswa
                </div>
                <div class="card-body">
                    <div class="alert alert-default-warning">
                        <b>Note:</b> Peran siswa disini hanya melihat materi di kelas yang dia ikuti.
                    </div>
                    <h6><b>Melihat Materi</b></h6>
                    <ol class="m-1 px-3">
                        <li class="mb-1">Silahkan klik menu jadwal di sidebar. Atau klik <a href="<?= route_to('siswa.jadwal') ?>">disini</a>.</li>
                        <li class="mb-1">Lalu klik tombol materi kelas di table jadwal yang kamu pilih.</li>
                        <li class="mb-1">
                            Halaman materi akan muncul, dan kamu bisa 
                            ganti tab materi antara Tab File dan Video (YouTube). Misal materi belum ada berarti guru belum membuat materinya.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>