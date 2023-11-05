<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ClassroomModel;
use App\Models\UserModel;

class KelasController extends BaseController
{    
    protected $userModel, $db, $auth, $classroomModel;

    /**
     * constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->classroomModel = new ClassroomModel();
        $this->db = \Config\Database::connect();
        $this->userModel = new UserModel();
        $this->auth = $this->userModel->where('id', session()->get('id'))->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $classrooms = $this->classroomModel->findAll();
        
        return view('admin/kelas/index', [
            'title' => 'Data Kelas',
            'menu'  => 'kelas',
            'user'  => $this->auth,
            'classrooms' => $classrooms,
            'db'    => $this->db
        ]);
    }
}
