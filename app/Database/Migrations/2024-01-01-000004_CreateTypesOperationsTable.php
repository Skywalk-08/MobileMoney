<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTypesOperationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type'   => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
            ],
            'actif' => [
                'type'    => 'INT',
                'constraint' => 1,
                'default' => 1,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('types_operations');
    }

    public function down()
    {
        $this->forge->dropTable('types_operations');
    }
}
