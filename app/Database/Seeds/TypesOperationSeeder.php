<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypesOperationSeeder extends Seeder
{
    public function run()
    {
        $types = ['Depot', 'Retrait', 'Transfert'];

        foreach ($types as $type) {
            $this->db->table('types_operations')->insert([
                'nom'  => $type,
                'actif' => 1,
            ]);
        }
    }
}
