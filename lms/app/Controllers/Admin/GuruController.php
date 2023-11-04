<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class GuruController extends BaseController
{    
    protected $userModel, $db, $auth;

    /**
     * constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();
        $this->auth = $this->userModel->where('id', session()->get('id'))->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $users = $this->userModel->where('role', 'teacher')->with(['teachers'])->findAll();

        return view('admin/guru/index', [
            'title' => 'Data Guru',
            'menu'  => 'guru',
            'user'  => $this->auth,
            'users' => $users
        ]);
    }
}
