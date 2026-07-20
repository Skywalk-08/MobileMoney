<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Ajouter un type d'opération</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="/operateur/types_operations/store" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="/operateur/types_operations" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
