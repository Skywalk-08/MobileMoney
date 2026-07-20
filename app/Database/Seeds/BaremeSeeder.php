<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BaremeSeeder extends Seeder
{
    public function run()
    {
        $baremes = [
            // Dépôt (gratuit)
            ['type_operation_id' => 1, 'montant_min' => 0,        'montant_max' => 999999999.99, 'frais' => 0],

            // Retrait
            ['type_operation_id' => 2, 'montant_min' => 0,        'montant_max' => 10000,        'frais' => 500],
            ['type_operation_id' => 2, 'montant_min' => 10001,    'montant_max' => 50000,        'frais' => 1000],
            ['type_operation_id' => 2, 'montant_min' => 50001,    'montant_max' => 100000,       'frais' => 2000],
            ['type_operation_id' => 2, 'montant_min' => 100001,   'montant_max' => 999999999.99, 'frais' => 3000],

            // Transfert
            ['type_operation_id' => 3, 'montant_min' => 0,        'montant_max' => 10000,        'frais' => 300],
            ['type_operation_id' => 3, 'montant_min' => 10001,    'montant_max' => 50000,        'frais' => 700],
            ['type_operation_id' => 3, 'montant_min' => 50001,    'montant_max' => 100000,       'frais' => 1200],
            ['type_operation_id' => 3, 'montant_min' => 100001,   'montant_max' => 999999999.99, 'frais' => 2000],
        ];

        $this->db->table('baremes_frais')->insertBatch($baremes);
    }
}
