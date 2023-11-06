<?php

namespace App\Models;

use App\Entities\Schedule;
use CodeIgniter\Model;
use Tatter\Relations\Traits\ModelTrait;

class ScheduleModel extends Model
{
    use ModelTrait;
    
    protected $table            = 'schedules';
    protected $returnType       = Schedule::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'day', 'start_time', 'end_time', 'teacher_id', 'classroom_id', 'subject_id'
    ];
}
