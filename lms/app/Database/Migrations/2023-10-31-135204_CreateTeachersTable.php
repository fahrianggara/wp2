<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTeachersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => "INT", 'constraint' => 11, 'auto_increment' => true],
            'user_id' => ['type' => "INT", 'constraint' => 11],
            'code' => ['type' => "VARCHAR", 'constraint' => 255, 'unique' => true],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey("id", true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable("teachers");
    }

    public function down()
    {
        $this->forge->dropTable("teachers");
    }
}
