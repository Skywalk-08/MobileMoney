<?php

namespace App\Models;

use CodeIgniter\Model;

class PrefixeModel extends Model
{
    protected $table            = 'prefixes';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = false;
    protected $allowedFields    = ['prefixe', 'actif'];
    protected $returnType       = 'array';
}
