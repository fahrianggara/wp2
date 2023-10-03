<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelLatihan1;

class Latihan1 extends BaseController
{
    public function index()
    {
        echo "Selamat Datang.. selamat belajar Web Programming II";
    }

    public function penjumlahan($n1, $n2)
    {
        $model_latihan1 = new ModelLatihan1();

        $data['nilai1'] = $n1;
        $data['nilai2'] = $n2;
        $data['hasil'] = $model_latihan1->jumlah($n1, $n2);

        return view('view-latihan', $data);
    }
}
