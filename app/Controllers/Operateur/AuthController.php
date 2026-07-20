<?php

namespace App\Controllers\Operateur;
use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    /**
     * Affiche la page de connexion
     */
    public function index()
    {
        // Si déjà connecté
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('admin/auth/login');
    }

    public function login()
    {
        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        if (empty($email) || empty($password)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Veuillez remplir tous les champs.');
        }

        $user = $this->userModel
            ->where('email', $email)
            ->where('role', 'admin')
            ->where('actif', 1)
            ->first();

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email ou mot de passe incorrect.');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email ou mot de passe incorrect.');
        }

        session()->set([
            'user_id'      => $user['id'],
            'nom'          => $user['nom'],
            'prenom'       => $user['prenom'],
            'email'        => $user['email'],
            'telephone'    => $user['telephone'],
            'role'         => $user['role'],
            'isLoggedIn'   => true
        ]);

        return redirect()->to('/admin/dashboard')
            ->with('success', 'Bienvenue ' . $user['prenom'] . ' !');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/admin/login')
            ->with('success', 'Vous êtes déconnecté.');
    }
}