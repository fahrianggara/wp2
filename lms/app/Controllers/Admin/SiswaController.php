<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class SiswaController extends BaseController
{    
    protected $userModel, $db;

    /**
     * constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $user = $this->userModel->where('id', session()->get('id'))->first();
        
        return view('admin/siswa/index', [
            'title' => 'Siswa',
            'menu' => 'siswa',
            'user' => $user,
        ]);
    }
}
