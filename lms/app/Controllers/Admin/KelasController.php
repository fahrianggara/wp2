<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ClassroomModel;
use App\Models\UserModel;

class KelasController extends BaseController
{    
    protected $userModel, $db, $auth, $classroomModel;

    /**
     * constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->classroomModel = new ClassroomModel();
        $this->db = \Config\Database::connect();
        $this->userModel = new UserModel();
        $this->auth = $this->userModel->authUser();
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $classrooms = $this->classroomModel->findAll();
        
        return view('admin/kelas/index', [
            'title' => 'Data Kelas',
            'menu'  => 'kelas',
            'user'  => $this->auth,
            'classrooms' => $classrooms,
            'db'    => $this->db
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return void
     */
    public function create()
    {
        return view('admin/kelas/create', [
            'title' => 'Tambah Kelas',
            'menu' => 'kelas',
            'user' =>  $this->auth,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @return void
     */
    public function store()
    {
        if (!$this->validate($this->rules())) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();
        try {
            $request = $this->request;
            
            $this->classroomModel->save([
                'name'    => trim(strtolower($request->getVar('name'))),
            ]);

            return redirect()->route('admin.kelas')->with('success', 'Data kelas berhasil ditambahkan.');
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        } finally {
            $this->db->transCommit();
        }
    }

    /**
     * Create rules validation.
     * 
     * @param  mixed $id
     * @return array
     */
    public function rules($id = null)
    {
        $unique = $id ? ",id,$id" : '';

        return [
            'name' => [
                'rules' => "required|is_unique[classrooms.name$unique]|max_length[20]",
                'errors' => [
                    'required' => 'Nama kelas harus diisi.',
                    'is_unique' => 'Nama kelas sudah ada.',
                    'max_length' => 'Nama kelas maksimal 20 karakter.'
                ]
            ]
        ];
    }
}
