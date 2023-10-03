<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Contoh1 extends BaseController
{
    public function index()
    {
        echo "<h1>Perkenalkan</h1>";
        echo "Nama saya Fahri Anggara. Saya tinggal di Kota Depok. 
            Olah raga yang saya sukai adalah Bulutangkis dan Tenis Meja.";
    }
}
