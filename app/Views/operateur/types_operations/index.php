<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h2><i class="bi bi-diagram-3 me-2"></i>Types d'opérations</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/operateur/dashboard"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Types d'opérations</li>
            </ol>
        </nav>
    </div>
    <a href="/operateur/types_operations/create" class="btn btn-primary-custom">
        <i class="bi bi-plus-lg me-1"></i>Ajouter un type
    </a>
</div>

<div class="card border-0">
    <div class="card-body p-0">
        <?php if (empty($types)): ?>
            <div class="empty-state">
                <i class="bi bi-diagram-3"></i>
                <h5>Aucun type d'opération configuré</h5>
                <p class="mb-0">Commencez par ajouter un type d'opération pour organiser vos transactions.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($types as $type): ?>
                            <tr>
                                <td class="fw-semibold"><?= esc($type['nom']) ?></td>
                                <td>
                                    <span class="badge-status bg-<?= $type['actif'] ? 'success' : 'secondary' ?>">
                                        <i class="bi bi-<?= $type['actif'] ? 'check-circle' : 'x-circle' ?>"></i>
                                        <?= $type['actif'] ? 'Actif' : 'Inactif' ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="/operateur/types_operations/toggle/<?= $type['id'] ?>" class="btn btn-sm btn-outline-custom me-1" title="<?= $type['actif'] ? 'Désactiver' : 'Activer' ?>">
                                        <i class="bi bi-<?= $type['actif'] ? 'pause' : 'play' ?>"></i>
                                    </a>
                                    <a href="/operateur/types_operations/delete/<?= $type['id'] ?>" class="btn btn-sm btn-outline-custom" title="Supprimer" style="border-color: #e74c3c; color: #e74c3c;" onmouseover="this.style.background='#e74c3c'; this.style.color='#ffffff';" onmouseout="this.style.background='transparent'; this.style.color='#e74c3c';" onclick="return confirm('Supprimer ce type ?')">
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
