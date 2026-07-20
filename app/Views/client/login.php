<?= $this->extend('client/layout') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="card-title text-center mb-4">Connexion client</h3>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
                <?php endif; ?>

                <p class="text-muted text-center small">
                    Connectez-vous avec votre numéro Mobile Money.<br>
                    Pas de compte ? Il sera créé automatiquement.
                </p>

                <form action="/client/login/authenticate" method="post">
                    <div class="mb-3">
                        <label for="telephone" class="form-label">Numéro de téléphone</label>
                        <input type="text" class="form-control form-control-lg" id="telephone"
                               name="telephone" placeholder="Ex : 033 12 345 67"
                               value="<?= esc(old('telephone')) ?>" required autofocus>
                        <div class="form-text">Préfixes acceptés : 032, 033, 034, 037, 038</div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100">Se connecter</button>
                </form>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="/operateur/login" class="btn btn-outline-secondary">
                <i class="bi bi-shield-lock me-1"></i>Accès opérateur
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
