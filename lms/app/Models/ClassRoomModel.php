<?php

namespace App\Models;

use App\Entities\Classroom;
use CodeIgniter\Model;

class ClassroomModel extends Model
{
    protected $table            = 'classrooms';
    protected $returnType       = Classroom::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'name'
    ];
}
