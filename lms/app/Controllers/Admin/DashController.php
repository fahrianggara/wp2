<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashController extends BaseController
{    
    /**
     * Display admin dashboard page.
     *
     * @return void
     */
    public function index()
    {
        return view('admin/dash', [
            'title' => 'Dashboard'
        ]);
    }
}
