<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class DashController extends BaseController
{    
    protected $userModel, $db;

    /**
     * ProfileController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db = \Config\Database::connect();
    }

    /**
     * Display admin dashboard page.
     *
     * @return void
     */
    public function index()
    {
        $user = $this->userModel->where('id', session()->get('id'))->first();

        return view('admin/dash', [
            'title' => 'Dashboard',
            'menu' => 'dashboard',
            'user' => $user
        ]);
    }
}
