<div class="tab-pane fade show" id="tab_youtube">
    <div class="row">
        <?php if ($lessonYs): ?>
            <?php foreach ($lessonYs as $materi): ?>
                <?php if ($materi->type === 'youtube'): ?>
                    <?php 
                        $materi_id = base64_encode($materi->id);
                        $jadwal_id = base64_encode($jadwal->id);    
                    ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header p-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="ml-2 text-truncate"><?= $materi->name ?></span>
                                    <div class="btn-group dropleft">
                                        <button class="btn btn-sm btn-more dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false" data-display="static">
                                            <i class="fas fa-ellipsis-h"></i>
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
                                </div>
                            </div>
                            <div class="card-body p-0 d-flex">
                                <iframe width="100%" height="205" src="https://www.youtube.com/embed/<?= $materi->attachment ?>" frameborder="0"
                                    allowfullscreen></iframe>
                            </div>
                            <div class="card-footer p-3">
                                <small class="text-muted position-relative" style="bottom: 7px;">
                                    <i class="fas fa-clock mr-1"></i>
                                    <?= time_full($materi->created_at) ?>
                                </small>
                                <p class="m-0">
                                    <?= $materi->description ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        <?php else: ?>
            <div class="col-md-12">
                <div class="alert alert-default-warning">
                    <i class="fas fa-info-circle mr-1"></i>
                    Belum ada materi video.
                </div>
            </div>
        <?php endif ?>
    </div>
</div>