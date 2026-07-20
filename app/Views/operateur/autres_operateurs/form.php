<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2><i class="bi bi-people me-2"></i><?= isset($operateur) ? 'Modifier' : 'Ajouter' ?> un opérateur</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/operateur/dashboard"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
            <li class="breadcrumb-item"><a href="/operateur/autres_operateurs">Autres opérateurs</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= isset($operateur) ? 'Modifier' : 'Ajouter' ?> un opérateur</li>
        </ol>
    </nav>
</div>

<div class="card border-0" style="max-width: 700px;">
    <div class="card-body p-4">
        <form action="<?= isset($operateur) ? '/operateur/autres_operateurs/update/' . $operateur['id'] : '/operateur/autres_operateurs/store' ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= esc(old('nom', $operateur['nom'] ?? '')) ?>" required placeholder="Nom de l'opérateur">
            </div>

            <div class="mb-4">
                <label for="commission_transfert" class="form-label">Commission transfert (Ar)</label>
                <input type="number" step="0.01" class="form-control" id="commission_transfert" name="commission_transfert" value="<?= esc(old('commission_transfert', $operateur['commission_transfert'] ?? 0)) ?>" required placeholder="0.00">
            </div>

            <?php if (isset($operateur)): ?>
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="actif" name="actif" value="1" <?= $operateur['actif'] ? 'checked' : '' ?>>
                    <label class="form-check-label fw-medium" for="actif">Opérateur actif</label>
                </div>
            <?php endif; ?>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-lg me-1"></i>Enregistrer
                </button>
                <a href="/operateur/autres_operateurs" class="btn btn-outline-custom">
                    <i class="bi bi-x-lg me-1"></i>Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
