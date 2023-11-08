<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\LessonModel;
use App\Models\ScheduleModel;

class MateriController extends BaseController
{   
    protected $scheduleModel, $lessonModel;
    
    /**
     * constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->scheduleModel = new ScheduleModel();
        $this->lessonModel   = new LessonModel();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param string $jadwal_id
     * @return void
     */
    public function index($jadwal_id)
    {
        $jadwal_id = base64_decode($jadwal_id);
        $schedule = $this->scheduleModel->where("id", $jadwal_id)->with(['classrooms', 'subjects'])
            ->first();

        if (!$schedule) 
            return redirect()->route('siswa.jadwal')->with('error', 'Jadwal tidak ditemukan.');

        return view('siswa/materi/index', [
            'title'     => "Materi - Kelas: " . upcase($schedule->classroom->name) . " ({$schedule->subject->name})",
            'menu'      => 'jadwal',
            'user'      => $this->auth,
            'jadwal'    => $schedule,
            'lessonFs'  => $this->lessonModel->where('subject_id', $schedule->subject->id)->where('type', 'file')->findAll(),
            'lessonYs'  => $this->lessonModel->where('subject_id', $schedule->subject->id)->where('type', 'youtube')->findAll(),
            'db'        => $this->db
        ]);
    }
}
