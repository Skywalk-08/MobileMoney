<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2><i class="bi bi-graph-up me-2"></i>Situation des gains</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/operateur/dashboard"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Situation des gains</li>
        </ol>
    </nav>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 h-100">
            <div class="card-body text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-graph-up-arrow text-success" style="font-size: 2.5rem; opacity: 0.8;"></i>
                </div>
                <h6 class="text-muted mb-2 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Gains opérateur</h6>
                <h3 class="text-success fw-bold mb-0"><?= number_format((float) $totalGainsOperateur, 2, ',', ' ') ?> Ar</h3>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 h-100">
            <div class="card-body text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-percent text-danger" style="font-size: 2.5rem; opacity: 0.8;"></i>
                </div>
                <h6 class="text-muted mb-2 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Commissions autres opérateurs</h6>
                <h3 class="text-danger fw-bold mb-0"><?= number_format((float) $totalCommissions, 2, ',', ' ') ?> Ar</h3>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
