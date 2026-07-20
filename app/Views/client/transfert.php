<?= $this->extend('client/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2>Transfert</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/client/dashboard"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Transfert</li>
        </ol>
    </nav>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(43, 92, 143, 0.1);">
                        <i class="bi bi-arrow-left-right" style="color: var(--primary); font-size: 1.2rem;"></i>
                    </div>
                    <h3 class="mb-0 fw-bold">Transfert</h3>
                </div>

                <div class="alert alert-warning">
                    <i class="bi bi-wallet2 me-2"></i>
                    <div>
                        Solde disponible : <strong><?= number_format((float) $client['solde'], 2, ',', ' ') ?> Ar</strong>
                    </div>
                </div>

                <?php if (!empty($tranches)): ?>
                    <div class="alert alert-light border mb-3">
                        <i class="bi bi-info-circle me-2" style="color: var(--accent);"></i>
                        <div>
                            <strong>Barème de frais :</strong>
                            <?php foreach ($tranches as $tranche): ?>
                                <div class="small text-muted mt-1">
                                    <?= number_format((float) $tranche['montant_min'], 0, ',', ' ') ?> - <?= number_format((float) $tranche['montant_max'], 0, ',', ' ') ?> Ar
                                    : <strong><?= number_format((float) $tranche['frais'], 0, ',', ' ') ?> Ar</strong>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

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
                    <div class="form-check mb-4 p-3 rounded-3" style="background: var(--gray-50); border: 1px solid var(--border);">
                        <input class="form-check-input" type="checkbox" id="inclure_frais_retrait"
                               name="inclure_frais_retrait" value="1" <?= old('inclure_frais_retrait') ? 'checked' : '' ?>>
                        <label class="form-check-label" for="inclure_frais_retrait">
                            <strong>Inclure les frais de retrait</strong>
                        </label>
                        <div class="form-text mt-1">
                            Disponible uniquement pour un transfert vers le même opérateur.
                            Si coché, le montant saisi est celui reçu par le destinataire après son retrait ;
                            les frais de retrait sont ajoutés et débités de votre compte.
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary-custom btn-lg">
                            <i class="bi bi-check-lg me-2"></i>Confirmer le transfert
                        </button>
                        <a href="/client/dashboard" class="btn btn-outline-custom btn-lg">
                            <i class="bi bi-arrow-left me-2"></i>Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
