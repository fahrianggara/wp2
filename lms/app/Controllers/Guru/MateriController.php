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
            'title'     => "Materi - Kelas: " . upcase($schedule->classroom->name) . " | Mapel: {$schedule->subject->name}",
            'menu'      => 'jadwal',
            'user'      => $this->auth,
            'jadwal'    => $schedule,
            'lessons'   => $this->lessonModel->where('subject_id', $schedule->subject->id)->findAll(),
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
            'title'     => "Tambah Materi - Kelas: " . upcase($schedule->classroom->name) . " | Mapel: {$schedule->subject->name}",
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

        if (!$this->validate($this->rules($request->getVar('type')))) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();
        try {
            $schedule = $this->scheduleModel->where("id", base64_decode($request->getVar('jadwal_id')))
                ->with(['classrooms', 'subjects'])->first();

            ($request->getVar('type') === 'file')
                ? $attachment = upload_file($request, 'file/materi')
                : $attachment = $request->getVar('youtube');

            $this->lessonModel->save([
                'name' => $request->getVar('name'),
                'description' => $request->getVar('description'),
                'type' => $request->getVar('type'),
                'attachment' => $attachment,
                'subject_id' => $schedule->subject->id,
            ]);

            return redirect()->route('guru.materi', [base64_encode($schedule->id)])
                ->with('success', 'Data materi berhasil ditambahkan.');
        } catch (\Throwable $th) {
            $this->db->transRollback();

            return redirect()->back()->withInput()->with('error', $th->getMessage());
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
