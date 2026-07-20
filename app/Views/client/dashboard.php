<?= $this->extend('client/layout') ?>

<?php
    $derniere = $derniere ?? null;
    $derniereLibelle = $derniere ? $getLibelle($derniere['type_operation_id']) : null;
?>

<?= $this->section('content') ?>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="card-title">Bonjour <?= esc($client['nom']) ?></h4>
                <p class="text-muted mb-1">Numéro : <strong><?= esc($client['telephone']) ?></strong></p>
                <h2 class="text-primary mb-0"><?= number_format((float) $client['solde'], 2, ',', ' ') ?> Ar</h2>
                <span class="text-muted small">Solde actuel</span>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Dernière opération</h6>
                <?php if ($derniere): ?>
                    <p class="mb-1"><strong><?= esc($derniereLibelle) ?></strong> &mdash;
                       <?= number_format((float) $derniere['montant'], 2, ',', ' ') ?> Ar</p>
                    <p class="mb-0 small text-muted">
                        <?= esc($derniere['date_transaction']) ?> &middot; Frais :
                        <?= number_format((float) $derniere['frais'], 2, ',', ' ') ?> Ar
                    </p>
                <?php else: ?>
                    <p class="text-muted mb-0">Aucune opération pour le moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="d-grid gap-3">
            <a href="/client/depot" class="btn btn-success btn-lg">Dépôt</a>
            <a href="/client/retrait" class="btn btn-warning btn-lg">Retrait</a>
            <a href="/client/transfert" class="btn btn-info btn-lg text-white">Transfert</a>
            <a href="/client/transfert-multiple" class="btn btn-info btn-lg text-white">Transfert multiple</a>
            <a href="/client/historique" class="btn btn-secondary btn-lg">Historique</a>
            <a href="/client/logout" class="btn btn-outline-danger btn-lg">Déconnexion</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
