<?php

namespace App\Models;

use CodeIgniter\Model;

class OperationModel extends Model
{
    protected $table         = 'transactions';
    protected $primaryKey    = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = [];

    public const DEPOT      = 'depot';
    public const RETRAIT    = 'retrait';
    public const TRANSFERT  = 'transfert';

    public function getTypesOperation(): array
    {
        return [
            self::DEPOT,
            self::RETRAIT,
            self::TRANSFERT,
        ];
    }

    public function getLibelle(string $type): string
    {
        return match ($type) {
            self::DEPOT     => 'Dépôt',
            self::RETRAIT   => 'Retrait',
            self::TRANSFERT => 'Transfert',
            default         => ucfirst($type),
        };
    }
}
