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

<div class="row g-4 mb-5">
    <div class="col-xl-4 col-md-4">
        <div class="card border-0 h-100">
            <div class="card-body text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-currency-dollar text-warning" style="font-size: 2.5rem; opacity: 0.8;"></i>
                </div>
                <h6 class="text-muted mb-2 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total frais collectés</h6>
                <h3 class="text-warning fw-bold mb-0"><?= number_format((float) $totalFraisGlobal, 2, ',', ' ') ?> Ar</h3>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
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

    <div class="col-xl-4 col-md-4">
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
</div>

<div class="row g-4">
    <div class="col-md-12">
        <div class="card border-0">
            <div class="card-header-custom d-flex align-items-center">
                <i class="bi bi-bar-chart me-2 text-primary"></i>
                <h5 class="mb-0 fw-semibold">Détail par type d'opération</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Type d'opération</th>
                                <th class="text-end">Frais collectés</th>
                                <th class="text-end">Commissions autres opérateurs</th>
                                <th class="text-end">Gains opérateur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detailsParType as $type): ?>
                                <tr>
                                    <td class="fw-semibold"><?= esc($type['nom']) ?></td>
                                    <td class="text-end fw-semibold text-warning"><?= number_format((float) $type['frais'], 2, ',', ' ') ?> Ar</td>
                                    <td class="text-end fw-semibold text-danger"><?= number_format((float) $type['commissions'], 2, ',', ' ') ?> Ar</td>
                                    <td class="text-end fw-semibold text-success"><?= number_format((float) $type['gains'], 2, ',', ' ') ?> Ar</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
