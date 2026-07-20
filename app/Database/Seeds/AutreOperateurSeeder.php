<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AutreOperateurSeeder extends Seeder
{
    public function run()
    {
        $operateurs = [
            ['nom' => 'Telma', 'commission_transfert' => 500, 'actif' => 1],
            ['nom' => 'Airtel', 'commission_transfert' => 300, 'actif' => 1],
        ];

        foreach ($operateurs as $operateur) {
            $this->db->table('autres_operateurs')->insert($operateur);
        }
    }
}
