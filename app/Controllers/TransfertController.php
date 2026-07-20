<?php

namespace App\Controllers;

use App\Models\BaremeFraisModel;
use App\Models\TransactionModel;

class TransfertController extends BaseClientController
{
    public function index()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client = $this->getClientConnecte();

        return view('client/transfert', [
            'client' => $client,
        ]);
    }

    public function store()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client = $this->getClientConnecte();

        $destinataire = $this->normaliserTelephone($this->request->getPost('destinataire'));
        $montant      = (float) $this->request->getPost('montant');

        if (! $this->validerTransfert($client, $destinataire, $montant, $erreur)) {
            return redirect()->back()->withInput()->with('error', $erreur);
        }

        $destinataireClient = $this->clientModel->getClientByTelephone($destinataire);
        if (! $destinataireClient) {
            $destinataireClient = $this->clientModel->creerClient($destinataire);
        }

        $bareme = new BaremeFraisModel();
        $frais  = $bareme->calculerFrais(3, $montant);
        $total  = $montant + $frais;

        $this->clientModel->debiter($client['id'], $total);
        $this->clientModel->crediter($destinataireClient['id'], $montant);

        $nouveauSolde = $this->clientModel->find($client['id'])['solde'];

        $transaction = new TransactionModel();
        $transaction->insert([
            'type_operation_id' => 3,
            'expediteur_id'     => $client['id'],
            'destinataire_id'   => $destinataireClient['id'],
            'montant'           => $montant,
            'frais'             => $frais,
            'description'       => 'Transfert vers ' . $destinataire,
        ]);

        return redirect()->to('/client/dashboard')
                         ->with('success', 'Transfert effectué avec succès.');
    }

    protected function normaliserTelephone(?string $telephone): string
    {
        $telephone = preg_replace('/[^0-9]/', '', (string) $telephone);

        if (str_starts_with($telephone, '0')) {
            $telephone = '261' . substr($telephone, 1);
        }

        return $telephone;
    }

    protected function validerTransfert(array $client, string $destinataire, float $montant, ?string &$erreur): bool
    {
        if (empty($destinataire) || ! ctype_digit($destinataire) || strlen($destinataire) < 9) {
            $erreur = 'Le numéro du destinataire est invalide.';
            return false;
        }

        if (! $this->clientModel->isPrefixeValide($destinataire)) {
            $erreur = 'Le préfixe du destinataire est inconnu.';
            return false;
        }

        if ($destinataire === $client['telephone']) {
            $erreur = 'Vous ne pouvez pas transférer vers votre propre numéro.';
            return false;
        }

        if ($montant <= 0) {
            $erreur = 'Le montant doit être supérieur à 0.';
            return false;
        }

        $bareme = new BaremeModel();
        $frais  = $bareme->calculerFrais('transfert', $montant);
        $total  = $montant + $frais;

        if ($client['solde'] < $total) {
            $erreur = 'Solde insuffisant pour effectuer ce transfert.';
            return false;
        }

        return true;
    }
}
