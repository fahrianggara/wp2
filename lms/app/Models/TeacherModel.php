<?php

namespace App\Models;

use App\Entities\Teacher;
use CodeIgniter\Model;

class TeacherModel extends Model
{
    protected $table            = 'teachers';
    protected $returnType       = Teacher::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'user_id', 'code',
    ];

    // Sync between teachers and classrooms table (teacher_classrooms table)
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
}
