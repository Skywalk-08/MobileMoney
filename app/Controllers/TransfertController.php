<?php

namespace App\Controllers;

use App\Models\BaremeFraisModel;
use App\Models\TransactionModel;
use App\Models\TypeOperationModel;

class TransfertController extends BaseClientController
{
    private ?int $typeTransfertId = null;
    private ?int $typeRetraitId   = null;

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
        $inclureRetrait = (bool) $this->request->getPost('inclure_frais_retrait');
        $confirmer     = (bool) $this->request->getPost('confirmer');

        if (! $this->validerTransfert($client, $destinataire, $montant, $inclureRetrait, $erreur)) {
            return redirect()->back()->withInput()->with('error', $erreur);
        }

        $typeTransfertId = $this->getTypeTransfertId();
        $typeRetraitId   = $this->getTypeRetraitId();

        $bareme = new BaremeFraisModel();
        $fraisTransfert = $bareme->calculerFrais($typeTransfertId, $montant);

        $fraisRetrait = 0.0;
        if ($inclureRetrait) {
            $fraisRetrait = $bareme->calculerFrais($typeRetraitId, $montant);
        }

        $total = $montant + $fraisTransfert + $fraisRetrait;

        if (! $confirmer) {
            return view('client/transfert-confirm', [
                'client'         => $client,
                'destinataire'   => $destinataire,
                'montant'        => $montant,
                'inclureRetrait' => $inclureRetrait,
                'fraisTransfert' => $fraisTransfert,
                'fraisRetrait'   => $fraisRetrait,
                'total'          => $total,
                'nouveauSolde'   => (float) $client['solde'] - $total,
            ]);
        }

        $destinataireClient = $this->clientModel->getClientByTelephone($destinataire);
        if (! $destinataireClient) {
            $destinataireClient = $this->clientModel->creerClient($destinataire);
        }

        $this->clientModel->debiter($client['id'], $total);
        $this->clientModel->crediter($destinataireClient['id'], $montant);

        $transaction = new TransactionModel();
        $transaction->insert([
            'type_operation_id' => $typeTransfertId,
            'expediteur_id'     => $client['id'],
            'destinataire_id'   => $destinataireClient['id'],
            'montant'           => $montant,
            'frais'             => $fraisTransfert + $fraisRetrait,
            'description'       => 'Transfert vers ' . $destinataire
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

        if (! $this->clientModel->estMemoqueOperateur($destinataire)) {
            if ($this->clientModel->estAutreOperateur($destinataire)) {
                $erreur = 'Les transferts vers un autre opérateur ne sont pas pris en charge.';
            } else {
                $erreur = 'Le préfixe du destinataire est inconnu.';
            }
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

        if ($inclureRetrait && ! $this->clientModel->estMemoqueOperateur($destinataire)) {
            $erreur = "L'option « inclure les frais de retrait » est disponible uniquement pour un transfert vers le même opérateur.";
            return false;
        }

        $bareme = new BaremeFraisModel();
        $fraisTransfert = $bareme->calculerFrais($this->getTypeTransfertId(), $montant);
        $fraisRetrait   = $inclureRetrait ? $bareme->calculerFrais($this->getTypeRetraitId(), $montant) : 0.0;
        $total          = $montant + $fraisTransfert + $fraisRetrait;

        if ((float) $client['solde'] < $total) {
            $erreur = 'Solde insuffisant pour effectuer ce transfert.';
            return false;
        }

        return true;
    }
}
