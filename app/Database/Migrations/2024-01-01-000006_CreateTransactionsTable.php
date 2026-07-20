<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionsTable extends Migration
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
            'reference' => [
                'type'   => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
                'null'   => true,
            ],
            'type_operation_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'expediteur_id' => [
                'type'     => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'destinataire_id' => [
                'type'     => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'montant' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
            ],
            'frais' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'date_transaction' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('type_operation_id', 'types_operations', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('expediteur_id', 'clients', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('destinataire_id', 'clients', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('transactions');
    }

    public function down()
    {
        $this->forge->dropTable('transactions');
    }
}
