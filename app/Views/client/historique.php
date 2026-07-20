<?= $this->extend('client/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2>Historique des opérations</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/client/dashboard"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Historique</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <h5 class="fw-semibold mb-0"><i class="bi bi-journal-text me-2"></i>Transactions</h5>
            <div class="d-flex gap-2 mt-2 mt-md-0">
                <form method="get" class="d-flex gap-2">
                    <select name="type" class="form-select" onchange="this.form.submit()">
                        <option value="">Tous les types</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?= esc($type['id']) ?>" <?= (string) $filtre_type === (string) $type['id'] ? 'selected' : '' ?>>
                                <?= esc($type['nom']) ?>
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
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h5>Aucune opération à afficher</h5>
                <p class="text-muted mb-0">Vos transactions apparaîtront ici une fois effectuées.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Montant</th>
                            <th>Frais</th>
                            <th>Expéditeur</th>
                            <th>Destinataire</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($operations as $op): ?>
                            <tr>
                                <td><?= esc($op['date_transaction']) ?></td>
                                <td>
                                    <span class="badge-custom" style="background: rgba(43, 92, 143, 0.1); color: var(--primary);">
                                        <?= esc($op['type_libelle']) ?>
                                    </span>
                                    <?php if (! empty($op['reference']) && str_starts_with((string) $op['reference'], 'MULTI')): ?>
                                        <span class="badge bg-info text-white ms-1">Multiple</span>
                                    <?php endif; ?>
                                </td>
                                <td class="fw-semibold"><?= number_format((float) $op['montant'], 2, ',', ' ') ?> Ar</td>
                                <td class="text-muted"><?= number_format((float) $op['frais'], 2, ',', ' ') ?> Ar</td>
                                <td><?= esc($op['expediteur_tel'] ?? '-') ?></td>
                                <td><?= esc($op['destinataire_tel'] ?? '-') ?></td>
                                <td><?= esc($op['description'] ?? '-') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <div class="mt-3">
            <a href="/client/dashboard" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left me-2"></i>Retour au tableau de bord
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
