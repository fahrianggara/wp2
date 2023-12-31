<?php

namespace App\Database\Seeds;

use App\Models\TeacherModel;
use App\Models\ClassroomModel;
use App\Models\SubjectModel;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class TeacherSeeder extends Seeder
{    
    protected $teacherModel, $classroomModel, $subjectModel, $userModel;

    public function __construct()
    {
        $this->teacherModel     = new TeacherModel();
        $this->classroomModel   = new ClassroomModel();
        $this->subjectModel     = new SubjectModel();
        $this->userModel        = new UserModel();
    }

    /**
     * Run Seeder
     *
     * @return void
     */
    public function run()
    {
        $classrooms = $this->classroomModel->findAll();
        $subjects   = $this->subjectModel->findAll();

        $user = $this->userModel->insert([
            'first_name' => 'Meifa',
            'last_name' => 'Salsa',
            'id_number' => 22222222,
            'email' => "22222222@mail.com",
            'gender' => 'perempuan',
            'religion' => 'islam',
            'picture' => 'picture.png',
            'role' => 'teacher',
            'password' => password_hash('22222222', PASSWORD_BCRYPT),
        ]);

        $teacher = $this->teacherModel->insert([
            'user_id' => $user,
            'code' => 'MFS'
        ]);

        $subjectIds = [];
        $classroomIds = [];

        // Ambil 3 mata pelajaran secara acak
        $randomSubjects = array_rand($subjects, 4);
        foreach ($randomSubjects as $subjectIndex) {
            $subject = $subjects[$subjectIndex];
            $subjectIds[] = $subject->id;
        }

        // Ambil 2 ruang kelas secara acak
        $randomClassrooms = array_rand($classrooms, 2);
        foreach ($randomClassrooms as $classroomIndex) {
            $classroom = $classrooms[$classroomIndex];
            $classroomIds[] = $classroom->id;
        }

        $this->teacherModel->syncSubjects($teacher, $subjectIds);
        $this->teacherModel->syncClassrooms($teacher, $classroomIds);
    }
}
