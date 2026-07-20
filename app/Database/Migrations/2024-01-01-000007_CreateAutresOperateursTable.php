<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAutresOperateursTable extends Migration
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
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
            ],
            'commission_transfert' => [
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
        $this->forge->createTable('autres_operateurs');
    }

    public function down()
    {
        $this->forge->dropTable('autres_operateurs');
    }
}
