<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class ClientDashboardController extends BaseClientController
{
    public function index()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client       = $this->getClientConnecte();
        $transaction  = new TransactionModel();
        $derniere     = $transaction->getDerniereOperation($client['id']);

        return view('client/dashboard', [
            'client'   => $client,
            'derniere' => $derniere,
        ]);
    }
}
