<?php

namespace App\Models;

use CodeIgniter\Model;

class BaremeFraisModel extends Model
{
    protected $table            = 'baremes_frais';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    protected $createdField     = 'date_modification';
    protected $updatedField     = 'date_modification';
    protected $dateFormat       = 'datetime';
    protected $allowedFields    = ['type_operation_id', 'montant_min', 'montant_max', 'frais'];
    protected $returnType       = 'array';

    protected $validationRules  = [
        'type_operation_id' => 'required|is_not_unique[types_operations.id]',
        'montant_min'       => 'required|numeric|greater_than_equal_to[0]',
        'montant_max'       => 'required|numeric|greater_than_equal_to[0]',
        'frais'             => 'required|numeric|greater_than_equal_to[0]',
    ];

    public function getWithTypeName()
    {
        return $this->select('baremes_frais.*, types_operations.nom as type_nom')
                     ->join('types_operations', 'types_operations.id = baremes_frais.type_operation_id')
                     ->orderBy('type_operation_id', 'ASC')
                     ->orderBy('montant_min', 'ASC')
                     ->findAll();
    }

    public function calculerFrais(int $typeOperationId, float $montant): float
    {
        $ligne = $this->where('type_operation_id', $typeOperationId)
                      ->where('montant_min <=', $montant)
                      ->where('montant_max >=', $montant)
                      ->orderBy('montant_min', 'DESC')
                      ->first();

        if (! $ligne) {
            return 0.00;
        }

        return (float) $ligne['frais'];
    }
}
