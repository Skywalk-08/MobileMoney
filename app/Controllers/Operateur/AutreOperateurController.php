<?php

namespace App\Controllers\Operateur;

use App\Controllers\BaseController;
use App\Models\AutreOperateurModel;

class AutreOperateurController extends BaseController
{
    protected AutreOperateurModel $operateurModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->operateurModel = new AutreOperateurModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $operateurs = $this->operateurModel->findAll();

        return view('operateur/autres_operateurs/index', [
            'operateurs' => $operateurs,
        ]);
    }

    public function create()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        return view('operateur/autres_operateurs/form');
    }

    public function store()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $rules = [
            'nom'                => 'required|min_length[2]|max_length[100]|is_unique[autres_operateurs.nom]',
            'commission_transfert' => 'required|numeric|greater_than_equal_to[0]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur de validation : ' . implode(', ', $this->validator->getErrors()));
        }

        $this->operateurModel->insert([
            'nom'                 => trim($this->request->getPost('nom')),
            'commission_transfert' => (float) $this->request->getPost('commission_transfert'),
            'actif'               => 1,
        ]);

        return redirect()->to('/operateur/autres_operateurs')
                         ->with('success', 'Opérateur ajouté avec succès.');
    }

    public function edit($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $operateur = $this->operateurModel->find($id);

        if (! $operateur) {
            return redirect()->to('/operateur/autres_operateurs')
                             ->with('error', 'Opérateur introuvable.');
        }

        return view('operateur/autres_operateurs/form', [
            'operateur' => $operateur,
        ]);
    }

    public function update($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $rules = [
            'nom'                => 'required|min_length[2]|max_length[100]|is_unique[autres_operateurs.nom,id,' . $id . ']',
            'commission_transfert' => 'required|numeric|greater_than_equal_to[0]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur de validation : ' . implode(', ', $this->validator->getErrors()));
        }

        $this->operateurModel->update($id, [
            'nom'                 => trim($this->request->getPost('nom')),
            'commission_transfert' => (float) $this->request->getPost('commission_transfert'),
            'actif'               => (int) $this->request->getPost('actif'),
        ]);

        return redirect()->to('/operateur/autres_operateurs')
                         ->with('success', 'Opérateur mis à jour avec succès.');
    }

    public function toggle($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $operateur = $this->operateurModel->find($id);

        if (! $operateur) {
            return redirect()->back()->with('error', 'Opérateur introuvable.');
        }

        $this->operateurModel->update($id, [
            'actif' => $operateur['actif'] ? 0 : 1,
        ]);

        return redirect()->to('/operateur/autres_operateurs')
                         ->with('success', 'Opérateur mis à jour.');
    }

    public function delete($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $this->operateurModel->delete($id);

        return redirect()->to('/operateur/autres_operateurs')
                         ->with('success', 'Opérateur supprimé.');
    }
}
