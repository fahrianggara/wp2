<?php

namespace App\Database\Seeds;

use App\Models\ClassRoomModel;
use CodeIgniter\Database\Seeder;

class ClassRoomSeeder extends Seeder
{
    public function run()
    {
        $classroomModel = new ClassRoomModel();

        $classroomModel->insertBatch([
            [
                'name' => '10.1A.01',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'name' => '10.1A.02',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'name' => '10.2A.01',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'name' => '10.2A.02',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'name' => '10.3A.01',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
