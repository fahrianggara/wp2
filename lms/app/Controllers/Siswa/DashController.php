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
        return view('siswa/dash', [
            'title' => 'Dashboard',
            'menu' => 'dashboard',
            'user'  => $this->auth,
        ]);
    }
}
