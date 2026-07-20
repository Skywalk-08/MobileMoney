<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Barèmes de frais</h2>
    <a href="/operateur/baremes_frais/create" class="btn btn-primary">Ajouter un barème</a>
</div>

<?php if (empty($baremes)): ?>
    <div class="alert alert-info">Aucun barème configuré.</div>
<?php else: ?>
    <?php
        $baremesParType = [];
        foreach ($baremes as $bareme) {
            $baremesParType[$bareme['type_operation_id']][] = $bareme;
        }
    ?>

    <?php foreach ($baremesParType as $typeId => $baremesType): ?>
        <?php $typeNom = $baremesType[0]['type_nom']; ?>
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">
                <?= esc($typeNom) ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
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
                                    <td><?= number_format((float) $bareme['montant_min'], 2, ',', ' ') ?> Ar</td>
                                    <td><?= number_format((float) $bareme['montant_max'], 2, ',', ' ') ?> Ar</td>
                                    <td><?= number_format((float) $bareme['frais'], 2, ',', ' ') ?> Ar</td>
                                    <td class="text-end">
                                        <a href="/operateur/baremes_frais/edit/<?= $bareme['id'] ?>" class="btn btn-sm btn-outline-primary">Modifier</a>
                                        <a href="/operateur/baremes_frais/delete/<?= $bareme['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ce barème ?')">Supprimer</a>
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
