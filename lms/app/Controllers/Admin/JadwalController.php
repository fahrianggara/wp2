<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ScheduleModel;
use App\Models\TeacherModel;

class JadwalController extends BaseController
{    
    protected $scheduleModel;

    /**
     * constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->scheduleModel = new ScheduleModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $schedules = $this->scheduleModel->findAll();
        
        return view('admin/jadwal/index', [
            'title'     => 'Data Jadwal Sekolah',
            'menu'      => 'jadwal',
            'user'      => $this->auth,
            'schedules' => $schedules,
            'db'        => $this->db
        ]);
    }
}
