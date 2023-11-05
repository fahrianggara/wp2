<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="mx-2">Daftar Mata Pelajaran</span>
                        <a href="<?= route_to('admin.mapel.create') ?>" class="btn btn-success btn-sm ">
                            <i class="fas fa-plus mr-1"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-mapel" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kode Mapel</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1 ?>
                                <?php foreach($subjects as $subject): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $subject->name ?></td>
                                        <td><?= $subject->code ?></td>
                                        <td>
                                            <div class="btn-group dropleft">
                                                <button class="btn btn-sm btn-more dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false" data-display="static">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="<?= base_url("admin/mapel/edit/" . base64_encode($subject->id)) ?>" class="dropdown-item py-1">
                                                        <i class="fas text-warning fa-pen mr-2"></i> Edit
                                                    </a>
                                                    <button type="button" value="<?= base64_encode($subject->id) ?>" class="dropdown-item py-1 btn-delete"
                                                        data-name="<?= strtoupper($subject->name) ?>"
                                                        data-action="<?= route_to('admin.mapel.destroy') ?>">
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
    const table = $("#table-mapel").DataTable();
    const btnDelete = $(".btn-delete");

    btnDelete.on("click", function(e) {
        e.preventDefault();

        const id = $(this).val();
        const name = $(this).data("name");
        const action = $(this).data("action");

        Swal.fire({
            title: 'Apakah anda yakin?',
            html: `Akan menghapus data mapel <b>${name}</b>`,
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