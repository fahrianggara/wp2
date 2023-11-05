<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SubjectModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class MapelController extends BaseController
{    
    protected $userModel, $db, $auth, $subjectModel;

    /**
     * constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->subjectModel = new SubjectModel();
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
        $subjects = $this->subjectModel->findAll();
        
        return view('admin/mapel/index', [
            'title' => 'Data Mata Pelajaran',
            'menu'  => 'mapel',
            'user'  => $this->auth,
            'subjects' => $subjects,
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
        return view('admin/mapel/create', [
            'title' => 'Tambah Mata Pelajaran',
            'menu' => 'mapel',
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

            $this->subjectModel->save([
                'name'    => $request->getVar('name'), 
                'code'    => trim(strtolower($request->getVar('code'))),
            ]);

            return redirect()->route('admin.mapel')->with('success', 'Data mapel berhasil ditambahkan.');
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

            $this->subjectModel->delete($id); 

            return $this->response->setJSON([
                'status' => 200,
                'message' => 'Data mapel berhasil dihapus.'
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
                'rules' => "required|max_length[255]",
                'errors' => [
                    'required' => 'Nama mapel harus diisi.',
                    'max_length' => 'Nama mapel maksimal 255 karakter.'
                ]
            ],
            'code' => [
                'rules' => "required|is_unique[subjects.code$unique]|max_length[30]",
                'errors' => [
                    'required' => 'Kode mapel harus diisi.',
                    'is_unique' => 'Kode mapel sudah ada.',
                    'max_length' => 'Kode mapel maksimal 30 karakter.'
                ]
            ]
        ];
    }
}
