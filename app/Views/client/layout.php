<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Mobile Money') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f6fa; }
        .mm-navbar { background-color: #2b5c8f; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark mm-navbar mb-4">
    <div class="container">
        <span class="navbar-brand mb-0 h1">Mobile Money</span>
        <?php if (! empty($client)): ?>
            <span class="text-white"><?= esc($client['telephone']) ?></span>
        <?php endif; ?>
    </div>
</nav>

<main class="container pb-5">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
</main>

<footer class="text-center text-muted py-3">
    <small>Espace client Mobile Money &middot; Version 1</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
