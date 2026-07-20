<?= $this->extend('client/layout') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="card-title mb-4">Transfert multiple</h3>

                <div class="alert alert-light border mb-3">
                    Solde disponible :
                    <strong><?= number_format((float) $client['solde'], 2, ',', ' ') ?> Ar</strong>
                </div>

                <form action="/client/transfert-multiple/store" method="post">
                    <div class="mb-3">
                        <label for="destinataires" class="form-label">Numéros des destinataires</label>
                        <textarea class="form-control" id="destinataires" name="destinataires" rows="4"
                                  placeholder="0331111111&#10;0332222222&#10;0323333333" required><?= esc(old('destinataires')) ?></textarea>
                        <div class="form-text">
                            Séparez les numéros par des espaces, virgules ou sauts de ligne.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="montant_total" class="form-label">Montant total à répartir (Ar)</label>
                        <input type="number" step="0.01" min="0" class="form-control form-control-lg"
                               id="montant_total" name="montant_total"
                               value="<?= esc(old('montant_total')) ?>" placeholder="0.00" required>
                        <div class="form-text">
                            Le montant sera divisé équitablement entre les destinataires.
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-info btn-lg text-white">Confirmer le transfert multiple</button>
                        <a href="/client/dashboard" class="btn btn-outline-secondary">Retour</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
