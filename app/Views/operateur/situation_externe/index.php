<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Montants à envoyer aux autres opérateurs</h2>

<div class="row g-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Situation par opérateur externe</h5>
            </div>
            <div class="card-body">
                <?php if (empty($montantsParAutreOperateur)): ?>
                    <p class="text-muted">Aucun transfert vers un opérateur externe enregistré pour le moment.</p>
                <?php else: ?>
                    <table class="table table-striped">
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
                                    <td><?= esc($ligne['nom']) ?></td>
                                    <td class="text-end"><?= number_format((float) $ligne['total_montant'], 2, ',', ' ') ?> Ar</td>
                                    <td class="text-end"><?= number_format((float) $ligne['total_commission'], 2, ',', ' ') ?> Ar</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
