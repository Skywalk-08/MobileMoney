<?php

namespace App\Controllers\Operateur;

use App\Controllers\BaseController;
use App\Models\PrefixeModel;

class PrefixeController extends BaseController
{
    protected PrefixeModel $prefixeModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->prefixeModel = new PrefixeModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $prefixes = $this->prefixeModel->findAll();

        return view('operateur/prefixes/index', [
            'prefixes' => $prefixes,
        ]);
    }

    public function create()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        return view('operateur/prefixes/form');
    }

    public function store()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $rules = [
            'prefixe' => 'required|min_length[2]|max_length[10]|is_unique[prefixes.prefixe]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur de validation : ' . implode(', ', $this->validator->getErrors()));
        }

        $this->prefixeModel->insert([
            'prefixe' => trim($this->request->getPost('prefixe')),
            'actif'   => 1,
        ]);

        return redirect()->to('/operateur/prefixes')
                         ->with('success', 'Préfixe ajouté avec succès.');
    }

    public function toggle($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $prefixe = $this->prefixeModel->find($id);

        if (! $prefixe) {
            return redirect()->back()->with('error', 'Préfixe introuvable.');
        }

        $this->prefixeModel->update($id, [
            'actif' => $prefixe['actif'] ? 0 : 1,
        ]);

        return redirect()->to('/operateur/prefixes')
                         ->with('success', 'Préfixe mis à jour.');
    }

    public function delete($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $this->prefixeModel->delete($id);

        return redirect()->to('/operateur/prefixes')
                         ->with('success', 'Préfixe supprimé.');
    }
}
