<?= $this->extend('client/layout') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="card-title mb-4">Récapitulatif du transfert multiple</h3>

                <div class="table-responsive mb-3">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Destinataire</th>
                                <th>Montant</th>
                                <th>Frais</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($parts as $i => $part): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($part['numero']) ?></td>
                                    <td><?= number_format((float) $part['montant'], 2, ',', ' ') ?> Ar</td>
                                    <td><?= number_format((float) $part['frais'], 2, ',', ' ') ?> Ar</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <th colspan="2">Total</th>
                                <th><?= number_format((float) $montantTotal, 2, ',', ' ') ?> Ar</th>
                                <th><?= number_format((float) $totalFrais, 2, ',', ' ') ?> Ar</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <span><strong>Total débité de votre compte</strong></span>
                        <strong><?= number_format((float) $totalDebite, 2, ',', ' ') ?> Ar</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Nouveau solde estimé</span>
                        <span><?= number_format((float) $nouveauSolde, 2, ',', ' ') ?> Ar</span>
                    </li>
                </ul>

                <form action="/client/transfert-multiple/store" method="post">
                    <input type="hidden" name="destinataires" value="<?= esc(implode("\n", $destinataires)) ?>">
                    <input type="hidden" name="montant_total" value="<?= esc($montantTotal) ?>">
                    <input type="hidden" name="confirmer" value="1">

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-info btn-lg text-white">Confirmer les transferts</button>
                        <a href="/client/transfert-multiple" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
