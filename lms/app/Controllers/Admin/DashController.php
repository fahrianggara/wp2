<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class DashController extends BaseController
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
        $this->auth = $this->userModel->authUser();
    }

    /**
     * Display admin dashboard page.
     *
     * @return void
     */
    public function index()
    {
        return view('admin/dash', [
            'title' => 'Dashboard',
            'menu' => 'dashboard',
            'user'  => $this->auth,
        ]);
    }
}
