<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ClassRoomModel;
use App\Models\TeacherModel;
use App\Models\UserModel;
use Carbon\Carbon;

class GuruController extends BaseController
{    
    protected $userModel, $db, $auth, $teacherModel;

    /**
     * constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->teacherModel = new TeacherModel();
        $this->db = \Config\Database::connect();
        $this->auth = $this->userModel->where('id', session()->get('id'))->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $users = $this->userModel->where('role', 'teacher')->with(['teachers'])->findAll();
        
        return view('admin/guru/index', [
            'title' => 'Data Guru',
            'menu'  => 'guru',
            'user'  => $this->auth,
            'users' => $users,
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
        return view('admin/guru/create', [
            'title' => 'Tambah Guru',
            'menu' => 'guru',
            'user' =>  $this->auth,
            'classrooms' => (new ClassRoomModel())->findAll(),
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
            $picture = upload_picture($request, 'images/pictures');

            $this->userModel->save([
                'first_name'    => $request->getVar('first_name'),
                'last_name'     => $request->getVar('last_name'),
                'id_number'     => $request->getVar('id_number'),
                'email'         => $request->getVar('email'),
                'password'      => password_hash($request->getVar('id_number'), PASSWORD_BCRYPT),
                'gender'        => $request->getVar('gender'),
                'religion'      => $request->getVar('religion'),
                'picture'       => $picture,
                'role'          => 'teacher',
            ]);

            $this->userModel->insertTeacher([
                'user_id'       => $this->db->insertID(),
                'code'          => $request->getVar('code'),
            ]);

            $this->teacherModel->syncClassrooms($this->db->insertID(), $request->getVar('classroom_ids'));

            return redirect()->route('admin.guru')->with('success', 'Data guru berhasil ditambahkan.');
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        } finally {
            $this->db->transCommit();
        }
    }

    /**
     * Message for validation
     * 
     * @return array
     */
    private function rules($edit = false, $id = null)
    {
        $unique = $edit ? ",id,$id" : '';

        return [
            'first_name' => [
                'rules' => 'required|alpha_space|min_length[3]|max_length[15]',
                'errors' => [
                    'required' => 'Nama Awalan harus diisi.',
                    'alpha_space' => 'Nama Awalan hanya boleh berisi huruf dan spasi.',
                    'min_length' => 'Nama Awalan minimal 3 karakter.',
                    'max_length' => 'Nama Awalan maksimal 15 karakter.'
                ]
            ],
            'last_name' => [
                'rules' => 'required|alpha_space|min_length[3]|max_length[15]',
                'errors' => [
                    'required' => 'Nama Awalan harus diisi.',
                    'alpha_space' => 'Nama Awalan hanya boleh berisi huruf dan spasi.',
                    'min_length' => 'Nama Awalan minimal 3 karakter.',
                    'max_length' => 'Nama Awalan maksimal 15 karakter.'
                ]
            ],
            'id_number' => [
                'rules' => "required|numeric|min_length[8]|max_length[16]|is_unique[users.id_number$unique]",
                'errors' => [
                    'required' => 'Nomer Induk harus diisi.',
                    'numeric' => 'Nomer Induk hanya boleh berisi angka.',
                    'is_unique' => 'Nomer Induk sudah terdaftar.',
                    'min_length' => 'Nomer Induk minimal 8 karakter.',
                    'max_length' => 'Nomer Induk maksimal 16 karakter.'
                ]
            ],
            'email' => [
                'rules' => "required|valid_email|is_unique[users.email$unique]",
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'valid_email' => 'Email tidak valid.',
                    'is_unique' => 'Email sudah terdaftar.'
                ]
            ],
            'religion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Agama guru harus diisi.'
                ]
            ],
            'classroom_ids' => [
                'rules' => 'required',
                'errors'=> [
                    'required' => 'Kelas mengajar guru harus diisi.'
                ]
            ],
            'code' => [
                'rules' => "required|min_length[3]|max_length[5]|is_unique[teachers.code$unique]",
                'errors' => [
                    'required' => 'Kode guru harus diisi.',
                    'min_length' => 'Kode guru minimal 3 karakter.',
                    'max_length' => 'Kode guru maksimal 5 karakter.',
                    'is_unique' => 'Kode guru sudah terdaftar.'
                ]
            ],
            'picture' => [
                'rules' => 'max_size[picture,2048]|mime_in[picture,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran foto guru maksimal 2MB.',
                    'mime_in' => 'Format foto guru harus PNG, JPG, atau JPEG.'
                ]
            ]
        ];
    }
}
