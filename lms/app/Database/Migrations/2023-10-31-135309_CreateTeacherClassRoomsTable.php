<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTeacherClassRoomsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => "INT", 'constraint' => 11, 'auto_increment' => true],
            'teacher_id' => ['type' => "INT", 'constraint' => 11],
            'classroom_id' => ['type' => 'INT', 'constraint' => 11],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey("id", true);
        $this->forge->addForeignKey("teacher_id", "teachers", "id");
        $this->forge->addForeignKey("classroom_id", "classrooms", "id");
        $this->forge->createTable("teacher_classrooms");
    }

    public function down()
    {
        $this->forge->dropTable("teacher_classrooms");
    }
}
