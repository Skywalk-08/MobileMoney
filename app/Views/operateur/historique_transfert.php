<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Historique des transferts</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <?php if (empty($transfers)): ?>
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h5>Aucun transfert à afficher</h5>
                <p class="text-muted mb-0">Les transactions de type transfert apparaîtront ici.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Expéditeur</th>
                            <th>Destinataire</th>
                            <th>Montant</th>
                            <th>Frais</th>
                            <th>Commission</th>
                            <th>Autre opérateur</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transfers as $t): ?>
                            <tr>
                                <td><?= esc($t['date_transaction']) ?></td>
                                <td><?= esc($t['expediteur_tel']) ?></td>
                                <td><?= esc($t['destinataire_tel']) ?></td>
                                <td class="fw-semibold"><?= number_format((float) $t['montant'], 2, ',', ' ') ?> Ar</td>
                                <td class="text-muted"><?= number_format((float) $t['frais'], 2, ',', ' ') ?> Ar</td>
                                <td class="text-muted"><?= number_format((float) $t['commission'], 2, ',', ' ') ?> Ar</td>
                                <td>
                                    <?php if ($t['operateur_nom']): ?>
                                        <?= esc($t['operateur_nom']) ?>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($t['description'] ?? '-') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
