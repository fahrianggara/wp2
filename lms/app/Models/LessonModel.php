<?php

namespace App\Models;

use App\Entities\Lesson;
use CodeIgniter\Model;

class LessonModel extends Model
{
    protected $table            = 'lessons';
    protected $returnType       = Lesson::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'name', 'description', 'type', 'attachment', 'subject_id'
    ];
}
