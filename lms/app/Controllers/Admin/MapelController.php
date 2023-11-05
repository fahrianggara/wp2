<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SubjectModel;
use App\Models\UserModel;

class MapelController extends BaseController
{    
    protected $userModel, $db, $auth, $subjectModel;

    /**
     * constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->subjectModel = new SubjectModel();
        $this->db = \Config\Database::connect();
        $this->userModel = new UserModel();
        $this->auth = $this->userModel->authUser();
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $subjects = $this->subjectModel->findAll();
        
        return view('admin/mapel/index', [
            'title' => 'Data Mata Pelajaran',
            'menu'  => 'mapel',
            'user'  => $this->auth,
            'subjects' => $subjects,
            'db'    => $this->db
        ]);
    }
}
