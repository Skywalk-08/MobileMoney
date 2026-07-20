<?= $this->extend('client/layout') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <h3 class="card-title mb-0">Historique des opérations</h3>
            <div class="d-flex gap-2 mt-2 mt-md-0">
                <form method="get" class="d-flex gap-2">
                    <select name="type" class="form-select" onchange="this.form.submit()">
                        <option value="">Tous les types</option>
                        <?php foreach ($types as $t): ?>
                            <option value="<?= esc($t) ?>" <?= $filtre_type === $t ? 'selected' : '' ?>>
                                <?= esc($getLibelle($t)) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <select name="ordre" class="form-select" onchange="this.form.submit()">
                        <option value="DESC" <?= $ordre === 'DESC' ? 'selected' : '' ?>>Plus récent</option>
                        <option value="ASC" <?= $ordre === 'ASC' ? 'selected' : '' ?>>Plus ancien</option>
                    </select>
                </form>
            </div>
        </div>

        <?php if (empty($operations)): ?>
            <p class="text-muted">Aucune opération à afficher.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Montant</th>
                            <th>Frais</th>
                            <th>Expéditeur</th>
                            <th>Destinataire</th>
                            <th>Solde après</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($operations as $op): ?>
                            <tr>
                                <td><?= esc($op['created_at']) ?></td>
                                <td><?= esc($getLibelle($op['type_operation'])) ?></td>
                                <td><?= number_format((float) $op['montant'], 2, ',', ' ') ?> Ar</td>
                                <td><?= number_format((float) $op['frais'], 2, ',', ' ') ?> Ar</td>
                                <td><?= esc($op['expediteur'] ?? '-') ?></td>
                                <td><?= esc($op['destinataire'] ?? '-') ?></td>
                                <td><?= number_format((float) $op['solde_apres'], 2, ',', ' ') ?> Ar</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <a href="/client/dashboard" class="btn btn-outline-secondary mt-2">Retour au tableau de bord</a>
    </div>
</div>

<?= $this->endSection() ?>
