<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h2><i class="bi bi-telephone me-2"></i>Préfixes</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/operateur/dashboard"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Préfixes</li>
            </ol>
        </nav>
    </div>
    <a href="/operateur/prefixes/create" class="btn btn-primary-custom">
        <i class="bi bi-plus-lg me-1"></i>Ajouter un préfixe
    </a>
</div>

<div class="card border-0">
    <div class="card-body p-0">
        <?php if (empty($prefixes)): ?>
            <div class="empty-state">
                <i class="bi bi-telephone-x"></i>
                <h5>Aucun préfixe configuré</h5>
                <p class="mb-0">Commencez par ajouter un préfixe pour gérer les types d'opérations.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Préfixe</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prefixes as $prefixe): ?>
                            <tr>
                                <td class="fw-semibold"><?= esc($prefixe['prefixe']) ?></td>
                                <td>
                                    <span class="badge-status bg-<?= $prefixe['type'] === 'local' ? 'primary' : 'warning' ?>">
                                        <i class="bi bi-<?= $prefixe['type'] === 'local' ? 'house-door' : 'globe' ?>"></i>
                                        <?= ucfirst($prefixe['type']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-status bg-<?= $prefixe['actif'] ? 'success' : 'secondary' ?>">
                                        <i class="bi bi-<?= $prefixe['actif'] ? 'check-circle' : 'x-circle' ?>"></i>
                                        <?= $prefixe['actif'] ? 'Actif' : 'Inactif' ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="/operateur/prefixes/toggle/<?= $prefixe['id'] ?>" class="btn btn-sm btn-outline-custom me-1" title="<?= $prefixe['actif'] ? 'Désactiver' : 'Activer' ?>">
                                        <i class="bi bi-<?= $prefixe['actif'] ? 'pause' : 'play' ?>"></i>
                                    </a>
                                    <a href="/operateur/prefixes/delete/<?= $prefixe['id'] ?>" class="btn btn-sm btn-outline-custom" title="Supprimer" style="border-color: #e74c3c; color: #e74c3c;" onmouseover="this.style.background='#e74c3c'; this.style.color='#ffffff';" onmouseout="this.style.background='transparent'; this.style.color='#e74c3c';" onclick="return confirm('Supprimer ce préfixe ?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
