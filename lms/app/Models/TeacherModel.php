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
}
