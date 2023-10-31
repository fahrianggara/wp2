<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $returnType       = 'object';
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'first_name', 
        'last_name', 
        'id_number', 
        'email', 
        'gender', 
        'religion', 
        'picture', 
        'role', 
        'password'
    ];
}
