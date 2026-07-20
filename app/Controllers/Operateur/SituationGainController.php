<?php

namespace App\Controllers\Operateur;

use App\Controllers\BaseController;
use App\Models\TransactionModel;

class SituationGainController extends BaseController
{
    protected $transactionModel;

    public function __construct()
    {
        helper(['url', 'number']);

        $this->transactionModel = new TransactionModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $totalFraisGlobal = $this->transactionModel->getTotalFrais();
        $totalCommissions = $this->transactionModel->getTotalCommissions();
        $totalGainsOperateur = $totalFraisGlobal - $totalCommissions;

        return view('operateur/situation_gain/index', [
            'totalGainsOperateur' => $totalGainsOperateur,
            'totalCommissions'    => $totalCommissions,
            'page' => 'situation_gain',
        ]);
    }
}
