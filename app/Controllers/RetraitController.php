<?php

namespace App\Controllers;

use App\Models\BaremeModel;
use App\Models\TransactionModel;

class RetraitController extends BaseClientController
{
    public function index()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client = $this->getClientConnecte();
        $bareme = new BaremeModel();
        $frais  = $bareme->calculerFrais('retrait', 1000);

        return view('client/retrait', [
            'client'         => $client,
            'taux_retrait'   => $frais,
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

        $bareme = new BaremeModel();
        $frais  = $bareme->calculerFrais('retrait', $montant);
        $total  = $montant + $frais;

        if ($client['solde'] < $total) {
            return redirect()->back()->withInput()->with('error', 'Solde insuffisant pour effectuer ce retrait.');
        }

        $this->clientModel->debiter($client['id'], $total);
        $nouveauSolde = $this->clientModel->find($client['id'])['solde'];

        $transaction = new TransactionModel();
        $transaction->insert([
            'client_id'      => $client['id'],
            'type_operation' => 'retrait',
            'montant'        => $montant,
            'frais'          => $frais,
            'solde_apres'    => $nouveauSolde,
        ]);

        return redirect()->to('/client/dashboard')
                         ->with('success', 'Retrait effectué avec succès.');
    }
}
