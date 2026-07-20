<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2><i class="bi bi-cash-stack me-2"></i><?= isset($bareme) ? 'Modifier' : 'Ajouter' ?> un barème de frais</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/operateur/dashboard"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
            <li class="breadcrumb-item"><a href="/operateur/baremes_frais">Barèmes de frais</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= isset($bareme) ? 'Modifier' : 'Ajouter' ?> un barème</li>
        </ol>
    </nav>
</div>

<div class="card border-0" style="max-width: 800px;">
    <div class="card-body p-4">
        <form action="<?= isset($bareme) ? '/operateur/baremes_frais/update/' . $bareme['id'] : '/operateur/baremes_frais/store' ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-4">
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

            <div class="row g-3">
                <div class="col-md-6 mb-3">
                    <label for="montant_min" class="form-label">Montant minimum (Ar)</label>
                    <input type="number" step="0.01" class="form-control" id="montant_min" name="montant_min" value="<?= esc(old('montant_min', $bareme['montant_min'] ?? '')) ?>" required placeholder="0.00">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="montant_max" class="form-label">Montant maximum (Ar)</label>
                    <input type="number" step="0.01" class="form-control" id="montant_max" name="montant_max" value="<?= esc(old('montant_max', $bareme['montant_max'] ?? '')) ?>" required placeholder="0.00">
                </div>
            </div>

            <div class="mb-4">
                <label for="frais" class="form-label">Frais (Ar)</label>
                <input type="number" step="0.01" class="form-control" id="frais" name="frais" value="<?= esc(old('frais', $bareme['frais'] ?? '')) ?>" required placeholder="0.00">
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-lg me-1"></i>Enregistrer
                </button>
                <a href="/operateur/baremes_frais" class="btn btn-outline-custom">
                    <i class="bi bi-x-lg me-1"></i>Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
