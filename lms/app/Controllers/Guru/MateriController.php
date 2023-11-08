<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\LessonModel;
use App\Models\ScheduleModel;

class MateriController extends BaseController
{    
    protected $scheduleModel, $lessonModel;
    
    /**
     * constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->scheduleModel = new ScheduleModel();
        $this->lessonModel = new LessonModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $jadwal_id 
     * @return void
     */
    public function index($jadwal_id)
    {
        $jadwal_id = base64_decode($jadwal_id);
        $schedule = $this->scheduleModel->where("id", $jadwal_id)
            ->with(['classrooms', 'subjects'])
            ->first();

        if (!$schedule) 
            return redirect()->route('guru.jadwal')->with('error', 'Jadwal tidak ditemukan.');
        
        return view('guru/materi/index', [
            'title'     => "Materi - Kelas: " . upcase($schedule->classroom->name) . " ({$schedule->subject->name})",
            'menu'      => 'jadwal',
            'user'      => $this->auth,
            'jadwal'    => $schedule,
            'lessonFs'   => $this->lessonModel->where('subject_id', $schedule->subject->id)->where('type', 'file')->findAll(),
            'lessonYs'   => $this->lessonModel->where('subject_id', $schedule->subject->id)->where('type', 'youtube')->findAll(),
            'db'        => $this->db
        ]);
    }

    /**
     * Display create form.
     * 
     * @param string $jadwal_id
     * @return void
     */
    public function create($jadwal_id)
    {
        $schedule = $this->scheduleModel->where("id", base64_decode($jadwal_id))
            ->with(['classrooms', 'subjects'])->first();

        if (!$schedule) 
            return redirect()->route('guru.jadwal')->with('error', 'Jadwal tidak ditemukan.');

        return view('guru/materi/create', [
            'title'     => "Tambah Materi - Kelas: " . upcase($schedule->classroom->name) . " ({$schedule->subject->name})",
            'menu'      => 'jadwal',
            'user'      => $this->auth,
            'jadwal'    => $schedule,
        ]);
    }

    /**
     * Store create form.
     * 
     * @return void
     */
    public function store()
    {
        $request = $this->request;
        $type_materi = $request->getVar('type');

        if (!$this->validate($this->rules($type_materi))) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();
        try {
            $schedule = $this->scheduleModel->where("id", base64_decode($request->getVar('jadwal_id')))
                ->with(['classrooms', 'subjects'])->first();

            ($type_materi === 'file')
                ? $attachment = upload_file($request, 'file/materi')
                : $attachment = $request->getVar('youtube');

            $this->lessonModel->save([
                'name' => $request->getVar('name'),
                'description' => $request->getVar('description'),
                'type' => $type_materi,
                'attachment' => $attachment,
                'subject_id' => $schedule->subject->id,
            ]);

            return redirect()->route('guru.materi', [base64_encode($schedule->id)])
                ->with('success', 'Data materi berhasil ditambahkan.')
                ->with('tabLesson', "#tab_$type_materi");
        } catch (\Throwable $th) {
            $this->db->transRollback();

            return redirect()->back()->withInput()->with('error', $th->getMessage());
        } finally {
            $this->db->transCommit();
        }
    }

    /**
     * Display edit form.
     * 
     * @param string $materi_id
     * @param string $jadwal_id
     * @return void
     */
    public function edit($materi_id, $jadwal_id)
    {
        $materi = $this->lessonModel->where('id', base64_decode($materi_id))->first();
        $schedule = $this->scheduleModel->where('id', base64_decode($jadwal_id))
            ->with(['classrooms', 'subjects'])->first();

        if (!$materi) 
            return redirect()->route('guru.jadwal')->with('error', 'Materi tidak ditemukan.');

        return view('guru/materi/edit', [
            'title'     => "Edit Materi - Kelas: " . upcase($schedule->classroom->name) . " ({$schedule->subject->name})",
            'menu'      => 'jadwal',
            'user'      => $this->auth,
            'jadwal'    => $schedule,
            'materi'    => $materi,
        ]);
    }

    /**
     * Update specified resource.
     * 
     * @return void
     */
    public function update()
    {
        $request = $this->request;
        $type_materi = $request->getVar('type');
        $materi = $this->lessonModel->where('id', base64_decode($request->getVar('materi_id')))->first();
        $schedule = $this->scheduleModel->where('id', base64_decode($request->getVar('jadwal_id')))
            ->with(['classrooms', 'subjects'])->first();

        if (!$this->validate($this->rules($type_materi))) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();
        try {
            $path = 'file/materi';
            $old_file = $materi->attachment;

            if ($type_materi === 'file') {
                if ($request->getFile('file') !== 4) {
                    $attachment = upload_file($request, $path, $old_file, true);
                } else {
                    $attachment = $old_file;
                }
            } else {
                destroy_file($old_file, $path);
                $attachment = $request->getVar('youtube');
            }

            $this->lessonModel->save([
                'id' => $materi->id,
                'name' => $request->getVar('name'),
                'description' => $request->getVar('description'),
                'type' => $type_materi,
                'attachment' => $attachment,
            ]);

            return redirect()->route('guru.materi', [base64_encode($schedule->id)])
                ->with('success', 'Data materi berhasil diubah.')
                ->with('tabLesson', "#tab_$type_materi");
        } catch (\Throwable $th) {
            $this->db->transRollback();

            return redirect()->back()->withInput()->with('error', $th->getMessage());
        } finally {
            $this->db->transCommit();
        }
    }

    /**
     * Destroy the specified resource.
     * 
     * @return void
     */
    public function destroy()
    {
        $this->db->transBegin();
        try {
            $request = $this->request;

            $materi = $this->lessonModel->where('id', base64_decode($request->getVar('id')))->first();

            if ($materi->type === 'file') 
                destroy_file($materi->attachment, 'file/materi');
            
            $this->lessonModel->delete($materi->id);

            return $this->response->setJSON([
                'status' => 200,
                'message' => 'Data materi berhasil dihapus.'
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
     * Rules validation
     * 
     * @return array
     */
    private function rules($type, $model = null)
    {
        $has_file = $model && $model->attachment ? '' : '|uploaded[file]';

        if ($type === 'file') {
            $rule_merge = [
                'file' => [
                    'rules' => "max_size[file,10240]|ext_in[file,pdf,doc,docx,ppt,pptx]$has_file",
                    'errors' => [
                        'uploaded' => 'File materi harus diisi.',
                        'max_size' => 'File materi maksimal 10MB.',
                        'ext_in' => 'File materi harus berupa pdf, doc, docx, ppt, atau pptx.'
                    ]
                ],
            ];
        } else {
            $rule_merge = [
                'youtube' => [
                    'rules' => 'required|max_length[20]|string',
                    'errors' => [
                        'required' => 'Kode YouTube harus diisi.',
                        'max_length' => 'Kode YouTube maksimal 20 karakter.',
                        'string' => 'Kode YouTube harus berupa string.'
                    ]
                ]
            ];
        }

        $rule = [
            'name' => [
                'rules' => 'required|max_length[50]|string',
                'errors' => [
                    'required' => 'Judul materi harus diisi.',
                    'max_length' => 'Judul materi maksimal 50 karakter.',
                    'string' => 'Judul materi harus berupa string.'
                ]
            ],
            'description' => [
                'rules' => 'required|max_length[350]|string',
                'errors' => [
                    'required' => 'Deskripsi materi harus diisi.',
                    'max_length' => 'Deskripsi materi maksimal 350 karakter.',
                    'string' => 'Deskripsi materi harus berupa string.'
                ]
            ],
            'type' => [
                'rules' => 'required|in_list[file,youtube]',
                'errors' => [
                    'required' => 'Tipe materi harus diisi.',
                    'in_list' => 'Tipe materi tidak valid.'
                ]
            ],
        ];

        return array_merge($rule, $rule_merge);
    }
}
