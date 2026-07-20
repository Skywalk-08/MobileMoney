<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<h2 class="mb-4"><?= isset($bareme) ? 'Modifier' : 'Ajouter' ?> un barème de frais</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="<?= isset($bareme) ? '/operateur/baremes_frais/update/' . $bareme['id'] : '/operateur/baremes_frais/store' ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="type_operation_id" class="form-label">Type d'opération</label>
                <select class="form-select" id="type_operation_id" name="type_operation_id" required>
                    <option value="">-- Choisir --</option>
                    <?php foreach ($types as $type): ?>
                        <option value="<?= $type['id'] ?>" <?= (isset($bareme) && $bareme['type_operation_id'] == $type['id']) ? 'selected' : '' ?>>
                            <?= esc($type['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="montant_min" class="form-label">Montant minimum (Ar)</label>
                    <input type="number" step="0.01" class="form-control" id="montant_min" name="montant_min" value="<?= esc(old('montant_min', $bareme['montant_min'] ?? '')) ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="montant_max" class="form-label">Montant maximum (Ar)</label>
                    <input type="number" step="0.01" class="form-control" id="montant_max" name="montant_max" value="<?= esc(old('montant_max', $bareme['montant_max'] ?? '')) ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="frais" class="form-label">Frais (Ar)</label>
                <input type="number" step="0.01" class="form-control" id="frais" name="frais" value="<?= esc(old('frais', $bareme['frais'] ?? '')) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="/operateur/baremes_frais" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
