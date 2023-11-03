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
                $error = ['errIdNumber' => 'Nomer induk tidak ditemukan!'];
                $session->setFlashdata($error);
                return redirect()->back()->withInput();
            }
    
            if (!password_verify($password, $user->password)) {
                $error = ['errIdNumber' => 'Kata sandi salah!'];
                $session->setFlashdata($error);
                return redirect()->back()->withInput();
            } 

            $session->set([
                'id' => $user->id,
                'role' => $user->role,
                'logged_in' => true
            ]);

            switch ($session->role) {
                case 'admin':
                    $session->setFlashdata('msg', 'Selamat datang, Admin!');
                    return redirect()->route('admin.dash');
                    break;
                case 'teacher':
                    $session->setFlashdata('msg', 'Selamat datang, Guru!');
                    return redirect()->route('guru.dash');
                    break;
                case 'student':
                    $session->setFlashdata('msg', 'Selamat datang, Siswa!');
                    return redirect()->route('siswa.dash');
                    break;
                default:
                    $session->destroy();
                    return redirect()->route('login')->with('err', 'Role tidak ditemukan!');
                    break;
            }
        } catch (\Throwable $th) {
            $db->transRollback();

            $session->setFlashdata('err', $th->getMessage());
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
        return redirect()->route('login')->with('msg', 'Anda telah keluar!');
    }
}
