<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Situation des gains</h2>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Total frais collectés</h6>
                <h2 class="text-warning"><?= number_format((float) $totalFraisGlobal, 2, ',', ' ') ?> Ar</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Commissions autres opérateurs</h6>
                <h2 class="text-danger"><?= number_format((float) $totalCommissions, 2, ',', ' ') ?> Ar</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Gains opérateur</h6>
                <h2 class="text-success"><?= number_format((float) $totalGainsOperateur, 2, ',', ' ') ?> Ar</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5 g-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Détail par type d'opération</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
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
                                <td><?= esc($type['nom']) ?></td>
                                <td class="text-end"><?= number_format((float) $type['frais'], 2, ',', ' ') ?> Ar</td>
                                <td class="text-end"><?= number_format((float) $type['commissions'], 2, ',', ' ') ?> Ar</td>
                                <td class="text-end"><?= number_format((float) $type['gains'], 2, ',', ' ') ?> Ar</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
