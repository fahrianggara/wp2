<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'first_name' => 'GOD',
                'last_name' => 'Admin',
                'id_number' => 11111111,
                'email' => "11111111@mail.com",
                'gender' => 'laki_laki',
                'religion' => 'islam',
                'picture' => 'picture.png',
                'role' => 'admin',
                'password' => password_hash('11111111', PASSWORD_BCRYPT),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        $userModel = new UserModel();
        $userModel->insertBatch($data);
    }
}
