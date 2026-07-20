<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyPrefixesTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('prefixes', [
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'default'   => 'local',
                'after'      => 'prefixe',
            ],
            'autre_operateur_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'type',
            ],
        ]);

        $this->forge->addForeignKey('autre_operateur_id', 'autres_operateurs', 'id', 'SET NULL', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('prefixes', 'prefixes_autre_operateur_id_foreign');
        $this->forge->dropColumn('prefixes', ['type', 'autre_operateur_id']);
    }
}
