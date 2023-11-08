<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Run extends Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('ClassroomSeeder');
        $this->call('SubjectSeeder');
        $this->call('TeacherSeeder');
        $this->call('StudentSeeder');
    }
}
