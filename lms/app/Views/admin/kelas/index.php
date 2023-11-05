<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="mx-2">Daftar Kelas</span>
                        <a href="<?= route_to('admin.kelas.create') ?>" class="btn btn-success btn-sm ">
                            <i class="fas fa-plus mr-1"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-kelas" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kelas</th>
                                    <th>Daftar Siswa</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach($classrooms as $classroom): ?>
                                    <?php 
                                        $users = $db->table('students')
                                            ->join('classrooms', 'classrooms.id = students.classroom_id', 'LEFT')
                                            ->join('users', 'users.id = students.user_id', 'LEFT')
                                            ->select('users.first_name, users.id_number as number', 'students.classroom_id')
                                            ->where('classroom_id', $classroom->id)
                                            ->get()->getResult();
                                    ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= strtoupper($classroom->name) ?></td>
                                        <td>
                                            <?php foreach($users as $user): ?>
                                                <span class="badge badge-primary">
                                                    <?= "$user->first_name ($user->number)" ?>
                                                </span>
                                            <?php endforeach ?>
                                        </td>
                                        <td>
                                            <div class="btn-group dropleft">
                                                <button class="btn btn-sm btn-more dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false" data-display="static">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="<?= base_url("admin/kelas/edit/" . base64_encode($classroom->id)) ?>" class="dropdown-item py-1">
                                                        <i class="fas text-warning fa-pen mr-2"></i> Edit
                                                    </a>
                                                    <button type="button" value="<?= base64_encode($classroom->id) ?>" class="dropdown-item py-1 btn-delete"
                                                        data-name="<?= strtoupper($classroom->name) ?>"
                                                        data-action="<?= route_to('admin.kelas.destroy') ?>">
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
    const table = $("#table-kelas").DataTable();
</script>

<?= $this->endSection() ?>