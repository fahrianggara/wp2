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
                                    <span class="ml-2 text-truncate p-1"><?= $materi->name ?></span>
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