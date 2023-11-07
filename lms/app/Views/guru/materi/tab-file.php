<div class=" tab-pane fade show" id="tab_file">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-materi" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Lampiran</th>
                            <th>Dibuat pada</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->section('js') ?>

<script>
    const table = $("#table-materi").DataTable();
</script>

<?= $this->endSection() ?>

