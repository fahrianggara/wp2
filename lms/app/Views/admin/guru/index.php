<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="mx-2">Daftar Guru</span>
                        <a href="<?= route_to('admin.guru.create') ?>" class="btn btn-success btn-sm ">
                            <i class="fas fa-plus mr-1"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-guru" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Guru</th>
                                    <th>Kode Guru</th>
                                    <th>Kelas Mengajar</th>
                                    <th>Mapel</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Agama</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach($users as $user): ?>
                                    <tr>
                                        <?php 
                                            $teacher = $user->teachers[0];
                                            $classes = $db->table('teacher_classrooms')->where('teacher_id', $teacher->id)->get()->getResult();
                                            $subjects = $db->table('teacher_subjects')->where('teacher_id', $teacher->id)->get()->getResult();
                                        ?>
                                        <td><?= $no++ ?></td>
                                        <td><?= user_info($user) ?></td>
                                        <td><?= $teacher->code ?></td>
                                        <td>
                                            <?php if ($classes): ?>
                                                <?php foreach ($classes as $class): ?>
                                                    <?php $clsName = $db->table('classrooms')->where('id', $class->classroom_id)->get()->getRow()->name; ?>
                                                    <span class="badge badge-primary">
                                                        <?= $clsName ? upcase($clsName) : ''; ?>
                                                    </span>
                                                <?php endforeach ?>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Tidak ada</span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?php if ($subjects): ?>
                                                <?php foreach ($subjects as $row): ?>
                                                    <?php $code = $db->table('subjects')->where('id', $row->subject_id)->get()->getRow()->code; ?>
                                                    <span class="badge badge-primary">
                                                        <?= $code ? upcase($code) : ''; ?>
                                                    </span>
                                                <?php endforeach ?>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Tidak ada</span>
                                            <?php endif ?>
                                        </td>
                                        <td><?= remove_underscore($user->gender) ?></td>
                                        <td><?= ucfirst($user->religion) ?></td>
                                        <td>
                                            <div class="btn-group dropleft">
                                                <button class="btn btn-sm btn-more dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false" data-display="static">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="<?= base_url("admin/guru/edit/" . base64_encode($user->id)) ?>" class="dropdown-item py-1">
                                                        <i class="fas text-warning fa-pen mr-2"></i> Edit
                                                    </a>
                                                    <button type="button" value="<?= base64_encode($user->id) ?>" class="dropdown-item py-1 btn-delete"
                                                        data-name="<?= full_name($user) ?>" data-no_induk="<?= $user->id_number ?>" 
                                                        data-action="<?= route_to('admin.guru.destroy') ?>">
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
    const table = $("#table-guru").DataTable();
    const btnDelete = $(".btn-delete");

    btnDelete.on("click", function(e) {
        e.preventDefault();

        const id = $(this).val();
        const name = $(this).data("name");
        const no_induk = $(this).data("no_induk");
        const action = $(this).data("action");

        Swal.fire({
            title: 'Apakah anda yakin?',
            html: `Akan menghapus data guru <b>${name}</b> dengan NIP <b>${no_induk}</b>`,
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
</script>

<?= $this->endSection() ?>