<?php

namespace App\Controllers\Operateur;

use App\Controllers\BaseController;
use App\Models\BaremeFraisModel;
use App\Models\TypeOperationModel;

class BaremeFraisController extends BaseController
{
    protected BaremeFraisModel $baremeModel;
    protected TypeOperationModel $typeOperationModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->baremeModel = new BaremeFraisModel();
        $this->typeOperationModel = new TypeOperationModel();
    }

    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $baremes = $this->baremeModel->getWithTypeName();
        $types = $this->typeOperationModel->findAll();

        return view('operateur/baremes_frais/index', [
            'baremes' => $baremes,
            'types'   => $types,
        ]);
    }

    public function create()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $types = $this->typeOperationModel->findAll();

        return view('operateur/baremes_frais/form', [
            'types' => $types,
        ]);
    }

    public function store()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $rules = [
            'type_operation_id' => 'required|is_not_unique[types_operations.id]',
            'montant_min'       => 'required|numeric|greater_than_equal_to[0]',
            'montant_max'       => 'required|numeric|greater_than_equal_to[0]',
            'frais'             => 'required|numeric|greater_than_equal_to[0]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur de validation : ' . implode(', ', $this->validator->getErrors()));
        }

        $this->baremeModel->insert([
            'type_operation_id' => (int) $this->request->getPost('type_operation_id'),
            'montant_min'       => (float) $this->request->getPost('montant_min'),
            'montant_max'       => (float) $this->request->getPost('montant_max'),
            'frais'             => (float) $this->request->getPost('frais'),
        ]);

        return redirect()->to('/operateur/baremes_frais')
                         ->with('success', 'Barème ajouté avec succès.');
    }

    public function edit($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $bareme = $this->baremeModel->find($id);
        $types = $this->typeOperationModel->findAll();

        if (! $bareme) {
            return redirect()->to('/operateur/baremes_frais')
                             ->with('error', 'Barème introuvable.');
        }

        return view('operateur/baremes_frais/form', [
            'bareme' => $bareme,
            'types'  => $types,
        ]);
    }

    public function update($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $rules = [
            'type_operation_id' => 'required|is_not_unique[types_operations.id]',
            'montant_min'       => 'required|numeric|greater_than_equal_to[0]',
            'montant_max'       => 'required|numeric|greater_than_equal_to[0]',
            'frais'             => 'required|numeric|greater_than_equal_to[0]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur de validation : ' . implode(', ', $this->validator->getErrors()));
        }

        $this->baremeModel->update($id, [
            'type_operation_id' => (int) $this->request->getPost('type_operation_id'),
            'montant_min'       => (float) $this->request->getPost('montant_min'),
            'montant_max'       => (float) $this->request->getPost('montant_max'),
            'frais'             => (float) $this->request->getPost('frais'),
        ]);

        return redirect()->to('/operateur/baremes_frais')
                         ->with('success', 'Barème mis à jour avec succès.');
    }

    public function delete($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/operateur/login');
        }

        $this->baremeModel->delete($id);

        return redirect()->to('/operateur/baremes_frais')
                         ->with('success', 'Barème supprimé.');
    }
}
