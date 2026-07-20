<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h2><i class="bi bi-cash-stack me-2"></i>Barèmes de frais</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/operateur/dashboard"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Barèmes de frais</li>
            </ol>
        </nav>
    </div>
    <a href="/operateur/baremes_frais/create" class="btn btn-primary-custom">
        <i class="bi bi-plus-lg me-1"></i>Ajouter un barème
    </a>
</div>

<?php if (empty($baremes)): ?>
    <div class="card border-0">
        <div class="card-body">
            <div class="empty-state">
                <i class="bi bi-cash-stack"></i>
                <h5>Aucun barème configuré</h5>
                <p class="mb-0">Commencez par ajouter un barème de frais pour vos opérations.</p>
            </div>
        </div>
    </div>
<?php else: ?>
    <?php
        $baremesParType = [];
        foreach ($baremes as $bareme) {
            $baremesParType[$bareme['type_operation_id']][] = $bareme;
        }
    ?>

    <?php foreach ($baremesParType as $typeId => $baremesType): ?>
        <?php $typeNom = $baremesType[0]['type_nom']; ?>
        <div class="card border-0 mb-4">
            <div class="card-header-custom d-flex align-items-center">
                <i class="bi bi-tag me-2 text-primary"></i>
                <h5 class="mb-0 fw-semibold"><?= esc($typeNom) ?></h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Montant min</th>
                                <th>Montant max</th>
                                <th>Frais</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($baremesType as $bareme): ?>
                                <tr>
                                    <td class="fw-medium"><?= number_format((float) $bareme['montant_min'], 2, ',', ' ') ?> Ar</td>
                                    <td class="fw-medium"><?= number_format((float) $bareme['montant_max'], 2, ',', ' ') ?> Ar</td>
                                    <td class="fw-semibold text-success"><?= number_format((float) $bareme['frais'], 2, ',', ' ') ?> Ar</td>
                                    <td class="text-end">
                                        <a href="/operateur/baremes_frais/edit/<?= $bareme['id'] ?>" class="btn btn-sm btn-outline-custom me-1" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="/operateur/baremes_frais/delete/<?= $bareme['id'] ?>" class="btn btn-sm btn-outline-custom" title="Supprimer" style="border-color: #e74c3c; color: #e74c3c;" onmouseover="this.style.background='#e74c3c'; this.style.color='#ffffff';" onmouseout="this.style.background='transparent'; this.style.color='#e74c3c';" onclick="return confirm('Supprimer ce barème ?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>
