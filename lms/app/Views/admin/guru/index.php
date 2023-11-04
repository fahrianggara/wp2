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