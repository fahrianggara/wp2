<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ScheduleModel;
use App\Models\TeacherModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class JadwalController extends BaseController
{    
    protected $scheduleModel, $teacherModel;

    /**
     * constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->scheduleModel = new ScheduleModel();
        $this->teacherModel = new TeacherModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $schedules = $this->scheduleModel->findAll();
        
        return view('admin/jadwal/index', [
            'title'     => 'Data Jadwal Sekolah',
            'menu'      => 'jadwal',
            'user'      => $this->auth,
            'schedules' => $schedules,
            'db'        => $this->db
        ]);
    }

    /**
     * Display a create form of the resource.
     * 
     * @return void
     */
    public function create()
    {   
        $teachers = $this->teacherModel->with(['users'])->findAll();
        
        return view('admin/jadwal/create', [
            'title'    => 'Tambah Jadwal',
            'menu'     => 'jadwal',
            'user'     =>  $this->auth,
            'teachers' => $teachers,
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

        $request = $this->request;

        // Checking if has data
        $schedule = $this->scheduleModel->where('day', $request->getVar('day'))
            ->where('start_time', $request->getVar('start_time'))
            ->where('end_time', $request->getVar('end_time'))
            ->where('teacher_id', $request->getVar('teacher_id'))
            ->where('subject_id', $request->getVar('subject_id'))
            ->where('classroom_id', $request->getVar('classroom_id'))
            ->first();

        if ($schedule) 
            return redirect()->back()->withInput()->with('warning', "Jadwal tersebut sudah ada!");

        $this->db->transBegin();
        try {
            $this->scheduleModel->save([
                'day' => $request->getVar('day'),
                'start_time' => $request->getVar('start_time'),
                'end_time' => $request->getVar('end_time'),
                'teacher_id' => $request->getVar('teacher_id'),
                'subject_id' => $request->getVar('subject_id'),
                'classroom_id' => $request->getVar('classroom_id'),
            ]);

            return redirect()->route('admin.jadwal')->with('success', 'Data jadwal berhasil ditambahkan.');
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
    private function rules()
    {
        return [
            'day' => [
                'rules' => 'required|string',
                'errors' => [
                    'required' => 'Hari harus diisi.',
                    'string'   => 'Hari harus berupa karakter.'
                ]
            ],
            'start_time' => [
                'rules' => 'required|string',
                'errors' => [
                    'required' => 'Jam mulai harus diisi.',
                    'string'   => 'Jam mulai harus berupa karakter.'
                ]
            ],
            'end_time' => [
                'rules' => 'required|string',
                'errors' => [
                    'required' => 'Jam selesai harus diisi.',
                    'string'   => 'Jam selesai harus berupa karakter.'
                ]
            ],
            'teacher_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Guru harus diisi.',
                ]
            ],
            'classroom_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas harus diisi.',
                ]
            ],
            'subject_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mata pelajaran harus diisi.',
                ]
            ],
        ];
    }

    /**
     * Fetch relation data from teacher
     * 
     * @return void
     */
    public function fetch()
    {
        if (!$this->request->isAJAX()) 
            throw PageNotFoundException::forPageNotFound();

        $teacher_id = $this->request->getVar('teacher_id');

        $classrooms = $this->db->table('teacher_classrooms')
            ->distinct() // remove duplicate data
            ->where('teacher_classrooms.teacher_id', $teacher_id)
            ->join('classrooms', 'teacher_classrooms.classroom_id = classrooms.id')
            ->select('classrooms.id, classrooms.name')
            ->get()->getResult();

        $subjects = $this->db->table('teacher_subjects')
            ->distinct() 
            ->where('teacher_subjects.teacher_id', $teacher_id)
            ->join('subjects', 'teacher_subjects.subject_id = subjects.id')
            ->select('subjects.id, subjects.name')
            ->get()->getResult();

        return response()->setJSON([
            'classrooms' => $classrooms,
            'subjects'   => $subjects,
        ]);
    }
}
