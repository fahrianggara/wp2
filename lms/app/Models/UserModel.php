<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;
use Tatter\Relations\Traits\ModelTrait;

class UserModel extends Model
{
    use ModelTrait;

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

        
    /**
     * Insert new student data.
     *
     * @param  mixed $user
     * @return void
     */
    public function insertStudent($data)
    {
        $this->db->table('students')->insert($data);
    }

    /**
     * Update student data.
     *
     * @param  mixed $user
     * @return void
     */
    public function updateStudent($data, $id)
    {
        $this->db->table('students')->update($data, ['user_id' => $id]);
    }
}
