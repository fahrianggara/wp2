<?php

namespace App\Models;

use App\Entities\Schedule;
use CodeIgniter\Model;

class ScheduleModel extends Model
{
    protected $table            = 'schedules';
    protected $returnType       = Schedule::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'day', 'start_time', 'end_time', 'teacher_id', 'classroom_id'
    ];
}
