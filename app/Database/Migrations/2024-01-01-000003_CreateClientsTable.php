<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClientsTable extends Migration
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
                'type'    => 'VARCHAR',
                'constraint' => 150,
                'default' => 'Client',
            ],
            'telephone' => [
                'type'   => 'VARCHAR',
                'constraint' => 20,
                'unique' => true,
            ],
            'solde' => [
                'type'    => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
            ],
            'actif' => [
                'type'    => 'INT',
                'constraint' => 1,
                'default' => 1,
            ],
            'date_creation' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('clients');
    }

    public function down()
    {
        $this->forge->dropTable('clients');
    }
}
