<?= $this->extend('client/layout') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="card-title mb-4">Dépôt</h3>

                <?php if (!empty($tranches)): ?>
                    <div class="alert alert-light border mb-3">
                        <strong>Barème de frais :</strong>
                        <?php foreach ($tranches as $tranche): ?>
                            <div class="small text-muted">
                                <?= number_format((float) $tranche['montant_min'], 0, ',', ' ') ?> - <?= number_format((float) $tranche['montant_max'], 0, ',', ' ') ?> Ar
                                : <strong><?= number_format((float) $tranche['frais'], 0, ',', ' ') ?> Ar</strong>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="/client/depot/store" method="post">
                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant à déposer (Ar)</label>
                        <input type="number" step="0.01" min="0" class="form-control form-control-lg"
                               id="montant" name="montant"
                               value="<?= esc(old('montant')) ?>" placeholder="0.00" required>
                    </div>
                    <div class="alert alert-info">
                        Frais de dépôt : <strong><?= number_format((float) $frais_depot, 2, ',', ' ') ?> Ar</strong>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg">Confirmer le dépôt</button>
                        <a href="/client/dashboard" class="btn btn-outline-secondary">Retour</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
