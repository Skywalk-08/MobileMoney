<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Barèmes de frais</h2>
    <a href="/operateur/baremes_frais/create" class="btn btn-primary">Ajouter un barème</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Montant min</th>
                    <th>Montant max</th>
                    <th>Frais</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($baremes)): ?>
                    <tr><td colspan="5" class="text-center text-muted">Aucun barème configuré.</td></tr>
                <?php else: ?>
                    <?php foreach ($baremes as $bareme): ?>
                        <tr>
                            <td><?= esc($bareme['type_nom']) ?></td>
                            <td><?= number_format((float) $bareme['montant_min'], 2, ',', ' ') ?> Ar</td>
                            <td><?= number_format((float) $bareme['montant_max'], 2, ',', ' ') ?> Ar</td>
                            <td><?= number_format((float) $bareme['frais'], 2, ',', ' ') ?> Ar</td>
                            <td class="text-end">
                                <a href="/operateur/baremes_frais/edit/<?= $bareme['id'] ?>" class="btn btn-sm btn-outline-primary">Modifier</a>
                                <a href="/operateur/baremes_frais/delete/<?= $bareme['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ce barème ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
