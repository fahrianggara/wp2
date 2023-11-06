<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ClassroomModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KelasController extends BaseController
{    
    protected $classroomModel;

    /**
     * constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->classroomModel = new ClassroomModel();
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
     * Edit the specified resource from storage.
     * 
     * @param string $id
     * @return void
     */
    public function edit(string $id) 
    {
        $id = base64_decode($id);
        $kelas = $this->classroomModel->where('id', $id)->first();

        if (!$kelas) // jika kelas tidak ditemukan
            return redirect()->route('admin.kelas')->with('error', 'Data kelas tidak ditemukan.');
        
        return view('admin/kelas/edit', [
            'title' => 'Edit Kelas',
            'menu' => 'kelas',
            'user' =>  $this->auth,
            'kelas' => $kelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @return void
     */
    public function update()
    {
        $request = $this->request;
        $id = base64_decode($request->getVar('id'));
        
        if (!$this->validate($this->rules($id))) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();
        try {
            $this->classroomModel->save([
                'id'      => $id, // set id agar tidak error 'id tidak boleh kosong
                'name'    => trim(strtolower($request->getVar('name'))),
            ]);

            return redirect()->route('admin.kelas')->with('success', 'Data kelas berhasil diubah.');
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        } finally {
            $this->db->transCommit();
        }
    }

    /**
     * Destroy the specified resource from storage.
     * 
     * @return void
     */
    public function destroy()
    {
        if (!$this->request->isAJAX()) //  jika akses lewat url
            throw PageNotFoundException::forPageNotFound(); 

        $this->db->transBegin();
        try {
            $id = base64_decode($this->request->getVar('id'));

            $this->classroomModel->delete($id); 

            return $this->response->setJSON([
                'status' => 200,
                'message' => 'Data kelas berhasil dihapus.'
            ]);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return $this->response->setJSON([
                'status' => 400,
                'message' => $th->getMessage()
            ]);
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
