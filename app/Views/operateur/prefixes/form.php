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

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="/operateur/prefixes" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
