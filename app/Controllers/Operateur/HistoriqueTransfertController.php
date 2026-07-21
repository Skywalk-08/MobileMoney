<?php

namespace App\Controllers\Operateur;

use App\Controllers\BaseController;
use App\Models\AutreOperateurModel;
use App\Models\ClientModel;
use App\Models\TransactionModel;
use App\Models\TypeOperationModel;

class HistoriqueTransfertController extends BaseController
{
    protected $transactionModel;
    protected $clientModel;
    protected $typeOperationModel;
    protected $autreOperateurModel;

    public function __construct()
    {
        helper(['url', 'number']);

        $this->transactionModel   = new TransactionModel();
        $this->clientModel        = new ClientModel();
        $this->typeOperationModel = new TypeOperationModel();
        $this->autreOperateurModel = new AutreOperateurModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $transfertId = $this->typeOperationModel->getIdByNom('Transfert');

        $transfers = $this->transactionModel
            ->where('type_operation_id', $transfertId)
            ->orderBy('date_transaction', 'DESC')
            ->findAll();

        $operateurs = [];
        foreach ($transfers as &$t) {
            $expediteur   = $this->clientModel->find($t['expediteur_id']);
            $destinataire = $this->clientModel->find($t['destinataire_id']);
            $t['expediteur_tel']   = $expediteur['telephone'] ?? '-';
            $t['destinataire_tel'] = $destinataire['telephone'] ?? '-';

            if (!empty($t['autre_operateur_id'])) {
                if (!isset($operateurs[$t['autre_operateur_id']])) {
                    $operateurs[$t['autre_operateur_id']] = $this->autreOperateurModel->find($t['autre_operateur_id']);
                }
                $t['operateur_nom'] = $operateurs[$t['autre_operateur_id']]['nom'] ?? '-';
            } else {
                $t['operateur_nom'] = null;
            }
        }
        unset($t);

        return view('operateur/historique_transfert', [
            'transfers' => $transfers,
            'page'      => 'historique_transfert',
        ]);
    }
}
