<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<h2 class="mb-4"><?= isset($operateur) ? 'Modifier' : 'Ajouter' ?> un opérateur</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="<?= isset($operateur) ? '/operateur/autres_operateurs/update/' . $operateur['id'] : '/operateur/autres_operateurs/store' ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= esc(old('nom', $operateur['nom'] ?? '')) ?>" required>
            </div>

            <div class="mb-3">
                <label for="commission_transfert" class="form-label">Commission transfert (Ar)</label>
                <input type="number" step="0.01" class="form-control" id="commission_transfert" name="commission_transfert" value="<?= esc(old('commission_transfert', $operateur['commission_transfert'] ?? 0)) ?>" required>
            </div>

            <?php if (isset($operateur)): ?>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="actif" name="actif" value="1" <?= $operateur['actif'] ? 'checked' : '' ?>>
                    <label class="form-check-label" for="actif">Actif</label>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="/operateur/autres_operateurs" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
