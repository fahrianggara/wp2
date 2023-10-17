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

    /**
     * Display about page.
     * 
     * @return void
     */
    public function about()
    {
        return view('v_about', [
            'judul' => "Halaman About",
        ]);
    }
}
