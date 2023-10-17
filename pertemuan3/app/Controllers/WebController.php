<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class WebController extends BaseController
{    
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        return view('v_index', [
            'judul' => "Halaman Depan",
        ]);
    }
}
