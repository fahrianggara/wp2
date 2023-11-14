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
            ],
            [
                'name' => 'X - Fisika',
                'code' => 'x-fsk'
            ],
            [
                'name' => 'XI - Bahasa Indonesia',
                'code' => 'xi-bindo'
            ],
            [
                'name' => 'XII - Penjaskes',
                'code' => 'xii-penjas'
            ]
        ]);
    }
}
