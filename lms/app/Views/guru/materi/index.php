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
                <?= $this->include('guru/materi/tab-file') ?>
                <?= $this->include('guru/materi/tab-video') ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>
    $(document).ready(function () {
        const sessionTabLesson = "<?= session()->getFlashdata('tabLesson') ?>";
        var activeTabLesson = localStorage.getItem('activeTabLesson');

        if (sessionTabLesson) {
            $('a[href="' + sessionTabLesson + '"]').tab('show');
            localStorage.setItem('activeTabLesson', sessionTabLesson);
        } else if (activeTabLesson) {
            $('a[href="' + activeTabLesson + '"]').tab('show');
        }
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var activeTabLesson = $(e.target).attr('href');
            localStorage.setItem('activeTabLesson', activeTabLesson);
        });

        // each btn-delete then set click event
        const btnDelete = document.querySelectorAll("#btn-delete");
        for (let i = 0; i < btnDelete.length; i++) {
            btnDelete[i].addEventListener('click', function (e) {
                e.preventDefault();

                const id = $(this).val();
                const action = $(this).data("action");

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    html: `Akan menghapus data materi tersebut?!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: action,
                            type: "POST",
                            data: {
                                id
                            },
                            success: function (res) {
                                if (res.status === 200) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: res.message,
                                        icon: 'success',
                                        allowOutsideClick: false,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        text: res.message,
                                        icon: 'error',
                                        confirmButtonText: 'Tutup',
                                    });
                                }
                            },
                        });
                    }
                });
            });
        }
    });
</script>

<?= $this->endSection() ?>