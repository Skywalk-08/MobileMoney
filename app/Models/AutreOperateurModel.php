<?php

namespace App\Models;

use CodeIgniter\Model;

class AutreOperateurModel extends Model
{
    protected $table            = 'autres_operateurs';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = false;
    protected $allowedFields    = ['nom', 'commission_transfert', 'actif'];
    protected $returnType       = 'array';
}
