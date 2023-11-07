<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="mx-2 p-1">Daftar Jadwal Sekolah Anda</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-jadwal" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hari</th>
                                    <th>Kelas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach($schedules as $jadwal): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span><?= ucfirst($jadwal->day) ?></span>
                                                <small class="text-secondary"><?= time_format($jadwal->start_time) ?> - <?= time_format($jadwal->end_time) ?></small>
                                            </div>
                                        </td>
                                        <td><?= $jadwal->classroom ? upcase($jadwal->classroom->name) : "<span class='badge badge-danger'>Kosong</span>" ?></td>
                                        <td><?= $jadwal->subject ? upcase($jadwal->subject->name) : "<span class='badge badge-danger'>Kosong</span>" ?></td>
                                        <td>
                                            <a href="<?= route_to('guru.materi', base64_encode($jadwal->id)) ?>" class="btn btn-primary btn-sm" 
                                                data-toggle="tooltip" title="Materi">
                                                <i class="fas fa-book"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>
    const table = $("#table-jadwal").DataTable({
        fnDrawCallback: function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover'
            }).on('click', function () {
                $(this).tooltip('hide');
            });
        }
    });
</script>

<?= $this->endSection() ?>