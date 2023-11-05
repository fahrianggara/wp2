<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTeacherSubjectsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => "INT", 'constraint' => 11, 'auto_increment' => true],
            'teacher_id' => ['type' => "INT", 'constraint' => 11],
            'subject_id' => ['type' => 'INT', 'constraint' => 11],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey("id", true);
        $this->forge->addForeignKey("teacher_id", "teachers", "id", "CASCADE", "CASCADE");
        $this->forge->addForeignKey("subject_id", "subjects", "id", "CASCADE", "CASCADE");
        $this->forge->createTable("teacher_subjects");
    }

    public function down()
    {
        $this->forge->dropTable("teacher_subjects");
    }
}
