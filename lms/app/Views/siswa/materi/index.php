<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="<?= route_to('siswa.jadwal') ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab_file" data-toggle="tab">
                                Materi Tambahan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab_youtube" data-toggle="tab">
                                Video Pembelajaran
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <?= $this->include('siswa/materi/tab-file') ?>
                <?= $this->include('siswa/materi/tab-video') ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>
    $(document).ready(function () {
        var activeTabLesson = localStorage.getItem('activeTabLesson');

        if (activeTabLesson) 
            $('a[href="' + activeTabLesson + '"]').tab('show');
        
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var activeTabLesson = $(e.target).attr('href');
            localStorage.setItem('activeTabLesson', activeTabLesson);
        });
    });
</script>

<?= $this->endSection() ?>