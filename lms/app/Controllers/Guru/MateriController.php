<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\ScheduleModel;

class MateriController extends BaseController
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
     * @param string $jadwal_id 
     * @return void
     */
    public function index($jadwal_id)
    {
        $jadwal_id = base64_decode($jadwal_id);
        $schedule = $this->scheduleModel->where("id", $jadwal_id)
            ->with(['classrooms', 'subjects'])
            ->first();

        if (!$schedule) 
            return redirect()->route('guru.jadwal')->with('error', 'Jadwal tidak ditemukan.');
        
        return view('guru/materi/index', [
            'title'     => "Materi - Kelas: " . upcase($schedule->classroom->name) . " | Mapel: {$schedule->subject->name}",
            'menu'      => 'jadwal',
            'user'      => $this->auth,
            'jadwal'    => $schedule,
            'db'        => $this->db
        ]);
    }
}
