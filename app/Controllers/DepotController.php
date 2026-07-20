<?php

namespace App\Controllers;

use App\Models\BaremeFraisModel;
use App\Models\TransactionModel;

class DepotController extends BaseClientController
{
    public function index()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client = $this->getClientConnecte();

        $bareme = new BaremeFraisModel();
        $frais  = $bareme->calculerFrais(1, 0);

        return view('client/depot', [
            'client'      => $client,
            'frais_depot' => $frais,
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

        $bareme = new BaremeFraisModel();
        $frais  = $bareme->calculerFrais(1, $montant);

        $this->clientModel->crediter($client['id'], $montant);
        $nouveauSolde = $this->clientModel->find($client['id'])['solde'];

        $transaction = new TransactionModel();
        $transaction->insert([
            'type_operation_id' => 1,
            'expediteur_id'     => $client['id'],
            'montant'           => $montant,
            'frais'             => $frais,
            'description'       => 'Dépôt',
        ]);

        return redirect()->to('/client/dashboard')
                         ->with('success', 'Dépôt effectué avec succès.');
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
