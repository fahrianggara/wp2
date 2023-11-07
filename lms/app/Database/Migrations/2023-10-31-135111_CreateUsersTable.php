<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'first_name' => ['type' => "VARCHAR", 'constraint' => 255],
            'last_name' => ['type' => "VARCHAR", 'constraint' => 255],
            'id_number' => ['type' => 'BIGINT', 'constraint' => 11, 'unique' => true],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'gender' => ['type' => "ENUM('laki_laki','perempuan')", "default" => "laki_laki"],
            'religion' => ['type' => "ENUM('islam','kristen','katolik','budha','hindu','protestan','khonghucu')", "default" => NULL],
            'picture' => ['type' => "VARCHAR", 'constraint' => 255, 'default' => 'picture.png'],
            'role' => ['type' => "ENUM('admin','teacher','student')", "default" => "student"],
            'password' => ['type' => "VARCHAR", 'constraint' => 255],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
