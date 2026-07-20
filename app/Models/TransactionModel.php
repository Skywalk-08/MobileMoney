<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table         = 'transactions';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = false;
    protected $allowedFields = [
        'client_id',
        'type_operation',
        'montant',
        'frais',
        'expediteur',
        'destinataire',
        'solde_apres',
    ];

    public function getDerniereOperation(int $clientId)
    {
        return $this->where('client_id', $clientId)
                    ->orderBy('created_at', 'DESC')
                    ->first();
    }

    public function getHistorique(int $clientId, ?string $type = null, string $ordre = 'DESC')
    {
        $builder = $this->where('client_id', $clientId);

        if (! empty($type)) {
            $builder->where('type_operation', $type);
        }

        $builder->orderBy('created_at', $ordre);

        return $builder->findAll();
    }
}
