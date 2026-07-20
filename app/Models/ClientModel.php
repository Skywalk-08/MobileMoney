<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table            = 'clients';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = false;
    protected $allowedFields    = ['telephone', 'solde', 'nom'];
    protected $validationRules  = [
        'telephone' => 'required|max_length[20]',
    ];

    protected array $prefixesLocaux = [];

    public function __construct()
    {
        parent::__construct();
        $this->chargerPrefixesLocaux();
    }

    protected function chargerPrefixesLocaux(): void
    {
        $prefixeModel = new PrefixeModel();
        $prefixes = $prefixeModel->where('actif', 1)
                                 ->where('type', 'local')
                                 ->findAll();
        $this->prefixesLocaux = array_column($prefixes, 'prefixe');
    }

    public function getClientByTelephone(string $telephone)
    {
        return $this->where('telephone', $telephone)->first();
    }

    public function isPrefixeLocalValide(string $telephone): bool
    {
        foreach ($this->prefixesLocaux as $prefixe) {
            if (str_starts_with($telephone, $prefixe)) {
                return true;
            }
        }

        return false;
    }

    public function getPrefixesLocaux(): array
    {
        return $this->prefixesLocaux;
    }

    public function estMemoqueOperateur(string $telephone): bool
    {
        $prefixe = substr($telephone, 0, 3);

        return in_array($prefixe, $this->prefixesLocaux, true);
    }

    public function estAutreOperateur(string $telephone): bool
    {
        $prefixe = substr($telephone, 0, 3);

        if ($this->estMemoqueOperateur($telephone)) {
            return false;
        }

        $prefixeModel = new PrefixeModel();
        return $prefixeModel->where('prefixe', $prefixe)
                            ->where('type', 'externe')
                            ->where('actif', 1)
                            ->first() !== null;
    }

    public function creerClient(string $telephone, ?string $nom = null)
    {
        $id = $this->insert([
            'telephone' => $telephone,
            'solde'     => 0.00,
            'nom'       => $nom,
        ]);

        return $this->find($id);
    }

    public function crediter(int $id, float $montant): bool
    {
        return $this->set('solde', 'solde + ' . $montant, false)
                    ->where('id', $id)
                    ->update();
    }

    public function debiter(int $id, float $montant): bool
    {
        return $this->set('solde', 'solde - ' . $montant, false)
                    ->where('id', $id)
                    ->update();
    }
}
