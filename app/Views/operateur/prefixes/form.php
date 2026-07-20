<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Ajouter un préfixe</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="/operateur/prefixes/store" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="prefixe" class="form-label">Préfixe</label>
                <input type="text" class="form-control" id="prefixe" name="prefixe" required>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="local">Local</option>
                    <option value="externe">Externe</option>
                </select>
            </div>

            <div class="mb-3" id="operateur-field" style="display: none;">
                <label for="autre_operateur_id" class="form-label">Opérateur externe</label>
                <select class="form-select" id="autre_operateur_id" name="autre_operateur_id">
                    <option value="">-- Choisir --</option>
                    <?php foreach ($operateurs as $operateur): ?>
                        <option value="<?= $operateur['id'] ?>"><?= esc($operateur['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="/operateur/prefixes" class="btn btn-secondary">Annuler</a>
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
