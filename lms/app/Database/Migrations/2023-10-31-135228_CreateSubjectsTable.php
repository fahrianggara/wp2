<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubjectsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => "INT", 'constraint' => 11, 'auto_increment' => true],
            'name' => ['type' => "VARCHAR", 'constraint' => 255],
            'code' => ['type' => "VARCHAR", 'constraint' => 50, 'unique' => true],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey("id", true);
        $this->forge->createTable("subjects");
    }

    public function down()
    {
        $this->forge->dropTable("subjects");
    }
}
