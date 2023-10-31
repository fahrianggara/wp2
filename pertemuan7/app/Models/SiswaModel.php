<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table            = 'siswas';
    protected $returnType       = 'object';
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'nis', 'nama', 'tanggal_lahir', 'tempat_lahir', 'alamat', 'jenis_kelamin', 'agama'
    ];
}
