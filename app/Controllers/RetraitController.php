<?php

namespace App\Controllers;

use App\Models\BaremeFraisModel;
use App\Models\TransactionModel;

class RetraitController extends BaseClientController
{
    public function index()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client = $this->getClientConnecte();
        $bareme = new BaremeFraisModel();
        $frais  = $bareme->calculerFrais(2, 1000);
        $tranches = $bareme->where('type_operation_id', 2)
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

        $bareme = new BaremeFraisModel();
        $frais  = $bareme->calculerFrais(2, $montant);
        $total  = $montant + $frais;

        if ($client['solde'] < $total) {
            return redirect()->back()->withInput()->with('error', 'Solde insuffisant pour effectuer ce retrait.');
        }

        $this->clientModel->debiter($client['id'], $total);
        $nouveauSolde = $this->clientModel->find($client['id'])['solde'];

        $transaction = new TransactionModel();
        $transaction->insert([
            'type_operation_id' => 2,
            'expediteur_id'     => $client['id'],
            'montant'           => $montant,
            'frais'             => $frais,
            'description'       => 'Retrait',
        ]);

        return redirect()->to('/client/dashboard')
                         ->with('success', 'Retrait effectué avec succès.');
    }
}
