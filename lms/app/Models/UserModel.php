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

    /**
     * Insert new teacher data.
     *
     * @param  mixed $user
     * @return void
     */
    public function insertTeacher($data)
    {
        $this->db->table('teachers')->insert($data);
    }

    /**
     * Update teacher data.
     *
     * @param  mixed $user
     * @return void
     */
    public function updateTeacher($data, $id)
    {
        $this->db->table('teachers')->update($data, ['user_id' => $id]);
    }

    /**
     * Authentication user
     * 
     */
    public function authUser()
    {
        if (session()->has('logged_in')) {
            return $this->where('id', session()->get('id'))->first();
        } else {
            return redirect()->route('login');
        }
    }
}
