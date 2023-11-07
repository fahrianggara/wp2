<div class="active tab-pane fade show" id="tab_video">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2">Lorem Ipsum Dolor</span>
                        <div class="btn-group dropleft">
                            <button class="btn btn-sm btn-more dropdown-toggle"
                                data-toggle="dropdown" aria-expanded="false" data-display="static">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="<?= route_to('guru.materi.edit', base64_encode($jadwal->id)) ?>" class="dropdown-item py-1">
                                    <i class="fas text-warning fa-pen mr-2"></i> Edit
                                </a>
                                <button type="button" value="<?= base64_encode($user->id) ?>" class="dropdown-item py-1 btn-delete"
                                    data-action="<?= route_to('admin.guru.destroy') ?>">
                                    <i class="fas text-danger fa-trash mr-2"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 d-flex">
                    <iframe width="100%" height="205" src="https://www.youtube.com/embed/59fzO8BIwDg" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="card-footer p-3">
                    <small class="text-muted position-relative" style="bottom: 7px;">
                        <i class="fas fa-clock mr-1"></i>
                        Senin, 12 Oktober 2020 - 01:00 WIB
                    </small>
                    <p class="m-0">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit, neque. Necessitatibus repellat reprehenderit repudiandae voluptatibus? Exercitationem amet magnam, ratione sequi temporibus dignissimos numquam culpa vero dolores? Quasi a maiores odit?
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>