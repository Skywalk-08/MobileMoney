<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('PrefixeSeeder');
        $this->call('AutreOperateurSeeder');
        $this->call('TypesOperationSeeder');
        $this->call('AdminSeeder');
        $this->call('BaremeSeeder');
    }
}
