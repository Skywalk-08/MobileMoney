<?= $this->extend('operateur/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h2><i class="bi bi-diagram-3 me-2"></i>Ajouter un type d'opération</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/operateur/dashboard"><i class="bi bi-house-door me-1"></i>Accueil</a></li>
            <li class="breadcrumb-item"><a href="/operateur/types_operations">Types d'opérations</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ajouter un type d'opération</li>
        </ol>
    </nav>
</div>

<div class="card border-0" style="max-width: 700px;">
    <div class="card-body p-4">
        <form action="/operateur/types_operations/store" method="post">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required placeholder="Ex: Dépôt, Retrait, Transfert">
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-lg me-1"></i>Enregistrer
                </button>
                <a href="/operateur/types_operations" class="btn btn-outline-custom">
                    <i class="bi bi-x-lg me-1"></i>Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
