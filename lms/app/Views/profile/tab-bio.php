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
                <div class="col-lg-7">
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-4 col-4">
                            <b>Kelas Mengajar</b>
                        </div>
                        <div class="col-lg-8 col-8">
                            <?php if ($user->teacher_classrooms): ?>
                                <?php foreach($user->teacher_classrooms as $classroom): ?>
                                    <span class="badge badge-primary"><?= upcase($classroom->name) ?></span>
                                <?php endforeach ?>
                            <?php else: ?>
                                <span class="badge badge-danger">Tidak ada</span>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-4 col-4">
                            <b>Mapel Diampu</b>
                        </div>
                        <div class="col-lg-8 col-8">
                            <?php if ($user->teacher_subjects): ?>
                                <?php foreach($user->teacher_subjects as $subject): ?>
                                    <span class="badge badge-primary"><?= upcase($subject->code) ?></span>
                                <?php endforeach ?>
                            <?php else: ?>
                                <span class="badge badge-danger">Tidak ada</span>
                            <?php endif ?>
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
                <div class="col-lg-7">
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-4 col-4">
                            <b>Kelas</b>
                        </div>
                        <div class="col-lg-8 col-8">
                            <?php if ($user->student_classroom): ?>
                                <span class="badge badge-primary"><?= upcase($user->student_classroom->name) ?></span>
                            <?php else: ?>
                                <span class="badge badge-danger">Tidak ada</span>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>