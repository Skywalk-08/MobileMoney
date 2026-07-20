<?php

namespace App\Controllers\Operateur;

use App\Controllers\BaseController;
use App\Models\TypeOperationModel;

class TypeOperationController extends BaseController
{
    protected TypeOperationModel $typeOperationModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->typeOperationModel = new TypeOperationModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $types = $this->typeOperationModel->findAll();

        return view('operateur/types_operations/index', [
            'types' => $types,
        ]);
    }

    public function create()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        return view('operateur/types_operations/form');
    }

    public function store()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $rules = [
            'nom' => 'required|min_length[2]|max_length[50]|is_unique[types_operations.nom]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur de validation : ' . implode(', ', $this->validator->getErrors()));
        }

        $this->typeOperationModel->insert([
            'nom'   => trim($this->request->getPost('nom')),
            'actif' => 1,
        ]);

        return redirect()->to('/operateur/types_operations')
                         ->with('success', 'Type d\'opération ajouté avec succès.');
    }

    public function toggle($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $type = $this->typeOperationModel->find($id);

        if (! $type) {
            return redirect()->back()->with('error', 'Type d\'opération introuvable.');
        }

        $this->typeOperationModel->update($id, [
            'actif' => $type['actif'] ? 0 : 1,
        ]);

        return redirect()->to('/operateur/types_operations')
                         ->with('success', 'Type d\'opération mis à jour.');
    }

    public function delete($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $this->typeOperationModel->delete($id);

        return redirect()->to('/operateur/types_operations')
                         ->with('success', 'Type d\'opération supprimé.');
    }
}
