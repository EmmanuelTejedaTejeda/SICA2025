<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CompetenciasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' =>[
                'type' => 'INT',
                'auto_increment' => true
            ], 
            'blog_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('Competencias');
    }

    public function down()
    {
        $this->forge->dropTable('Competencias');
    }
}
