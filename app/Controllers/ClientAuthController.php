<?php

namespace App\Controllers;

use App\Models\ClientModel;

class ClientAuthController extends BaseClientController
{
    public function login()
    {
        if ($this->estConnecte()) {
            return redirect()->to('/client/dashboard');
        }

        return view('client/login');
    }

    public function authenticate()
    {
        $telephone = $this->normaliserTelephone($this->request->getPost('telephone'));

        if (! $this->validerTelephone($telephone, $erreur)) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', $erreur);
        }

        $client = $this->clientModel->getClientByTelephone($telephone);

        if (! $client) {
            $client = $this->clientModel->creerClient($telephone);
        }

        $this->session->set('client_id', $client['id']);
        $this->session->set('client_telephone', $client['telephone']);

        return redirect()->to('/client/dashboard');
    }

    public function logout()
    {
        $this->session->destroy();

        return redirect()->to('/client/login');
    }

    protected function normaliserTelephone(?string $telephone): string
    {
        $telephone = preg_replace('/[^0-9]/', '', (string) $telephone);

        if (str_starts_with($telephone, '0')) {
            $telephone = '261' . substr($telephone, 1);
        }

        return $telephone;
    }

    protected function validerTelephone(string $telephone, ?string &$erreur): bool
    {
        if (empty($telephone)) {
            $erreur = 'Veuillez saisir votre numéro de téléphone.';
            return false;
        }

        if (! ctype_digit($telephone) || strlen($telephone) < 9) {
            $erreur = 'Le numéro de téléphone est invalide.';
            return false;
        }

        if (! $this->clientModel->isPrefixeValide($telephone)) {
            $erreur = 'Le préfixe du numéro est inconnu (' . implode(', ', $this->clientModel->getPrefixes()) . ').';
            return false;
        }

        return true;
    }
}
