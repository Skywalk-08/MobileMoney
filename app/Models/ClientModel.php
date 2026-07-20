<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table            = 'clients';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['telephone', 'solde', 'nom'];
    protected $validationRules  = [
        'telephone' => 'required|max_length[20]',
    ];

    protected $prefixesAutorises = ['033', '037', '034', '038', '032'];

    public function getClientByTelephone(string $telephone)
    {
        return $this->where('telephone', $telephone)->first();
    }

    public function isPrefixeValide(string $telephone): bool
    {
        foreach ($this->prefixesAutorises as $prefixe) {
            if (str_starts_with($telephone, $prefixe)) {
                return true;
            }
        }

        return false;
    }

    public function getPrefixes(): array
    {
        return $this->prefixesAutorises;
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
