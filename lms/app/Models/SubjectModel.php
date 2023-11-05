<?php

namespace App\Models;

use App\Entities\Subject;
use CodeIgniter\Model;

class SubjectModel extends Model
{
    protected $table            = 'subjects';
    protected $returnType       = Subject::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'name', 'code'
    ];
}
