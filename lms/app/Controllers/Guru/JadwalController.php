<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\ScheduleModel;

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
        $schedules = $this->scheduleModel->with(['classrooms', 'subjects'])
            ->where('teacher_id', teacher()->id)
            ->findAll();
        
        return view('guru/jadwal/index', [
            'title'     => 'Data Jadwal Sekolah',
            'menu'      => 'jadwal',
            'user'      => $this->auth,
            'schedules' => $schedules,
            'userModel' => $this->userModel,
            'db'        => $this->db
        ]);
    }
}
