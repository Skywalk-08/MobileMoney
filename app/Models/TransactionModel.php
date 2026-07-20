<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table         = 'transactions';
    protected $primaryKey    = 'id';
    protected $useTimestamps = false;
    protected $createdField  = 'date_transaction';
    protected $returnType    = 'array';
    protected $allowedFields = [
        'reference',
        'type_operation_id',
        'expediteur_id',
        'destinataire_id',
        'autre_operateur_id',
        'montant',
        'frais',
        'commission',
        'description',
    ];

    public function getDerniereOperation(int $clientId)
    {
        return $this->where('expediteur_id', $clientId)
                    ->orWhere('destinataire_id', $clientId)
                    ->orderBy('date_transaction', 'DESC')
                    ->first();
    }

    public function getHistorique(int $clientId, ?int $typeOperationId = null, string $ordre = 'DESC')
    {
        $builder = $this->where('expediteur_id', $clientId)
                        ->orWhere('destinataire_id', $clientId);

        if (! empty($typeOperationId)) {
            $builder->where('type_operation_id', $typeOperationId);
        }

        $builder->orderBy('date_transaction', $ordre);

        return $builder->findAll();
    }

    public function getTotalFrais(?int $typeOperationId = null): float
    {
        $builder = $this->selectSum('frais');

        if (! empty($typeOperationId)) {
            $builder->where('type_operation_id', $typeOperationId);
        }

        $result = $builder->first();

        return (float) ($result['frais'] ?? 0);
    }

    public function getTotalCommissions(): float
    {
        $result = $this->selectSum('commission')->first();

        return (float) ($result['commission'] ?? 0);
    }

    public function getMontantsParAutreOperateur(): array
    {
        return $this->select('autres_operateurs.nom, SUM(transactions.montant) as total_montant, SUM(transactions.commission) as total_commission')
                     ->join('autres_operateurs', 'autres_operateurs.id = transactions.autre_operateur_id')
                     ->where('transactions.autre_operateur_id !=', null)
                     ->groupBy('transactions.autre_operateur_id')
                     ->findAll();
    }
}
