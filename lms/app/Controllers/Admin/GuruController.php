<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ClassroomModel;
use App\Models\SubjectModel;
use App\Models\TeacherModel;
use App\Models\UserModel;
use Carbon\Carbon;
use CodeIgniter\Exceptions\PageNotFoundException;

class GuruController extends BaseController
{    
    protected $teacherModel;

    /**
     * constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->teacherModel = new TeacherModel();
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
            'classrooms' => (new ClassroomModel())->findAll(),
            'subjects' => (new SubjectModel())->findAll(),
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

            $insertId = $this->db->insertID();

            $this->teacherModel->syncSubjects($insertId, $request->getVar('subject_ids'));
            $this->teacherModel->syncClassrooms($insertId, $request->getVar('classroom_ids'));

            return redirect()->route('admin.guru')->with('success', 'Data guru berhasil ditambahkan.');
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
        $user = $this->userModel->where('id', $id)->with(['teachers'])->first();

        if (!$user) // jika guru tidak ditemukan
            return redirect()->route('admin.guru')->with('error', 'Data guru tidak ditemukan.');
        
        $guru = $user->teachers[0]; // get teacher
        $user->code = $guru->code; // set code
        $teacher_classrooms = $this->db->table('teacher_classrooms')->where('teacher_id', $guru->id)->get()->getResult();
        $teacher_subjects = $this->db->table('teacher_subjects')->where('teacher_id', $guru->id)->get()->getResult();

        // get classroom ids
        $classroom_ids = [];
        foreach ($teacher_classrooms as $tc) $classroom_ids[] = $tc->classroom_id;

        // get subject ids
        $subject_ids = [];
        foreach ($teacher_subjects as $tc) $subject_ids[] = $tc->subject_id;
        
        return view('admin/guru/edit', [
            'title' => 'Edit Guru',
            'menu' => 'guru',
            'user' =>  $this->auth,
            'classrooms' => (new ClassroomModel())->findAll(),
            'classroom_ids' => $classroom_ids,
            'subjects' => (new SubjectModel())->findAll(),
            'subject_ids' => $subject_ids,
            'guru' => $user,
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
        $tc_id = $this->db->table('teachers')->where('user_id', $id)->get()->getRow()->id;
        
        if (!$this->validate($this->rules(true, $id, $tc_id))) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();
        try {
            $old_picture = $request->getVar('old_picture');
            $pictureName = ($request->getFile('picture') !== 4)
                ? upload_picture($request,'images/pictures', $old_picture, true)
                : $old_picture;

            $this->userModel->save([
                'id'            => $id, // set id agar tidak error 'id tidak boleh kosong
                'first_name'    => $request->getVar('first_name'),
                'last_name'     => $request->getVar('last_name'),
                'id_number'     => $request->getVar('id_number'),
                'email'         => $request->getVar('email'),
                'gender'        => $request->getVar('gender'),
                'religion'      => $request->getVar('religion'),
                'picture'       => $pictureName,
            ]);

            $this->userModel->updateTeacher([
                'code' => $request->getVar('code')
            ], $id);

            $this->teacherModel->syncClassrooms($tc_id, $request->getVar('classroom_ids'));
            $this->teacherModel->syncSubjects($tc_id, $request->getVar('subject_ids'));

            return redirect()->route('admin.guru')->with('success', 'Data guru berhasil diubah.');
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

            $user = $this->userModel->find($id);
            destroy_file($user->picture, 'images/pictures');
            $this->userModel->delete($id);

            return $this->response->setJSON([
                'status' => 200,
                'message' => 'Data guru berhasil dihapus.'
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
     * Message for validation
     * 
     * @param boolean $edit
     * @param string|null $id
     * @param string|null $tc_id
     * @return array
     */
    private function rules($edit = false, $id = null, $tc_id = null)
    {
        $unique = $edit ? ",id,$id" : '';
        $uqCode = $edit ? ",id,$tc_id": '';

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
            'subject_ids' => [
                'rules' => 'required',
                'errors'=> [
                    'required' => 'Mata pelajaran guru harus diisi.'
                ]
            ],
            'code' => [
                'rules' => "required|min_length[3]|max_length[5]|is_unique[teachers.code$uqCode]",
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
