<?php

namespace App\Controllers\Guru;

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
        $countJadwal = $this->db->table('teachers')
            ->join('teacher_classrooms', 'teacher_classrooms.teacher_id = teachers.id')
            ->join('classrooms', 'classrooms.id = teacher_classrooms.classroom_id')
            ->join('schedules', 'schedules.classroom_id = classrooms.id')
            ->where('teachers.user_id', $this->auth->id)
            ->countAllResults();

        return view('guru/dash', [
            'title' => 'Dashboard',
            'menu' => 'dashboard',
            'user'  => $this->auth,
            'countJadwal' => $countJadwal,
        ]);
    }
}
