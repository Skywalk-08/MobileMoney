<?php

namespace App\Controllers;

use App\Models\ClientModel;
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
        $clientModel        = new ClientModel();
        $types = $typeOperationModel->findAll();

        $referencesMultiples = $this->getReferencesMultiples($operations);

        foreach ($operations as &$op) {
            $type = $typeOperationModel->find($op['type_operation_id']);
            $op['type_libelle'] = $type ? $type['nom'] : 'Inconnu';

            $expediteur   = $clientModel->find($op['expediteur_id']);
            $destinataire = $clientModel->find($op['destinataire_id']);
            $op['expediteur_tel']   = $expediteur['telephone'] ?? '-';
            $op['destinataire_tel'] = $destinataire['telephone'] ?? '-';
            $op['est_multiple']     = isset($referencesMultiples[$op['reference']]);
        }
        unset($op);

        return view('client/historique', [
            'client'      => $client,
            'operations'  => $operations,
            'types'       => $types,
            'filtre_type' => $typeOperationId,
            'ordre'       => $ordre,
        ]);
    }

    private function getReferencesMultiples(array $operations): array
    {
        $compte = [];

        foreach ($operations as $op) {
            if (! empty($op['reference']) && str_starts_with($op['reference'], 'MULTI')) {
                $compte[$op['reference']] = ($compte[$op['reference']] ?? 0) + 1;
            }
        }

        return array_filter($compte, static fn ($n) => $n > 1);
    }
}
