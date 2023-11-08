<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use Config\Database;

class Schedule extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getLessons()
    {
        $db = Database::connect();
        return $db->table('lessons')->where('subject_id', $this->attributes['subject_id']);
    }
}
