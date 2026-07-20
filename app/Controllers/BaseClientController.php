<?php

namespace App\Controllers;

use App\Models\ClientModel;
use CodeIgniter\Session\Session;

class BaseClientController extends BaseController
{
    protected ClientModel $clientModel;
    protected Session $session;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->session     = service('session');
        $this->clientModel = new ClientModel();
    }

    protected function estConnecte(): bool
    {
        return $this->session->has('client_id');
    }

    protected function getClientConnecte()
    {
        if (! $this->estConnecte()) {
            return null;
        }

        return $this->clientModel->find($this->session->get('client_id'));
    }

    protected function exigerConnexion()
    {
        if (! $this->estConnecte()) {
            return redirect()->to('/client/login');
        }

        return null;
    }
}
