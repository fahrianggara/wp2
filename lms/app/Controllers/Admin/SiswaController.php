<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ClassRoomModel;
use Config\Services;

class SiswaController extends BaseController
{    
    protected $userModel, $db, $auth;

    /**
     * constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userModel = new UserModel();
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
        $students = $this->userModel->where('role', 'student')->with(['students'])->findAll();

        return view('admin/siswa/index', [
            'title' => 'Siswa',
            'menu' => 'siswa',
            'user' =>  $this->auth,
            'students' => $students,
        ]);
    }

    /**
     * Display a create form of the resource.
     * 
     * @return void
     */
    public function create()
    {   
        return view('admin/siswa/create', [
            'title' => 'Tambah Siswa',
            'menu' => 'siswa',
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
        $request = $this->request;
        
        if (!$this->validate($this->rules())) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();
        try {
            $this->userModel->save([
                'first_name'    => $request->getVar('first_name'),
                'last_name'     => $request->getVar('last_name'),
                'id_number'     => $request->getVar('id_number'),
                'email'         => $request->getVar('email'),
                'password'      => password_hash($request->getVar('id_number'), PASSWORD_BCRYPT),
                'gender'        => $request->getVar('gender'),
                'religion'      => $request->getVar('religion'),
                'picture'       =>  $this->uploadPicture(),
                'role'          => 'student',
            ]);

            $this->userModel->insertStudent([
                'user_id'      => $this->db->insertID(),
                'classroom_id' => $request->getVar('classroom_id'),
            ]);

            return redirect()->route('admin.siswa')->with('success', 'Data siswa berhasil ditambahkan.');
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        } finally {
            $this->db->transCommit();
        }
    }

    /**
     * Insert picture student to storage.
     * 
     * @return void
     */
    private function uploadPicture()
    {
        $picture = $this->request->getFile('picture');

        if ($picture->getError() == 4) {
            $pictureName = 'picture.png';
        } else {
            $pictureName = $picture->getRandomName();
            Services::image()
                ->withFile($picture)
                ->fit(400, 400, 'center')
                ->convert(IMAGETYPE_JPEG)
                ->save('images/pictures/' . $pictureName);
        }

        return $pictureName;
    }

    /**
     * Message for validation
     * 
     * @return array
     */
    private function rules()
    {
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
                'rules' => 'required|numeric|is_unique[users.id_number]|min_length[8]|max_length[16]',
                'errors' => [
                    'required' => 'Nomer Induk harus diisi.',
                    'numeric' => 'Nomer Induk hanya boleh berisi angka.',
                    'is_unique' => 'Nomer Induk sudah terdaftar.',
                    'min_length' => 'Nomer Induk minimal 8 karakter.',
                    'max_length' => 'Nomer Induk maksimal 16 karakter.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'valid_email' => 'Email tidak valid.',
                    'is_unique' => 'Email sudah terdaftar.'
                ]
            ],
            'religion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Agama siswa harus diisi.'
                ]
            ],
            'classroom_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas siswa harus diisi.'
                ]
            ],
            'picture' => [
                'rules' => 'max_size[picture,2048]|mime_in[picture,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran foto siswa maksimal 2MB.',
                    'mime_in' => 'Format foto siswa harus PNG, JPG, atau JPEG.'
                ]
            ]
        ];
    }
}
