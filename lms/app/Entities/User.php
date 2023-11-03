<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    /**
     * get attribute full name    
     *
     * @return void
     */
    public function getFullName()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    /**
     * Get picture attribute
     * 
     * @param  mixed $picture
     * @return void
     */
    public function getPicture()
    {
        $path = base_url('images/pictures/' . $this->attributes['picture']);
        return file_exists($path) ? $path : base_url('images/picture.png');
    }
}
