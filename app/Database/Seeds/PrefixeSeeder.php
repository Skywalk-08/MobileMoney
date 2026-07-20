<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrefixeSeeder extends Seeder
{
    public function run()
    {
        $prefixes = [
            ['prefixe' => '032', 'type' => 'local', 'actif' => 1],
            ['prefixe' => '033', 'type' => 'local', 'actif' => 1],
            ['prefixe' => '034', 'type' => 'local', 'actif' => 1],
            ['prefixe' => '038', 'type' => 'local', 'actif' => 1],
        ];

        foreach ($prefixes as $prefixe) {
            $this->db->table('prefixes')->insert($prefixe);
        }
    }
}
