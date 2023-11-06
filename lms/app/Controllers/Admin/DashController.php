<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ClassroomModel;
use App\Models\ScheduleModel;
use App\Models\StudentModel;
use App\Models\SubjectModel;
use App\Models\TeacherModel;

class DashController extends BaseController
{   
    /**
     * Display admin dashboard page.
     *
     * @return void
     */
    public function index()
    {
        return view('admin/dash', [
            'title' => 'Dashboard',
            'menu' => 'dashboard',
            'user'  => $this->auth,
            'siswa_count' => (new StudentModel())->countAll(),
            'guru_count' => (new TeacherModel())->countAll(),
            'kelas_count' => (new ClassroomModel())->countAll(),
            'mapel_count' => (new SubjectModel())->countAll(),
            'jadwal_count' => (new ScheduleModel())->countAll(),
        ]);
    }
}
