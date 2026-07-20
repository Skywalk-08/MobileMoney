<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h2><i class="bi bi-people me-2"></i>Autres opérateurs</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/operateur/dashboard"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Autres opérateurs</li>
            </ol>
        </nav>
    </div>
    <a href="/operateur/autres_operateurs/create" class="btn btn-primary-custom">
        <i class="bi bi-plus-lg me-1"></i>Ajouter un opérateur
    </a>
</div>

<div class="card border-0">
    <div class="card-body p-0">
        <?php if (empty($operateurs)): ?>
            <div class="empty-state">
                <i class="bi bi-people"></i>
                <h5>Aucun opérateur configuré</h5>
                <p class="mb-0">Commencez par ajouter un opérateur externe pour gérer les transferts.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Commission transfert</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($operateurs as $operateur): ?>
                            <tr>
                                <td class="fw-semibold"><?= esc($operateur['nom']) ?></td>
                                <td class="fw-medium"><?= number_format((float) $operateur['commission_transfert'], 2, ',', ' ') ?> %</td>
                                <td>
                                    <span class="badge-status bg-<?= $operateur['actif'] ? 'success' : 'secondary' ?>">
                                        <i class="bi bi-<?= $operateur['actif'] ? 'check-circle' : 'x-circle' ?>"></i>
                                        <?= $operateur['actif'] ? 'Actif' : 'Inactif' ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="/operateur/autres_operateurs/edit/<?= $operateur['id'] ?>" class="btn btn-sm btn-outline-custom me-1" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/operateur/autres_operateurs/toggle/<?= $operateur['id'] ?>" class="btn btn-sm btn-outline-custom me-1" title="<?= $operateur['actif'] ? 'Désactiver' : 'Activer' ?>">
                                        <i class="bi bi-<?= $operateur['actif'] ? 'pause' : 'play' ?>"></i>
                                    </a>
                                    <a href="/operateur/autres_operateurs/delete/<?= $operateur['id'] ?>" class="btn btn-sm btn-outline-custom" title="Supprimer" style="border-color: #e74c3c; color: #e74c3c;" onmouseover="this.style.background='#e74c3c'; this.style.color='#ffffff';" onmouseout="this.style.background='transparent'; this.style.color='#e74c3c';" onclick="return confirm('Supprimer cet opérateur ?')">
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
