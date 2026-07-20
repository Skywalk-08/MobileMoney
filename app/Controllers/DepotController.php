<?php

namespace App\Controllers;

use App\Models\BaremeFraisModel;
use App\Models\TransactionModel;
use App\Models\TypeOperationModel;

class DepotController extends BaseClientController
{
    private ?int $typeDepotId = null;

    public function index()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client = $this->getClientConnecte();

        $typeOperationId = $this->getTypeDepotId();

        $bareme = new BaremeFraisModel();
        $frais  = $bareme->calculerFrais($typeOperationId, 0);
        $tranches = $bareme->where('type_operation_id', $typeOperationId)
                           ->orderBy('montant_min', 'ASC')
                           ->findAll();

        return view('client/depot', [
            'client'      => $client,
            'frais_depot' => $frais,
            'tranches'    => $tranches,
        ]);
    }

    public function store()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client = $this->getClientConnecte();
        $montant = (float) $this->request->getPost('montant');

        if (! $this->montantValide($montant, $erreur)) {
            return redirect()->back()->withInput()->with('error', $erreur);
        }

        $typeOperationId = $this->getTypeDepotId();

        $bareme = new BaremeFraisModel();
        $frais  = $bareme->calculerFrais($typeOperationId, $montant);

        $this->clientModel->crediter($client['id'], $montant);
        $nouveauSolde = $this->clientModel->find($client['id'])['solde'];

        $transaction = new TransactionModel();
        $transaction->insert([
            'type_operation_id' => $typeOperationId,
            'expediteur_id'     => $client['id'],
            'montant'           => $montant,
            'frais'             => $frais,
            'description'       => 'Dépôt',
        ]);

        return redirect()->to('/client/dashboard')
                         ->with('success', 'Dépôt effectué avec succès.');
    }

    private function getTypeDepotId(): int
    {
        if ($this->typeDepotId === null) {
            $typeOperationModel = new TypeOperationModel();
            $id = $typeOperationModel->getIdByNom('Depot');

            if ($id === null) {
                throw new \RuntimeException('Type d\'opération Dépôt introuvable en base de données.');
            }

            $this->typeDepotId = $id;
        }

        return $this->typeDepotId;
    }

    protected function montantValide(float $montant, ?string &$erreur): bool
    {
        if ($montant <= 0) {
            $erreur = 'Le montant doit être supérieur à 0.';
            return false;
        }

        return true;
    }
}
