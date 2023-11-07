<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="<?= route_to('guru.jadwal') ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Kembali
                        </a>
                        <a href="<?= route_to('guru.materi.create', base64_encode($jadwal->id)) ?>" 
                            class="btn btn-sm btn-success">
                            <i class="fas fa-plus mr-1"></i>
                            Materi
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mb-2">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link " href="#tab_file" data-toggle="tab">
                                Materi Tambahan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab_video" data-toggle="tab">
                                Video Pembelajaran
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <?= $this->include('guru/materi/tab-file') ?>
                <?= $this->include('guru/materi/tab-video') ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>