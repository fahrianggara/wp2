<?php

namespace App\Models;

use App\Entities\ClassRoom;
use CodeIgniter\Model;

class ClassRoomModel extends Model
{
    protected $table            = 'classrooms';
    protected $returnType       = ClassRoom::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'name'
    ];
}
