<?php

namespace App\Database\Seeds;

use App\Models\SubjectModel;
use CodeIgniter\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        $subjects = new SubjectModel();

        $subjects->insertBatch([
            [
                'name' => 'X - Bahasa Indonesia',
                'code' => 'x-bindo'
            ],
            [
                'name' => 'XI - Bahasa Inggris',
                'code' => 'xi-bing'
            ],
            [
                'name' => 'XII - Matematika',
                'code' => 'xii-mtk'
            ]
        ]);
    }
}
