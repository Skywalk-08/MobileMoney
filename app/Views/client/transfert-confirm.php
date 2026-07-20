<?= $this->extend('client/layout') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="card-title mb-4">Confirmation du transfert</h3>

                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Destinataire</span>
                        <strong><?= esc($destinataire) ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Montant envoyé (reçu par le destinataire)</span>
                        <strong><?= number_format((float) $montant, 2, ',', ' ') ?> Ar</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Frais de transfert</span>
                        <span><?= number_format((float) $fraisTransfert, 2, ',', ' ') ?> Ar</span>
                    </li>
                    <?php if ($inclureRetrait): ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Frais de retrait (ajoutés)</span>
                            <span><?= number_format((float) $fraisRetrait, 2, ',', ' ') ?> Ar</span>
                        </li>
                    <?php endif; ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span><strong>Total débité de votre compte</strong></span>
                        <strong><?= number_format((float) $total, 2, ',', ' ') ?> Ar</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Nouveau solde estimé</span>
                        <span><?= number_format((float) $nouveauSolde, 2, ',', ' ') ?> Ar</span>
                    </li>
                </ul>

                <form action="/client/transfert/store" method="post">
                    <input type="hidden" name="destinataire" value="<?= esc($destinataire) ?>">
                    <input type="hidden" name="montant" value="<?= esc($montant) ?>">
                    <input type="hidden" name="inclure_frais_retrait" value="<?= $inclureRetrait ? '1' : '0' ?>">
                    <input type="hidden" name="confirmer" value="1">

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-info btn-lg text-white">Confirmer le transfert</button>
                        <a href="/client/transfert" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
