<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSchedulesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => "INT", 'constraint' => 11, 'auto_increment' => true],
            'day' => ['type' => 'varchar', 'constraint' => 255],
            'start_time' => ['type' => 'time'],
            'end_time' => ['type' => 'time'],
            'teacher_id' => ['type' => "INT", 'constraint' => 11, 'null' => true],
            'subject_id' => ['type' => "INT", 'constraint' => 11, 'null' => true],
            'classroom_id' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey("id", true);
        $this->forge->addForeignKey("teacher_id", "teachers", "id", "CASCADE", "SET NULL");
        $this->forge->addForeignKey("subject_id", "subjects", "id", "CASCADE", "SET NULL");
        $this->forge->addForeignKey("classroom_id", "classrooms", "id", "CASCADE", "SET NULL");
        $this->forge->createTable("schedules");
    }

    public function down()
    {
        $this->forge->dropTable("schedules");
    }
}
