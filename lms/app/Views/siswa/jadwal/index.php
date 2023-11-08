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
                                    <th>Hari & Jam Pelajaran</th>
                                    <th>Guru</th>
                                    <th>Mata Pelajaran</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach($schedules as $jadwal): ?>
                                    <?php 
                                        $user = $userModel->where('id', $jadwal->teacher->user_id ?? null)->first();
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span><?= ucfirst($jadwal->day) ?></span>
                                                <small class="text-secondary"><?= time_format($jadwal->start_time) ?> - <?= time_format($jadwal->end_time) ?></small>
                                            </div>
                                        </td>
                                        <td><?= user_info($user) ?></td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span><?= upcase($jadwal->subject->name) ?></span>
                                                <small class="text-secondary"><?= upcase($jadwal->subject->code) ?></small>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="<?= route_to('siswa.materi', base64_encode($jadwal->id)) ?>" 
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-book mr-1"></i> 
                                                Materi Kelas 
                                                <span class="badge badge-pill badge-light ml-1">
                                                    <?= $jadwal->lessons->countAllResults() ?>
                                                </span>
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
        columns: [
            {
                createdCell: function (td) {
                    $(td).css("width", "9%");
                }
            },
            null,
            null,
            null,
            {
                orderable: false,
                searchable: false,
                createdCell: function (td) {
                    $(td).css("width", "16%");
                }
            }
        ],
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