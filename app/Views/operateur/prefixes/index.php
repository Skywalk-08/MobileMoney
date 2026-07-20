<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Préfixes</h2>
    <a href="/operateur/prefixes/create" class="btn btn-primary">Ajouter un préfixe</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Préfixe</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($prefixes)): ?>
                    <tr><td colspan="4" class="text-center text-muted">Aucun préfixe configuré.</td></tr>
                <?php else: ?>
                    <?php foreach ($prefixes as $prefixe): ?>
                        <tr>
                            <td><?= esc($prefixe['prefixe']) ?></td>
                            <td>
                                <span class="badge bg-<?= $prefixe['type'] === 'local' ? 'primary' : 'warning' ?>">
                                    <?= ucfirst($prefixe['type']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-<?= $prefixe['actif'] ? 'success' : 'secondary' ?>">
                                    <?= $prefixe['actif'] ? 'Actif' : 'Inactif' ?>
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="/operateur/prefixes/toggle/<?= $prefixe['id'] ?>" class="btn btn-sm btn-outline-warning">
                                    <?= $prefixe['actif'] ? 'Désactiver' : 'Activer' ?>
                                </a>
                                <a href="/operateur/prefixes/delete/<?= $prefixe['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ce préfixe ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
