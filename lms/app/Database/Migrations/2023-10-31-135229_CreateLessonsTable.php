<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLessonsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => "INT", 'constraint' => 11, 'auto_increment' => true],
            'name' => ['type' => "VARCHAR", 'constraint' => 255],
            'description' => ['type' => "TEXT"],
            'type' => ['type' => "ENUM('file','youtube')", "default" => NULL],
            'attachment' => ['type' => "VARCHAR", 'constraint' => 255, "default" => NULL],
            'classroom_id' => ['type' => "INT", 'constraint' => 11],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey("id", true);
        $this->forge->addForeignKey("classroom_id", "classrooms", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("lessons");
    }

    public function down()
    {
        $this->forge->dropTable("lessons");
    }
}
