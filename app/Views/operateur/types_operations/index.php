<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Types d'opérations</h2>
    <a href="/operateur/types_operations/create" class="btn btn-primary">Ajouter un type</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($types)): ?>
                    <tr><td colspan="3" class="text-center text-muted">Aucun type d'opération configuré.</td></tr>
                <?php else: ?>
                    <?php foreach ($types as $type): ?>
                        <tr>
                            <td><?= esc($type['nom']) ?></td>
                            <td>
                                <span class="badge bg-<?= $type['actif'] ? 'success' : 'secondary' ?>">
                                    <?= $type['actif'] ? 'Actif' : 'Inactif' ?>
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="/operateur/types_operations/toggle/<?= $type['id'] ?>" class="btn btn-sm btn-outline-warning">
                                    <?= $type['actif'] ? 'Désactiver' : 'Activer' ?>
                                </a>
                                <a href="/operateur/types_operations/delete/<?= $type['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ce type ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
