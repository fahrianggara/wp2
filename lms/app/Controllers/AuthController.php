<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
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
        $userModel = new UserModel();
        
        return view('auth/login', [
            'title' => 'Login',
            'users' => $userModel->findAll(3)
        ]);
    }
    
    /**
     * Process login request.
     *
     * @param  mixed $request
     * @return void
     */
    public function processLogin()
    {
        $validation = Services::validation();
        $session = session();
        $db = db_connect();
        $request = $this->request;

        $validate = [
            'id_number' => [
                'rules' => 'required|numeric|min_length[8]|max_length[16]',
                'errors' => [
                    'required' => 'Nomer induk tidak boleh kosong!',
                    'numeric' => 'Nomer induk harus berupa angka!',
                    'min_length' => 'Nomer induk minimal 8 karakter!',
                    'max_length' => 'Nomer induk maksimal 16 karakter!'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => ['required' => 'Kata sandi tidak boleh kosong!']
            ]
        ];

        if (!$this->validate($validate)) {
            $error = [
                'errIdNumber' => $validation->getError('id_number'),
                'errPassword' => $validation->getError('password')
            ];

            $session->setFlashdata($error);
            return redirect()->back()->withInput();
        }

        $db->transBegin();
        try {
            $id_number = $request->getVar('id_number');
            $password = $request->getVar('password');

            $userModel = new UserModel();
            $user = $userModel->where('id_number', $id_number)->first();

            if (!$user) {
                $session->setFlashdata('error', 'Nomer induk tidak ditemukan!');
                return redirect()->back()->withInput();
            }
    
            if (!password_verify($password, $user->password)) {
                $session->setFlashdata('error', 'Kata sandi salah!');
                return redirect()->back()->withInput();
            } 

            $session->set([
                'id' => $user->id,
                'role' => $user->role,
                'logged_in' => true
            ]);

            $full_name = full_name($user);

            switch ($session->role) {
                case 'admin':
                    $session->setFlashdata('info', "Selamat datang, $full_name!");
                    return redirect()->route('admin.dash');
                    break;
                case 'teacher':
                    $session->setFlashdata('info', "Selamat datang, $full_name!");
                    return redirect()->route('guru.dash');
                    break;
                case 'student':
                    $session->setFlashdata('info', "Selamat datang, $full_name!");
                    return redirect()->route('siswa.dash');
                    break;
                default:
                    $session->destroy();
                    return redirect()->route('login')->with('error', 'Role tidak ditemukan!');
                    break;
            }
        } catch (\Throwable $th) {
            $db->transRollback();

            $session->setFlashdata('error', $th->getMessage());
            return redirect()->back()->withInput();
        } finally {
            $db->transCommit();
        }
    }

    /**
     * Logout user.
     *
     * @return void
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->route('login')->with('info', 'Anda telah keluar dari aplikasi!');
    }
}
