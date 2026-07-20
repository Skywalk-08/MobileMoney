<?php

namespace App\Models;

use CodeIgniter\Model;

class BaremeModel extends Model
{
    protected $table         = 'bareme';
    protected $primaryKey    = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'type_operation',
        'seuil_min',
        'seuil_max',
        'taux',
        'frais_fixe',
    ];

    public function calculerFrais(string $typeOperation, float $montant): float
    {
        $ligne = $this->where('type_operation', $typeOperation)
                      ->groupStart()
                          ->where('seuil_max IS NULL')
                          ->orWhere('seuil_max >=', $montant)
                      ->groupEnd()
                      ->where('seuil_min <=', $montant)
                      ->orderBy('seuil_min', 'DESC')
                      ->first();

        if (! $ligne) {
            return 0.00;
        }

        $frais = ($montant * (float) $ligne['taux']) + (float) $ligne['frais_fixe'];

        return round($frais, 2);
    }
}
