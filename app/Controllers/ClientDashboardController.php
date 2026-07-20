<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\TypeOperationModel;

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

        $typeOperationModel = new TypeOperationModel();
        $getLibelle = function ($typeOperationId) use ($typeOperationModel) {
            $type = $typeOperationModel->find($typeOperationId);
            return $type ? $type['nom'] : 'Inconnu';
        };

        return view('client/dashboard', [
            'client'      => $client,
            'derniere'    => $derniere,
            'getLibelle'  => $getLibelle,
        ]);
    }
}
