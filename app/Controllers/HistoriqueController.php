<?php

namespace App\Controllers;

use App\Models\OperationModel;
use App\Models\TransactionModel;

class HistoriqueController extends BaseClientController
{
    public function index()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client = $this->getClientConnecte();

        $type  = $this->request->getGet('type');
        $ordre = $this->request->getGet('ordre') === 'ASC' ? 'ASC' : 'DESC';

        $transaction = new TransactionModel();
        $operations  = $transaction->getHistorique($client['id'], $type, $ordre);

        $operationModel = new OperationModel();

        return view('client/historique', [
            'client'         => $client,
            'operations'     => $operations,
            'types'          => $operationModel->getTypesOperation(),
            'filtre_type'    => $type,
            'ordre'          => $ordre,
            'getLibelle'     => fn($t) => $operationModel->getLibelle($t),
        ]);
    }
}
