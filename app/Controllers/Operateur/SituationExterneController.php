<?php

namespace App\Controllers\Operateur;

use App\Controllers\BaseController;
use App\Models\TransactionModel;

class SituationExterneController extends BaseController
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

        $montantsParAutreOperateur = $this->transactionModel->getMontantsParAutreOperateur();

        return view('operateur/situation_externe/index', [
            'montantsParAutreOperateur' => $montantsParAutreOperateur,
            'page' => 'situation_externe',
        ]);
    }
}
