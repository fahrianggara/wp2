<?= $this->extend('layout/dash') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-xl-8 col-lg-9 col-md-12">

            <form action="<?= route_to('admin.jadwal.update') ?>" class="card" 
                autocomplete="off" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= base64_encode($jadwal->id) ?>">
                <input type="hidden" name="_method" value="POST">
                <?= csrf_field() ?>

                <div class="card-header p-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="ml-2 py-1">Form Edit Jadwal Sekolah</span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="day" wajib>Hari</label>

                            <select id="day" name="day" 
                                class="custom-select <?= validation_show_error('day') ? 'is-invalid' : '' ?>">
                                <option value="" disabled selected>Silahkan pilih</option>

                                <option <?= selected_option($jadwal->day, 'senin') ?> value="senin">Senin</option>
                                <option <?= selected_option($jadwal->day, 'selasa') ?> value="selasa">Selasa</option>
                                <option <?= selected_option($jadwal->day, 'rabu') ?> value="rabu">Rabu</option>
                                <option <?= selected_option($jadwal->day, 'kamis') ?> value="kamis">Kamis</option>
                                <option <?= selected_option($jadwal->day, 'jumat') ?> value="jumat">Jumat</option>
                                <option <?= selected_option($jadwal->day, 'sabtu') ?> value="sabtu">Sabtu</option>
                                <option <?= selected_option($jadwal->day, 'minggu') ?> value="minggu">Minggu</option>
                            </select>

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('day') ?>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="teacher_id" wajib>Guru</label>

                            <select name="teacher_id" id="teacher_id" data-fetch="<?= route_to('admin.jadwal.fetch') ?>"
                                class="custom-select <?= validation_show_error('teacher_id') ? 'is-invalid' : '' ?>">
                                <?php foreach ($teachers as $teacher) : ?>
                                    <option <?= selected_option($jadwal->teacher_id, $teacher->id) ?> value="<?= $teacher->id ?>">
                                        <?= "{$teacher->user->first_name} - {$teacher->user->id_number}" ?>
                                    </option>
                                <?php endforeach ?>
                            </select>

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('teacher_id') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="classroom_id" wajib>Kelas</label>

                            <select name="classroom_id" id="classroom_id"
                                class="custom-select <?= validation_show_error('classroom_id') ? 'is-invalid' : '' ?>">
                            </select>

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('classroom_id') ?>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="subject_id" wajib>Mata Pelajaran</label>

                            <select name="subject_id" id="subject_id"
                                class="custom-select <?= validation_show_error('subject_id') ? 'is-invalid' : '' ?>">
                            </select>

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('subject_id') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="start_time" wajib>Jam Mulai</label>

                            <input type="time" name="start_time" id="start_time" value="<?= $jadwal->start_time ?>"
                                class="form-control <?= validation_show_error('start_time') ? 'is-invalid' : '' ?>">
                                
                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('start_time') ?>
                            </div>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="end_time" wajib>Jam Selesai</label>

                            <input type="time" name="end_time" id="end_time" value="<?= $jadwal->end_time ?>"
                                class="form-control <?= validation_show_error('end_time') ? 'is-invalid' : '' ?>">

                            <div class="invalid-feedback d-block">
                                <?= validation_show_error('end_time') ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer p-2 ">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="<?= route_to('admin.jadwal') ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-sm btn-warning">
                            Perbarui Data
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>
    $(document).ready(function () {
        const teacherSelect = $('#teacher_id');
        const classroomSelect = $('#classroom_id');
        const subjectSelect = $('#subject_id');
        const selectedClassroom = null, selectedSubject = null;
        const subjectId = "<?= $jadwal->subject_id ?>";
        const classroomId = "<?= $jadwal->classroom_id ?>";
        
        select_teacher(subjectId, classroomId);
        teacherSelect.val("<?= $jadwal->teacher_id ?>").trigger('change');

        /**
         * Select teacher and show the class and subject options
         *
         * @return {void}
         */
        function select_teacher(subjectId, classroomId) 
        {
            selectedSubjectId = subjectId;
            selectedClassroomId = classroomId;

            teacherSelect.on("change", function () {
                const teacher_id = $(this).val();
                const url = $(this).data('fetch');

                $.ajax({
                    type: "GET",
                    url: url,
                    data: { teacher_id },
                    dataType: "JSON",
                    success: function (res) {
                        selectOptions(res.classrooms, classroomSelect, selectedClassroomId);
                        selectOptions(res.subjects, subjectSelect, selectedSubjectId);
                    }
                });
            });
        }

        /**
         * Select options for select element
         *
         * @param {*} data
         * @param {*} target
         * @param {*} selectedId
         */
        function selectOptions(data, target, selectedId) 
        {
            var options = data.map(item => {
                var select = (item.id === selectedId) ? "selected" : "";
                return `<option value='${item.id}' ${select}>${item.name.toUpperCase()}</option>`;
            }).join('');

            target.html(options);
        }
    });
</script>

<?= $this->endSection() ?>
