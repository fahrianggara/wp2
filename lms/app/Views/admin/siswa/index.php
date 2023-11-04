<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="mx-2">Data Siswa</span>
                        <a href="<?= route_to('admin.siswa.create') ?>" class="btn btn-success btn-sm ">
                            <i class="fas fa-plus mr-1"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-siswa" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Siswa</th>
                                    <th>Kelas</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Agama</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach($students as $student): ?>
                                    <tr>
                                        <?php 
                                            $classroom_id = $student->students[0]->classroom_id;
                                            $classrooms = new \App\Models\ClassRoomModel();
                                            $classroom = $classrooms->where('id', $classroom_id)->first();
                                        ?>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <div class="user-info">
                                                <img src="<?= $student->getPicture() ?>">
                                                <div class="user-name">
                                                    <span><?= $student->getFullName() ?></span>
                                                    <small><?= $student->id_number ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $classroom->name ?></td>
                                        <td><?= remove_underscore($student->gender) ?></td>
                                        <td><?= ucfirst($student->religion) ?></td>
                                        <td>
                                            <div class="btn-group dropleft">
                                                <button class="btn btn-sm btn-more dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false" data-display="static">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item py-1" href="javascript:void(0);">
                                                        <i class="fas text-warning fa-pen mr-2"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item py-1" href="javascript:void(0);">
                                                        <i class="fas text-danger fa-trash mr-2"></i> Hapus
                                                    </a>
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
    const table = $("#table-siswa").DataTable();
</script>

<?= $this->endSection() ?>