<?php

namespace App\Models;

use App\Entities\Student;
use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'students';
    protected $returnType       = Student::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'user_id', 'classroom_id',
    ];
}
