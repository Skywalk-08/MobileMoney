<?php

namespace App\Controllers;

use App\Models\AutreOperateurModel;
use App\Models\BaremeFraisModel;
use App\Models\PrefixeModel;
use App\Models\TransactionModel;
use App\Models\TypeOperationModel;

class TransfertController extends BaseClientController
{
    private ?int $typeTransfertId = null;

    public function index()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client = $this->getClientConnecte();

        $typeOperationId = $this->getTypeTransfertId();

        $bareme = new BaremeFraisModel();
        $tranches = $bareme->where('type_operation_id', $typeOperationId)
                           ->orderBy('montant_min', 'ASC')
                           ->findAll();

        return view('client/transfert', [
            'client'    => $client,
            'tranches'  => $tranches,
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

        $typeOperationId = $this->getTypeTransfertId();

        $bareme = new BaremeFraisModel();
        $frais  = $bareme->calculerFrais($typeOperationId, $montant);

        $commissionExterne = $this->getCommissionExterne($destinataire);
        $total  = $montant + $frais + $commissionExterne;

        $this->clientModel->debiter($client['id'], $total);
        $this->clientModel->crediter($destinataireClient['id'], $montant);

        $nouveauSolde = $this->clientModel->find($client['id'])['solde'];

        $transaction = new TransactionModel();
        $transaction->insert([
            'type_operation_id' => $typeOperationId,
            'expediteur_id'     => $client['id'],
            'destinataire_id'   => $destinataireClient['id'],
            'montant'           => $montant,
            'frais'             => $frais + $commissionExterne,
            'description'       => 'Transfert vers ' . $destinataire,
        ]);

        return redirect()->to('/client/dashboard')
                         ->with('success', 'Transfert effectué avec succès.');
    }

    private function getTypeTransfertId(): int
    {
        if ($this->typeTransfertId === null) {
            $typeOperationModel = new TypeOperationModel();
            $id = $typeOperationModel->getIdByNom('Transfert');

            if ($id === null) {
                throw new \RuntimeException('Type d\'opération Transfert introuvable en base de données.');
            }

            $this->typeTransfertId = $id;
        }

        return $this->typeTransfertId;
    }

    private function getCommissionExterne(string $telephone): float
    {
        $prefixeModel = new PrefixeModel();
        $prefixe = $prefixeModel->where('prefixe', substr($telephone, 0, 3))
                                ->where('type', 'externe')
                                ->first();

        if (! $prefixe || empty($prefixe['autre_operateur_id'])) {
            return 0.0;
        }

        $operateurModel = new AutreOperateurModel();
        $operateur = $operateurModel->find($prefixe['autre_operateur_id']);

        return $operateur ? (float) $operateur['commission_transfert'] : 0.0;
    }

    protected function normaliserTelephone(?string $telephone): string
    {
        return preg_replace('/[^0-9]/', '', (string) $telephone);
    }

    protected function validerTransfert(array $client, string $destinataire, float $montant, ?string &$erreur): bool
    {
        if (empty($destinataire) || ! ctype_digit($destinataire) || strlen($destinataire) < 9) {
            $erreur = 'Le numéro du destinataire est invalide.';
            return false;
        }

        $prefixeModel = new PrefixeModel();
        $prefixe = $prefixeModel->where('prefixe', substr($destinataire, 0, 3))
                                ->where('actif', 1)
                                ->first();

        if (! $prefixe) {
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

        $bareme = new BaremeFraisModel();
        $frais  = $bareme->calculerFrais($this->getTypeTransfertId(), $montant);
        $commissionExterne = $this->getCommissionExterne($destinataire);
        $total  = $montant + $frais + $commissionExterne;

        if ($client['solde'] < $total) {
            $erreur = 'Solde insuffisant pour effectuer ce transfert.';
            return false;
        }

        return true;
    }
}
