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
                'name' => '10.1a.01',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'name' => '10.3a.01',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
