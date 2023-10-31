<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassRoomModel extends Model
{
    protected $table            = 'classrooms';
    protected $returnType       = 'object';
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'name'
    ];
}
