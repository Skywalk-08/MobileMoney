<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2><i class="bi bi-speedometer2 me-2"></i>Tableau de bord</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/operateur/dashboard"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tableau de bord</li>
        </ol>
    </nav>
</div>

<div class="row g-4 mb-5">
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 h-100">
            <div class="card-body text-center py-4">
                <div class="mb-3">
                    <i class="bi bi-people-fill text-primary" style="font-size: 2rem; opacity: 0.8;"></i>
                </div>
                <h6 class="text-muted mb-2 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Clients actifs</h6>
                <h2 class="text-primary fw-bold mb-0"><?= number_format((int) $nombreClients) ?></h2>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 h-100">
            <div class="card-body text-center py-4">
                <div class="mb-3">
                    <i class="bi bi-arrow-repeat text-success" style="font-size: 2rem; opacity: 0.8;"></i>
                </div>
                <h6 class="text-muted mb-2 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Transactions</h6>
                <h2 class="text-success fw-bold mb-0"><?= number_format((int) $totalTransactions) ?></h2>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 h-100">
            <div class="card-body text-center py-4">
                <div class="mb-3">
                    <i class="bi bi-currency-dollar text-warning" style="font-size: 2rem; opacity: 0.8;"></i>
                </div>
                <h6 class="text-muted mb-2 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total frais</h6>
                <h2 class="text-warning fw-bold mb-0"><?= number_format((float) $totalFraisGlobal, 2, ',', ' ') ?> <small style="font-size: 0.7em;">Ar</small></h2>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 h-100">
            <div class="card-body text-center py-4">
                <div class="mb-3">
                    <i class="bi bi-graph-up-arrow text-success" style="font-size: 2rem; opacity: 0.8;"></i>
                </div>
                <h6 class="text-muted mb-2 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Gains opérateur</h6>
                <h2 class="text-success fw-bold mb-0"><?= number_format((float) $totalGainsOperateur, 2, ',', ' ') ?> <small style="font-size: 0.7em;">Ar</small></h2>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 h-100">
            <div class="card-body text-center py-4">
                <div class="mb-3">
                    <i class="bi bi-percent text-danger" style="font-size: 2rem; opacity: 0.8;"></i>
                </div>
                <h6 class="text-muted mb-2 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Commissions autres</h6>
                <h2 class="text-danger fw-bold mb-0"><?= number_format((float) $totalCommissions, 2, ',', ' ') ?> <small style="font-size: 0.7em;">Ar</small></h2>
            </div>
        </div>
    </div>

    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card border-0 h-100">
            <div class="card-body text-center py-4">
                <div class="mb-3">
                    <i class="bi bi-wallet2 text-info" style="font-size: 2rem; opacity: 0.8;"></i>
                </div>
                <h6 class="text-muted mb-2 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Solde total clients</h6>
                <h2 class="text-info fw-bold mb-0"><?= number_format((float) $totalSolde, 2, ',', ' ') ?> <small style="font-size: 0.7em;">Ar</small></h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 h-100">
            <div class="card-header-custom d-flex align-items-center">
                <i class="bi bi-graph-up me-2 text-primary"></i>
                <h5 class="mb-0 fw-semibold">Situation des gains par type d'opération</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th class="text-end">Gains opérateur</th>
                                <th class="text-end">Commissions autres opérateurs</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($fraisParType as $type): ?>
                                <tr>
                                    <td class="fw-medium"><?= esc($type['nom']) ?></td>
                                    <td class="text-end fw-semibold text-success"><?= number_format((float) $type['gains'], 2, ',', ' ') ?> Ar</td>
                                    <td class="text-end fw-semibold text-danger"><?= number_format((float) $type['commissions'], 2, ',', ' ') ?> Ar</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 h-100">
            <div class="card-header-custom d-flex align-items-center">
                <i class="bi bi-wallet2 me-2 text-primary"></i>
                <h5 class="mb-0 fw-semibold">Situation des comptes clients</h5>
            </div>
            <div class="card-body p-0">
                <div style="max-height: 420px; overflow-y: auto;">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Téléphone</th>
                                <th class="text-end">Solde</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clients as $client): ?>
                                <tr>
                                    <td class="fw-medium"><?= esc($client['telephone']) ?></td>
                                    <td class="text-end fw-semibold"><?= number_format((float) $client['solde'], 2, ',', ' ') ?> Ar</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($montantsParAutreOperateur)): ?>
    <div class="row mt-5 g-4">
        <div class="col-md-12">
            <div class="card border-0">
                <div class="card-header-custom d-flex align-items-center">
                    <i class="bi bi-people me-2 text-primary"></i>
                    <h5 class="mb-0 fw-semibold">Situation des montants à envoyer à chaque opérateur</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Opérateur</th>
                                    <th class="text-end">Montant total transféré</th>
                                    <th class="text-end">Commission totale</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($montantsParAutreOperateur as $ligne): ?>
                                    <tr>
                                        <td class="fw-medium"><?= esc($ligne['nom']) ?></td>
                                        <td class="text-end fw-semibold"><?= number_format((float) $ligne['total_montant'], 2, ',', ' ') ?> Ar</td>
                                        <td class="text-end fw-semibold text-warning"><?= number_format((float) $ligne['total_commission'], 2, ',', ' ') ?> Ar</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>
