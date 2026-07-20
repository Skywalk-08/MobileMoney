<?php

namespace App\Controllers\Operateur;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\TransactionModel;
use App\Models\BaremeFraisModel;
use App\Models\TypeOperationModel;

class DashboardController extends BaseController
{
    protected $clientModel;
    protected $transactionModel;
    protected $baremeModel;
    protected $typeOperationModel;

    public function __construct()
    {
        helper(['url', 'number']);

        $this->clientModel = new ClientModel();
        $this->transactionModel = new TransactionModel();
        $this->baremeModel = new BaremeFraisModel();
        $this->typeOperationModel = new TypeOperationModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $nombreClients = $this->clientModel
            ->where('actif', 1)
            ->countAllResults();

        $totalSolde = $this->clientModel
            ->selectSum('solde')
            ->first();

        $totalTransactions = $this->transactionModel->countAll();

        $totalFraisGlobal = $this->transactionModel->getTotalFrais();
        $totalCommissions = $this->transactionModel->getTotalCommissions();
        $totalGainsOperateur = $totalFraisGlobal - $totalCommissions;

        $typeOperations = $this->typeOperationModel->findAll();
        $fraisParType = [];
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

            $fraisParType[] = [
                'nom' => $type['nom'],
                'gains' => $frais - $commissions,
                'commissions' => $commissions,
            ];
        }

        $montantsParAutreOperateur = $this->transactionModel->getMontantsParAutreOperateur();

        $clients = $this->clientModel
            ->where('actif', 1)
            ->orderBy('solde', 'DESC')
            ->findAll();

        $data = [
            'nombreClients'         => $nombreClients,
            'totalSolde'            => $totalSolde['solde'] ?? 0,
            'totalTransactions'     => $totalTransactions,
            'totalFraisGlobal'      => $totalFraisGlobal,
            'totalGainsOperateur'   => $totalGainsOperateur,
            'totalCommissions'      => $totalCommissions,
            'fraisParType'          => $fraisParType,
            'montantsParAutreOperateur' => $montantsParAutreOperateur,
            'clients'               => $clients,
        ];

        return view('operateur/dashboard', $data);
    }
}
