<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\Request;
use Config\Services;

class AuthController extends BaseController
{    
    /**
     * Display login page.
     *
     * @return void
     */
    public function login()
    {
        $request = $this->request;
        
        if ($request->getPost()) // Jika ada request POST
            $this->processLogin($request);
        
        return view('auth/login', [
            'title' => 'Login'
        ]);
    }
    
    /**
     * Process login request.
     *
     * @param  mixed $request
     * @return void
     */
    private function processLogin($request)
    {
        
    }
}
