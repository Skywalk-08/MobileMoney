<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeOperationModel extends Model
{
    protected $table            = 'types_operations';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = false;
    protected $allowedFields    = ['nom', 'actif'];
    protected $returnType       = 'array';

    public function getIdByNom(string $nom): ?int
    {
        $ligne = $this->where('nom', $nom)->first();

        return $ligne ? (int) $ligne['id'] : null;
    }
}
