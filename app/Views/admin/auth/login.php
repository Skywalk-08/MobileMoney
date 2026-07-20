<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion Administrateur</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container">

    <div class="row justify-content-center align-items-center vh-100">

        <div class="col-md-5">

            <div class="card login-card">

                <div class="card-body p-5">

                    <div class="text-center mb-4">


                        <h3 class="mt-3">
                            Mobile Money
                        </h3>

                        <p class="text-muted">
                            Espace Administrateur
                        </p>

                    </div>

                    <?php if(session()->getFlashdata('error')) : ?>

                        <div class="alert alert-danger">

                            <?= session()->getFlashdata('error') ?>

                        </div>

                    <?php endif; ?>

                    <?php if(session()->getFlashdata('success')) : ?>

                        <div class="alert alert-success">

                            <?= session()->getFlashdata('success') ?>

                        </div>

                    <?php endif; ?>

                    <form action="<?= site_url('operateur/login') ?>" method="post">

                        <?= csrf_field() ?>

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="admin@mobilemoney.mg"
                                value="<?= old('email') ?>"
                                required>
                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Mot de passe
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>

                        </div>

                        <button class="btn btn-primary w-100 btn-login">

                            Se connecter

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>