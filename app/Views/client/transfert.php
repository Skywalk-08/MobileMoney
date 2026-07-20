<?= $this->extend('client/layout') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="card-title mb-4">Transfert</h3>

                <div class="alert alert-light border">
                    Solde disponible :
                    <strong><?= number_format((float) $client['solde'], 2, ',', ' ') ?> Ar</strong>
                </div>

                <form action="/client/transfert/store" method="post">
                    <div class="mb-3">
                        <label for="destinataire" class="form-label">Numéro du destinataire</label>
                        <input type="text" class="form-control form-control-lg" id="destinataire"
                               name="destinataire" placeholder="Ex : 034 12 345 67"
                               value="<?= esc(old('destinataire')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant à transférer (Ar)</label>
                        <input type="number" step="0.01" min="0" class="form-control form-control-lg"
                               id="montant" name="montant"
                               value="<?= esc(old('montant')) ?>" placeholder="0.00" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-info btn-lg text-white">Confirmer le transfert</button>
                        <a href="/client/dashboard" class="btn btn-outline-secondary">Retour</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
