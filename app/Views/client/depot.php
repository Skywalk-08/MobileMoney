<?= $this->extend('client/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2>Dépôt</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/client/dashboard"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dépôt</li>
        </ol>
    </nav>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(22, 160, 133, 0.1);">
                        <i class="bi bi-plus-circle" style="color: var(--success); font-size: 1.2rem;"></i>
                    </div>
                    <h3 class="mb-0 fw-bold">Dépôt</h3>
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

                <form action="/client/depot/store" method="post">
                    <div class="mb-3">
                        <label for="montant" class="form-label">Montant à déposer (Ar)</label>
                        <input type="number" step="0.01" min="0" class="form-control form-control-lg"
                               id="montant" name="montant"
                               value="<?= esc(old('montant')) ?>" placeholder="0.00" required>
                    </div>
                    <div class="alert alert-info">
                        <i class="bi bi-receipt me-2"></i>
                        <div>
                            Frais de dépôt : <strong><?= number_format((float) $frais_depot, 2, ',', ' ') ?> Ar</strong>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success-custom btn-lg">
                            <i class="bi bi-check-lg me-2"></i>Confirmer le dépôt
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
