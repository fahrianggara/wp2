<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="mx-2">Daftar Jadwal Sekolah</span>
                        <a href="<?= route_to('admin.jadwal.create') ?>" class="btn btn-success btn-sm ">
                            <i class="fas fa-plus mr-1"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-jadwal" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hari</th>
                                    <th>Guru</th>
                                    <th>Kelas</th>
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
                                        <td><?= $jadwal->classroom ? upcase($jadwal->classroom->name) : "<span class='badge badge-danger'>Kosong</span>" ?></td>
                                        <td><?= $jadwal->subject ? upcase($jadwal->subject->name) : "<span class='badge badge-danger'>Kosong</span>" ?></td>
                                        <td>
                                            <div class="btn-group dropleft">
                                                <button class="btn btn-sm btn-more dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false" data-display="static">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="<?= base_url("admin/jadwal/edit/" . base64_encode($jadwal->id)) ?>" class="dropdown-item py-1">
                                                        <i class="fas text-warning fa-pen mr-2"></i> Edit
                                                    </a>
                                                    <button type="button" value="<?= base64_encode($jadwal->id) ?>" class="dropdown-item py-1 btn-delete"
                                                        data-action="<?= route_to('admin.jadwal.destroy') ?>">
                                                        <i class="fas text-danger fa-trash mr-2"></i> Hapus
                                                    </button>
                                                </div>
                                            </div>
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
    const table = $("#table-jadwal").DataTable();
    const btnDelete = $(".btn-delete");

    btnDelete.on("click", function(e) {
        e.preventDefault();

        const id = $(this).val();
        const action = $(this).data("action");

        Swal.fire({
            title: 'Apakah anda yakin',
            html: `Akan menghapus data jadwal tersebut?!`,
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
                    data: {id: id},
                    success: function(res) {
                        if (res.status === 200) {
                            Swal.fire({
                                title: 'Berhasil!',
                                html: res.message,
                                icon: 'success',
                                allowOutsideClick: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                html: res.message,
                                icon: 'error',
                                confirmButtonText: 'Tutup',
                            });
                        }
                    },
                });
            }
        });
    });
</script>

<?= $this->endSection() ?>