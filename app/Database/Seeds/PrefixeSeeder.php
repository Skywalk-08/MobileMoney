<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrefixeSeeder extends Seeder
{
    public function run()
    {
        $prefixes = ['032', '033', '034', '038'];

        foreach ($prefixes as $prefixe) {
            $this->db->table('prefixes')->insert([
                'prefixe' => $prefixe,
                'actif'   => 1,
            ]);
        }
    }
}
