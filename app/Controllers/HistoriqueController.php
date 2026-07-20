<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\TypeOperationModel;

class HistoriqueController extends BaseClientController
{
    public function index()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client = $this->getClientConnecte();

        $typeOperationId = $this->request->getGet('type');
        $ordre = $this->request->getGet('ordre') === 'ASC' ? 'ASC' : 'DESC';

        $transaction = new TransactionModel();
        $operations  = $transaction->getHistorique($client['id'], $typeOperationId ? (int) $typeOperationId : null, $ordre);

        $typeOperationModel = new TypeOperationModel();
        $types = $typeOperationModel->findAll();

        $getLibelle = function ($typeOperationId) use ($typeOperationModel) {
            $type = $typeOperationModel->find($typeOperationId);
            return $type ? $type['nom'] : 'Inconnu';
        };

        return view('client/historique', [
            'client'         => $client,
            'operations'     => $operations,
            'types'          => $types,
            'filtre_type'    => $typeOperationId,
            'ordre'          => $ordre,
            'getLibelle'     => $getLibelle,
        ]);
    }
}
