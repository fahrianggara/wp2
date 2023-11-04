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
                                        ?>
                                        <td><?= $no++ ?></td>
                                        <td><?= user_info($user) ?></td>
                                        <td><?= $teacher->code ?></td>
                                        <td>
                                            <?php foreach ($classes as $class): ?>
                                                <span class="badge badge-primary">
                                                    <?= $db->table('classrooms')->where('id', $class->classroom_id)->get()->getRow()->name; ?>
                                                </span>
                                            <?php endforeach ?>
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
                                                    <button type="button" value="<?= $user->id ?>" class="dropdown-item py-1 btn-delete"
                                                        data-name="<?= full_name($user) ?>" data-nis="<?= $user->id_number ?>" 
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
</script>

<?= $this->endSection() ?>