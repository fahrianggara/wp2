<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiswasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => "INT",'constraint' => 11, 'auto_increment' => true],
            'nis' => ['type' => "INT",'constraint' => 11, 'unsigned' => true],
            'nama' => ['type' => "VARCHAR", 'constraint' => 255],
            'tanggal_lahir' => ['type' => "DATE"],
            'tempat_lahir' => ['type' => "VARCHAR", 'constraint' => 255],
            'alamat' => ['type'=> "VARCHAR", 'constraint' => 255],
            'jenis_kelamin' => ['type' => "ENUM('laki-laki','perempuan')", "default" => "laki-laki"],
            'agama' => ['type' => "ENUM('islam','kristen','katolik','budha','hindu','protestan','khonghucu')", "default" => NULL],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey("id", true);
        $this->forge->createTable("siswas");
    }

    public function down()
    {
        $this->forge->dropTable("siswas");
    }
}
