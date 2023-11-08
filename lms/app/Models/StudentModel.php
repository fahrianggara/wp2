<?php

namespace App\Models;

use App\Entities\Student;
use CodeIgniter\Model;
use Tatter\Relations\Traits\ModelTrait;

class StudentModel extends Model
{
    use ModelTrait;

    protected $table            = 'students';
    protected $returnType       = Student::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'user_id', 'classroom_id',
    ];
}
