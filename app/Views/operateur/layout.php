<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Espace Opérateur') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f6fa; }
        .op-navbar { background-color: #1a365d; }
        .sidebar { min-height: calc(100vh - 56px); background-color: #2d3748; }
        .sidebar a { color: #cbd5e0; text-decoration: none; display: block; padding: 12px 16px; }
        .sidebar a:hover, .sidebar a.active { background-color: #4a5568; color: white; }
        .sidebar a.active { border-left: 4px solid #63b3ed; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark op-navbar mb-0">
    <div class="container">
        <span class="navbar-brand mb-0 h1">Mobile Money - Espace Opérateur</span>
        <div class="text-white">
            <a href="/operateur/logout" class="btn btn-outline-light btn-sm">Déconnexion</a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 sidebar pt-3">
            <a href="/operateur/dashboard" class="<?= isset($page) && $page === 'dashboard' ? 'active' : '' ?>">Tableau de bord</a>
            <a href="/operateur/prefixes" class="<?= isset($page) && $page === 'prefixes' ? 'active' : '' ?>">Préfixes</a>
            <a href="/operateur/types_operations" class="<?= isset($page) && $page === 'types_operations' ? 'active' : '' ?>">Types d'opérations</a>
            <a href="/operateur/baremes_frais" class="<?= isset($page) && $page === 'baremes_frais' ? 'active' : '' ?>">Barèmes de frais</a>
        </nav>

        <main class="col-md-10 p-4">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
