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
    private ?int $typeRetraitId = null;

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
        $montant = (float) $this->request->getPost('montant');
        $inclureRetrait = $this->request->getPost('inclure_retrait') === '1';

        if (! $this->validerTransfert($client, $destinataire, $montant, $inclureRetrait, $erreur)) {
            return redirect()->back()->withInput()->with('error', $erreur);
        }

        $destinataireClient = $this->clientModel->getClientByTelephone($destinataire);
        if (! $destinataireClient) {
            $destinataireClient = $this->clientModel->creerClient($destinataire);
        }

        $typeOperationId = $this->getTypeTransfertId();

        $bareme = new BaremeFraisModel();
        $fraisTransfert = $bareme->calculerFrais($typeOperationId, $montant);
        $fraisRetrait = ($inclureRetrait && ! $this->clientModel->estAutreOperateur($destinataire))
            ? $bareme->calculerFrais($this->getTypeRetraitId(), $montant)
            : 0.0;
        $commissionExterne = $this->getCommissionExterne($destinataire, $montant);
        $total = $montant + $fraisTransfert + $fraisRetrait + $commissionExterne;

        $this->clientModel->debiter($client['id'], $total);
        $this->clientModel->crediter($destinataireClient['id'], $montant);

        $prefixeModel = new PrefixeModel();
        $prefixe = $prefixeModel->where('prefixe', substr($destinataire, 0, 3))
                                ->where('type', 'externe')
                                ->first();
        $autreOperateurId = $prefixe['autre_operateur_id'] ?? null;

        $transaction = new TransactionModel();
        $transaction->insert([
            'type_operation_id'   => $typeOperationId,
            'expediteur_id'       => $client['id'],
            'destinataire_id'     => $destinataireClient['id'],
            'autre_operateur_id'  => $autreOperateurId,
            'montant'             => $montant,
            'frais'               => $fraisTransfert + $fraisRetrait,
            'commission'          => $commissionExterne,
            'description'         => 'Transfert vers ' . $destinataire
                                    . ($inclureRetrait ? ' (frais de retrait inclus)' : ''),
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

    private function getTypeRetraitId(): int
    {
        if ($this->typeRetraitId === null) {
            $typeOperationModel = new TypeOperationModel();
            $id = $typeOperationModel->getIdByNom('Retrait');

            if ($id === null) {
                throw new \RuntimeException('Type d\'opération Retrait introuvable en base de données.');
            }

            $this->typeRetraitId = $id;
        }

        return $this->typeRetraitId;
    }

    private function getCommissionExterne(string $telephone, float $montant): float
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

        if (! $operateur) {
            return 0.0;
        }

        return round($montant * ((float) $operateur['commission_transfert'] / 100), 2);
    }

    protected function normaliserTelephone(?string $telephone): string
    {
        return preg_replace('/[^0-9]/', '', (string) $telephone);
    }

    protected function validerTransfert(array $client, string $destinataire, float $montant, bool $inclureRetrait, ?string &$erreur): bool
    {
        if (empty($destinataire) || ! ctype_digit($destinataire) || strlen($destinataire) < 9) {
            $erreur = 'Le numéro du destinataire est invalide.';
            return false;
        }

        if (! $this->clientModel->estMemoqueOperateur($destinataire) && ! $this->clientModel->estAutreOperateur($destinataire)) {
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

        if ($inclureRetrait && $this->clientModel->estAutreOperateur($destinataire)) {
            $erreur = "L'option « inclure les frais de retrait » n'est pas disponible pour un transfert vers un autre opérateur.";
            return false;
        }

        $bareme = new BaremeFraisModel();
        $fraisTransfert = $bareme->calculerFrais($this->getTypeTransfertId(), $montant);
        $fraisRetrait = ($inclureRetrait && ! $this->clientModel->estAutreOperateur($destinataire))
            ? $bareme->calculerFrais($this->getTypeRetraitId(), $montant)
            : 0.0;
        $commissionExterne = $this->getCommissionExterne($destinataire, $montant);
        $total = $montant + $fraisTransfert + $fraisRetrait + $commissionExterne;

        if ((float) $client['solde'] < $total) {
            $erreur = 'Solde insuffisant pour effectuer ce transfert.';
            return false;
        }

        return true;
    }
}
