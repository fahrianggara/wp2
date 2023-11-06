<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ClassroomModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Services;

class SiswaController extends BaseController
{    
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {   
        $users = $this->userModel->where('role', 'student')->with(['students'])->findAll();

        return view('admin/siswa/index', [
            'title' => 'Data Siswa',
            'menu' => 'siswa',
            'user' =>  $this->auth,
            'users' => $users,
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
            'classrooms' => (new ClassroomModel())->findAll(),
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
     * Edit the specified resource from storage.
     * 
     * @param string $id
     * @return void
     */
    public function edit(string $id) 
    {
        $id = base64_decode($id);
        $siswa = $this->userModel->where('id', $id)->with(['students'])->first();

        if (!$siswa) // jika siswa tidak ditemukan
            return redirect()->route('admin.siswa')->with('error', 'Data siswa tidak ditemukan.');

        $siswa->classroom_id = $siswa->students[0]->classroom_id; // set classroom_id

        return view('admin/siswa/edit', [
            'title' => 'Edit Siswa',
            'menu' => 'siswa',
            'user' =>  $this->auth,
            'classrooms' => (new ClassroomModel())->findAll(),
            'siswa' => $siswa,
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
        
        if (!$this->validate($this->rules(true, $id))) {
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

            $this->userModel->updateStudent([
                'classroom_id' => $request->getVar('classroom_id'),
            ], $id);

            return redirect()->route('admin.siswa')->with('success', 'Data siswa berhasil diubah.');
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
            $id = $this->request->getPost('id');

            $user = $this->userModel->find($id);
            destroy_file($user->picture, 'images/pictures');
            $this->userModel->delete($id);

            return $this->response->setJSON([
                'status' => 200,
                'message' => 'Data siswa berhasil dihapus.'
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
