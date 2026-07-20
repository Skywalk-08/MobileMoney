<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2><i class="bi bi-telephone me-2"></i>Ajouter un préfixe</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/operateur/dashboard"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
            <li class="breadcrumb-item"><a href="/operateur/prefixes">Préfixes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ajouter un préfixe</li>
        </ol>
    </nav>
</div>

<div class="card border-0" style="max-width: 700px;">
    <div class="card-body p-4">
        <form action="/operateur/prefixes/store" method="post">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="prefixe" class="form-label">Préfixe</label>
                <input type="text" class="form-control" id="prefixe" name="prefixe" required placeholder="Ex: 032, 033">
            </div>

            <div class="mb-4">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="local">Local</option>
                    <option value="externe">Externe</option>
                </select>
            </div>

            <div class="mb-4" id="operateur-field" style="display: none;">
                <label for="autre_operateur_id" class="form-label">Opérateur externe</label>
                <select class="form-select" id="autre_operateur_id" name="autre_operateur_id">
                    <option value="">-- Choisir --</option>
                    <?php foreach ($operateurs as $operateur): ?>
                        <option value="<?= $operateur['id'] ?>"><?= esc($operateur['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-lg me-1"></i>Enregistrer
                </button>
                <a href="/operateur/prefixes" class="btn btn-outline-custom">
                    <i class="bi bi-x-lg me-1"></i>Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('type').addEventListener('change', function() {
        var operateurField = document.getElementById('operateur-field');
        if (this.value === 'externe') {
            operateurField.style.display = 'block';
        } else {
            operateurField.style.display = 'none';
        }
    });
</script>

<?= $this->endSection() ?>
