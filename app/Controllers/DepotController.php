<?php

namespace App\Controllers;

use App\Models\BaremeModel;
use App\Models\TransactionModel;

class DepotController extends BaseClientController
{
    public function index()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client = $this->getClientConnecte();

        $bareme = new BaremeModel();
        $frais  = $bareme->calculerFrais('depot', 0);

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

        $bareme = new BaremeModel();
        $frais  = $bareme->calculerFrais('depot', $montant);

        $this->clientModel->crediter($client['id'], $montant);
        $nouveauSolde = $this->clientModel->find($client['id'])['solde'];

        $transaction = new TransactionModel();
        $transaction->insert([
            'client_id'      => $client['id'],
            'type_operation' => 'depot',
            'montant'        => $montant,
            'frais'          => $frais,
            'solde_apres'    => $nouveauSolde,
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
