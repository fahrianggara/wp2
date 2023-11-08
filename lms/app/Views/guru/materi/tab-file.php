<div class="active tab-pane fade show" id="tab_file">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-materi" class="table table-hover not-wrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Lampiran</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach($lessonFs as $materi): ?>
                            <?php if ($materi->type === 'file'): ?>
                                <?php 
                                    $materi_id = base64_encode($materi->id);
                                    $jadwal_id = base64_encode($jadwal->id);    
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $materi->name ?></td>
                                    <td><?= $materi->description ?></td>
                                    <td>
                                        <a href="<?= base_url("file/materi/$materi->attachment") ?>" target="_blank"
                                            class="btn btn-primary btn-sm" data-toggle="tooltip" title="Buka Materi">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button class="btn btn-sm btn-more dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false" data-display="static">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="<?= base_url("guru/materi/edit/$materi_id/$jadwal_id") ?>"
                                                    class="dropdown-item py-1">
                                                    <i class="fas text-warning fa-pen mr-2"></i> Edit
                                                </a>
                                                <button type="button" value="<?= base64_encode($materi->id) ?>"
                                                    class="dropdown-item py-1" id="btn-delete"
                                                    data-action="<?= route_to('guru.materi.destroy') ?>">
                                                    <i class="fas text-danger fa-trash mr-2"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->section('js') ?>

<script>
    const table = $("#table-materi").DataTable({
        columns: [
            {
                createdCell: function (td) {
                    $(td).css("width", "7%");
                }
            },
            {
                createdCell: function (td) {
                    $(td).css("width", "16%");
                }
            },
            {
                createdCell: function (td) {
                    $(td).css("width", "60%");
                }
            },
            {
                className: "text-center",
                createdCell: function (td) {
                    $(td).css("width", "12%");
                }
            },
            {
                searchable: false,
                orderable: false,
                createdCell: function (td) {
                    $(td).css("width", "7%");
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

