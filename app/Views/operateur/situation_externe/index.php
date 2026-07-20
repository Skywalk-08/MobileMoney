<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2><i class="bi bi-cash-coin me-2"></i>Montants à envoyer aux autres opérateurs</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/operateur/dashboard"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Montants à envoyer</li>
        </ol>
    </nav>
</div>

<div class="card border-0">
    <div class="card-header-custom d-flex align-items-center">
        <i class="bi bi-people me-2 text-primary"></i>
        <h5 class="mb-0 fw-semibold">Situation par opérateur externe</h5>
    </div>
    <div class="card-body p-0">
        <?php if (empty($montantsParAutreOperateur)): ?>
            <div class="empty-state">
                <i class="bi bi-cash-coin"></i>
                <h5>Aucun transfert vers un opérateur externe</h5>
                <p class="mb-0">Aucun transfert vers un opérateur externe enregistré pour le moment.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Opérateur</th>
                            <th class="text-end">Montant total transféré</th>
                            <th class="text-end">Commission due</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($montantsParAutreOperateur as $ligne): ?>
                            <tr>
                                <td class="fw-semibold"><?= esc($ligne['nom']) ?></td>
                                <td class="text-end fw-semibold"><?= number_format((float) $ligne['total_montant'], 2, ',', ' ') ?> Ar</td>
                                <td class="text-end fw-semibold text-warning"><?= number_format((float) $ligne['total_commission'], 2, ',', ' ') ?> Ar</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
