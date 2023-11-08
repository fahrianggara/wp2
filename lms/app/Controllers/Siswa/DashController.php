<?php

namespace App\Controllers\Siswa;

use App\Controllers\BaseController;

class DashController extends BaseController
{    
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $countJadwal = $this->db->table('students')
            ->join('classrooms', 'classrooms.id = students.classroom_id')
            ->join('schedules', 'schedules.classroom_id = classrooms.id')
            ->where('students.user_id', $this->auth->id)
            ->countAllResults();

        return view('siswa/dash', [
            'title' => 'Dashboard',
            'menu' => 'dashboard',
            'user'  => $this->auth,
            'countJadwal' => $countJadwal,
        ]);
    }
}
