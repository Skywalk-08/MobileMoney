<?php

namespace App\Controllers;

use App\Models\BaremeFraisModel;
use App\Models\TransactionModel;
use App\Models\TypeOperationModel;

class RetraitController extends BaseClientController
{
    private ?int $typeRetraitId = null;

    public function index()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client = $this->getClientConnecte();
        $typeOperationId = $this->getTypeRetraitId();

        $bareme = new BaremeFraisModel();
        $frais  = $bareme->calculerFrais($typeOperationId, 1000);
        $tranches = $bareme->where('type_operation_id', $typeOperationId)
                           ->orderBy('montant_min', 'ASC')
                           ->findAll();

        return view('client/retrait', [
            'client'         => $client,
            'taux_retrait'   => $frais,
            'tranches'       => $tranches,
        ]);
    }

    public function store()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client  = $this->getClientConnecte();
        $montant = (float) $this->request->getPost('montant');

        if ($montant <= 0) {
            return redirect()->back()->withInput()->with('error', 'Le montant doit être supérieur à 0.');
        }

        $typeOperationId = $this->getTypeRetraitId();

        $bareme = new BaremeFraisModel();
        $frais  = $bareme->calculerFrais($typeOperationId, $montant);
        $total  = $montant + $frais;

        if ($client['solde'] < $total) {
            return redirect()->back()->withInput()->with('error', 'Solde insuffisant pour effectuer ce retrait.');
        }

        $this->clientModel->debiter($client['id'], $total);
        $nouveauSolde = $this->clientModel->find($client['id'])['solde'];

        $transaction = new TransactionModel();
        $transaction->insert([
            'type_operation_id' => $typeOperationId,
            'expediteur_id'     => $client['id'],
            'montant'           => $montant,
            'frais'             => $frais,
            'description'       => 'Retrait',
        ]);

        return redirect()->to('/client/dashboard')
                         ->with('success', 'Retrait effectué avec succès.');
    }

    private function getTypeRetraitId(): int
    {
        if ($this->typeRetraitId === null) {
            $typeOperationModel = new TypeOperationModel();
            $id = $typeOperationModel->getIdByNom('Retrait');

            if ($id === null) {
                throw new \RuntimeException('Type d\'opération Retrait introuvable en base de données.');
            }

            $this->typeRetraitId = $id;
        }

        return $this->typeRetraitId;
    }
}
