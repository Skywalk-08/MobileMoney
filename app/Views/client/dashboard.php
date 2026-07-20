<?= $this->extend('client/layout') ?>

<?php
    $derniere = $derniere ?? null;
    $derniereLibelle = $derniere ? $getLibelle($derniere['type_operation_id']) : null;
?>

<?= $this->section('content') ?>

<div class="page-header d-flex flex-wrap justify-content-between align-items-center">
    <div>
        <h2>Tableau de bord</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/client/dashboard"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tableau de bord</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 56px; height: 56px; background: linear-gradient(135deg, rgba(43, 92, 143, 0.1) 0%, rgba(58, 123, 191, 0.1) 100%);">
                        <i class="bi bi-person-circle" style="font-size: 1.8rem; color: var(--primary);"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-semibold">Bonjour <?= esc($client['nom']) ?></h5>
                        <span class="text-muted small"><i class="bi bi-telephone me-1"></i><?= esc($client['telephone']) ?></span>
                    </div>
                </div>
                <div class="p-3 rounded-3" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); color: #ffffff;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-white-50 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Solde actuel</small>
                            <h2 class="mb-0 fw-bold"><?= number_format((float) $client['solde'], 2, ',', ' ') ?> Ar</h2>
                        </div>
                        <i class="bi bi-wallet2" style="font-size: 2.5rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="text-uppercase text-muted fw-semibold mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                    <i class="bi bi-clock-history me-1"></i>Dernière opération
                </h6>
                <?php if ($derniere): ?>
                    <div class="d-flex align-items-start gap-2">
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: var(--gray-100);">
                            <i class="bi bi-arrow-right-circle" style="color: var(--primary);"></i>
                        </div>
                        <div>
                            <p class="mb-1 fw-semibold"><?= esc($derniereLibelle) ?></p>
                            <p class="mb-0 fw-bold" style="color: var(--primary);"><?= number_format((float) $derniere['montant'], 2, ',', ' ') ?> Ar</p>
                            <small class="text-muted">
                                <?= esc($derniere['date_transaction']) ?> &middot; Frais :
                                <?= number_format((float) $derniere['frais'], 2, ',', ' ') ?> Ar
                            </small>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="empty-state py-4">
                        <i class="bi bi-inbox"></i>
                        <p class="text-muted mb-0">Aucune opération pour le moment.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h6 class="text-uppercase text-muted fw-semibold mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                    <i class="bi bi-grid me-1"></i>Actions rapides
                </h6>
                <div class="action-grid">
                    <a href="/client/depot" class="btn btn-action btn-success-custom">
                        <i class="bi bi-plus-circle"></i>Dépôt
                    </a>
                    <a href="/client/retrait" class="btn btn-action btn-warning-custom">
                        <i class="bi bi-cash"></i>Retrait
                    </a>
                    <a href="/client/transfert" class="btn btn-action btn-primary-custom">
                        <i class="bi bi-arrow-left-right"></i>Transfert
                    </a>
                    <a href="/client/transfert-multiple" class="btn btn-action btn-primary-custom">
                        <i class="bi bi-people"></i>Transfert multiple
                    </a>
                    <a href="/client/historique" class="btn btn-action btn-outline-custom" style="color: var(--gray-700);">
                        <i class="bi bi-journal-text"></i>Historique
                    </a>
                    <a href="/client/logout" class="btn btn-action btn-danger-custom">
                        <i class="bi bi-box-arrow-right"></i>Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
