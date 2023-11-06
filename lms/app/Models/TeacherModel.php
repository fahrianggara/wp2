<?php

namespace App\Models;

use App\Entities\Teacher;
use CodeIgniter\Model;
use Tatter\Relations\Traits\ModelTrait;

class TeacherModel extends Model
{
    use ModelTrait;

    protected $table            = 'teachers';
    protected $returnType       = Teacher::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'user_id', 'code',
    ];

        
    /**
     * Insert relation data to teacher_classrooms table.
     *
     * @param  mixed $teacherId
     * @param  mixed $classroomIds
     * @return void
     */
    public function syncClassrooms($teacherId, $classroomIds)
    {
        $this->db->table('teacher_classrooms')->where('teacher_id', $teacherId)->delete();

        $data = [];
        foreach ($classroomIds as $classroomId) {
            $data[] = [
                'teacher_id' => $teacherId,
                'classroom_id' => $classroomId,
            ];
        }

        $this->db->table('teacher_classrooms')->insertBatch($data);
    }

    /**
     * Insert relation data to teacher_subjects table.
     *
     * @param  mixed $teacherId
     * @param  mixed $subjectIds
     * @return void
     */
    public function syncSubjects($teacherId, $subjectIds)
    {
        $this->db->table('teacher_subjects')->where('teacher_id', $teacherId)->delete();

        $data = [];
        foreach ($subjectIds as $subjectId) {
            $data[] = [
                'teacher_id' => $teacherId,
                'subject_id' => $subjectId,
            ];
        }

        $this->db->table('teacher_subjects')->insertBatch($data);
    }
}
