<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Tableau de bord</h2>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Clients actifs</h6>
                <h2 class="text-primary"><?= number_format((int) $nombreClients) ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6 class="text-muted">Transactions</h6>
                <h2 class="text-success"><?= number_format((int) $totalTransactions) ?></h2>
            </div>
        </div>
    </div>

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
                <h6 class="text-muted">Solde total clients</h6>
                <h2 class="text-info"><?= number_format((float) $totalSolde, 2, ',', ' ') ?> Ar</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5 g-4">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Situation des frais par type d'opération</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th class="text-end">Frais collectés</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fraisParType as $type): ?>
                            <tr>
                                <td><?= esc($type['nom']) ?></td>
                                <td class="text-end"><?= number_format((float) $type['frais'], 2, ',', ' ') ?> Ar</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Situation des comptes clients</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Téléphone</th>
                                <th class="text-end">Solde</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clients as $client): ?>
                                <tr>
                                    <td><?= esc($client['telephone']) ?></td>
                                    <td class="text-end"><?= number_format((float) $client['solde'], 2, ',', ' ') ?> Ar</td>
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