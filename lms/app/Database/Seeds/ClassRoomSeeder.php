<?php

namespace App\Database\Seeds;

use App\Models\ClassroomModel;
use CodeIgniter\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    public function run()
    {
        $classroomModel = new ClassroomModel();

        $classroomModel->insertBatch([
            [
                'name' => '17.3a.25',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => '12.5z.18',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => '43.7x.94',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => '05.9u.32',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
