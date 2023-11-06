<div class="active tab-pane fade show" id="information">
    <div class="row">
        <div class="col-md-12">
            <div class="col-lg-7">
                <div class="row align-items-center mb-3">
                    <div class="col-lg-4 col-4">
                        <b>Nama</b>
                    </div>
                    <div class="col-lg-8 col-8">
                        <?= $user->full_name ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="row align-items-center mb-3">
                    <div class="col-lg-4 col-4">
                        <b>Email</b>
                    </div>
                    <div class="col-lg-8 col-8">
                        <?= $user->email ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="row align-items-center mb-3">
                    <div class="col-lg-4 col-4">
                        <b>Jenis Kelamin</b>
                    </div>
                    <div class="col-lg-8 col-8">
                        <?= remove_underscore($user->gender) ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="row align-items-center mb-3">
                    <div class="col-lg-4 col-4">
                        <b>Agama</b>
                    </div>
                    <div class="col-lg-8 col-8">
                        <?= ucfirst($user->religion) ?>
                    </div>
                </div>
            </div>

            <?php if ($user->role === 'teacher'): ?>
                <div class="col-lg-7">
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-4 col-4">
                            <b>NIP</b>
                        </div>
                        <div class="col-lg-8 col-8">
                            <?= $user->id_number ?>
                        </div>
                    </div>
                </div>
            <?php elseif ($user->role === 'student'): ?>
                <div class="col-lg-7">
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-4 col-4">
                            <b>NISN</b>
                        </div>
                        <div class="col-lg-8 col-8">
                            <?= $user->id_number ?>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>