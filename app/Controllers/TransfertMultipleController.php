<?php

namespace App\Controllers;

use App\Models\BaremeFraisModel;
use App\Models\TransactionModel;
use App\Models\TypeOperationModel;

class TransfertMultipleController extends BaseClientController
{
    private ?int $typeTransfertId = null;

    public function index()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client = $this->getClientConnecte();

        return view('client/transfert-multiple', [
            'client' => $client,
        ]);
    }

    public function store()
    {
        if ($redirect = $this->exigerConnexion()) {
            return $redirect;
        }

        $client = $this->getClientConnecte();

        $destinataires = $this->request->getPost('destinataires');
        $montantTotal  = (float) $this->request->getPost('montant_total');
        $confirmer     = (bool) $this->request->getPost('confirmer');

        $resultat = $this->preparerTransferts($client, $destinataires, $montantTotal, $erreur);

        if ($resultat === null) {
            return redirect()->back()->withInput()->with('error', $erreur);
        }

        if (! $confirmer) {
            return view('client/transfert-multiple-confirm', [
                'client'  => $client,
                'parts'   => $resultat['parts'],
                'totalFrais'   => $resultat['totalFrais'],
                'totalDebite'  => $resultat['totalDebite'],
                'destinataires' => $resultat['destinataires'],
                'montantTotal'  => $montantTotal,
                'nouveauSolde'  => (float) $client['solde'] - $resultat['totalDebite'],
            ]);
        }

        $typeTransfertId = $this->getTypeTransfertId();
        $transaction = new TransactionModel();
        $reference   = 'MULTI' . date('YmdHis') . strtoupper(substr(bin2hex(random_bytes(3)), 0, 4));

        foreach ($resultat['parts'] as $index => $part) {
            $destinataireClient = $this->clientModel->getClientByTelephone($part['numero']);
            if (! $destinataireClient) {
                $destinataireClient = $this->clientModel->creerClient($part['numero']);
            }

            $this->clientModel->debiter($client['id'], $part['montant'] + $part['frais']);
            $this->clientModel->crediter($destinataireClient['id'], $part['montant']);

            $transaction->insert([
                'reference'         => $reference . '-' . ($index + 1),
                'type_operation_id' => $typeTransfertId,
                'expediteur_id'     => $client['id'],
                'destinataire_id'   => $destinataireClient['id'],
                'montant'           => $part['montant'],
                'frais'             => $part['frais'],
                'description'       => 'Transfert multiple vers ' . $part['numero'],
            ]);
        }

        return redirect()->to('/client/dashboard')
                         ->with('success', 'Transferts multiples effectués avec succès (' . count($resultat['parts']) . ' bénéficiaires).');
    }

    private function preparerTransferts(array $client, ?string $destinataires, float $montantTotal, ?string &$erreur): ?array
    {
        if (empty($destinataires)) {
            $erreur = 'Veuillez saisir au moins un numéro de destinataire.';
            return null;
        }

        if ($montantTotal <= 0) {
            $erreur = 'Le montant total doit être supérieur à 0.';
            return null;
        }

        $numeros  = [];
        $doublons = [];
        $lignes   = preg_split('/[\s,;]+/', (string) $destinataires);

        foreach ($lignes as $ligne) {
            $numero = $this->normaliserTelephone($ligne);
            if ($numero === '') {
                continue;
            }
            if (ctype_digit($numero) && strlen($numero) < 9) {
                $erreur = 'Le numéro ' . $numero . ' est invalide.';
                return null;
            }
            if (! $this->clientModel->estMemoqueOperateur($numero)) {
                if ($this->clientModel->estAutreOperateur($numero)) {
                    $erreur = 'Le numéro ' . $numero . ' appartient à un autre opérateur et n\'est pas autorisé.';
                } else {
                    $erreur = 'Le numéro ' . $numero . ' a un préfixe inconnu.';
                }
                return null;
            }
            if (in_array($numero, $numeros, true)) {
                $doublons[] = $numero;
                continue;
            }
            $numeros[] = $numero;
        }

        if (! empty($doublons)) {
            $erreur = 'Doublon détecté dans la liste des destinataires : ' . implode(', ', array_unique($doublons));
            return null;
        }

        if (empty($numeros)) {
            $erreur = 'Aucun destinataire valide.';
            return null;
        }

        $parts    = $this->repartirMontant($montantTotal, count($numeros));
        $bareme   = new BaremeFraisModel();
        $typeTransfertId = $this->getTypeTransfertId();

        $details    = [];
        $totalFrais = 0.0;

        foreach ($numeros as $i => $numero) {
            $frais = $bareme->calculerFrais($typeTransfertId, $parts[$i]);
            $totalFrais += $frais;
            $details[] = [
                'numero'  => $numero,
                'montant' => $parts[$i],
                'frais'   => $frais,
            ];
        }

        $totalDebite = $montantTotal + $totalFrais;

        if ((float) $client['solde'] < $totalDebite) {
            $erreur = 'Solde insuffisant pour effectuer ces transferts multiples.';
            return null;
        }

        return [
            'parts'       => $details,
            'totalFrais'  => $totalFrais,
            'totalDebite' => $totalDebite,
            'destinataires' => $numeros,
        ];
    }

    private function repartirMontant(float $montantTotal, int $nb): array
    {
        $parts = array_fill(0, $nb, floor(($montantTotal / $nb) * 100) / 100);
        $reste = round($montantTotal - array_sum($parts), 2);

        $parts[0] = round($parts[0] + $reste, 2);

        return $parts;
    }

    private function normaliserTelephone(?string $telephone): string
    {
        return preg_replace('/[^0-9]/', '', (string) $telephone);
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
}
