<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Autres opérateurs</h2>
    <a href="/operateur/autres_operateurs/create" class="btn btn-primary">Ajouter un opérateur</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Commission transfert</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($operateurs)): ?>
                    <tr><td colspan="4" class="text-center text-muted">Aucun opérateur configuré.</td></tr>
                <?php else: ?>
                    <?php foreach ($operateurs as $operateur): ?>
                        <tr>
                            <td><?= esc($operateur['nom']) ?></td>
                            <td><?= number_format((float) $operateur['commission_transfert'], 2, ',', ' ') ?> Ar</td>
                            <td>
                                <span class="badge bg-<?= $operateur['actif'] ? 'success' : 'secondary' ?>">
                                    <?= $operateur['actif'] ? 'Actif' : 'Inactif' ?>
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="/operateur/autres_operateurs/edit/<?= $operateur['id'] ?>" class="btn btn-sm btn-outline-primary">Modifier</a>
                                <a href="/operateur/autres_operateurs/toggle/<?= $operateur['id'] ?>" class="btn btn-sm btn-outline-warning">
                                    <?= $operateur['actif'] ? 'Désactiver' : 'Activer' ?>
                                </a>
                                <a href="/operateur/autres_operateurs/delete/<?= $operateur['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cet opérateur ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
