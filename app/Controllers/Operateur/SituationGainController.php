<?php

namespace App\Controllers\Operateur;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\TypeOperationModel;

class SituationGainController extends BaseController
{
    protected $transactionModel;
    protected $typeOperationModel;

    public function __construct()
    {
        helper(['url', 'number']);

        $this->transactionModel = new TransactionModel();
        $this->typeOperationModel = new TypeOperationModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $totalFraisGlobal = $this->transactionModel->getTotalFrais();
        $totalCommissions = $this->transactionModel->getTotalCommissions();
        $totalGainsOperateur = $totalFraisGlobal - $totalCommissions;

        $typeOperations = $this->typeOperationModel->findAll();
        $detailsParType = [];
        foreach ($typeOperations as $type) {
            $frais = $this->transactionModel->getTotalFrais($type['id']);
            $commissions = 0.0;

            if ($type['nom'] === 'Transfert') {
                $commissions = $this->transactionModel->where('type_operation_id', $type['id'])
                    ->where('autre_operateur_id !=', null)
                    ->selectSum('commission')
                    ->first();
                $commissions = (float) ($commissions['commission'] ?? 0);
            }

            $detailsParType[] = [
                'nom' => $type['nom'],
                'frais' => $frais,
                'commissions' => $commissions,
                'gains' => $frais - $commissions,
            ];
        }

        return view('operateur/situation_gain/index', [
            'totalFraisGlobal' => $totalFraisGlobal,
            'totalCommissions' => $totalCommissions,
            'totalGainsOperateur' => $totalGainsOperateur,
            'detailsParType' => $detailsParType,
            'page' => 'situation_gain',
        ]);
    }
}
