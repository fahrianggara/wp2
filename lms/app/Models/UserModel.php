<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;
use Tatter\Relations\Traits\ModelTrait;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $returnType       = User::class;
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
