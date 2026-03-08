<div class="row">
    <div class="col-md-3">
        <div class="list-group mb-4">
            <a href="<?= url('mon-compte') ?>" class="list-group-item list-group-item-action"><i class="bi bi-person me-2"></i>Mon Profil</a>
            <a href="<?= url('mon-compte/emprunts') ?>" class="list-group-item list-group-item-action active"><i class="bi bi-box-seam me-2"></i>Mes Emprunts</a>
            <a href="<?= url('mon-compte/demandes') ?>" class="list-group-item list-group-item-action"><i class="bi bi-list-check me-2"></i>Mes Demandes</a>
            <a href="<?= url('deconnexion') ?>" class="list-group-item list-group-item-action text-danger"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a>
        </div>
    </div>
    <div class="col-md-9">
        <h2 class="mb-4">Mes Emprunts & Locations en cours</h2>
        <?php if (empty($emprunts)): ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-box-seam display-4"></i>
                <p class="mt-3">Aucun emprunt ou location en cours.</p>
            </div>
        <?php else: ?>
        <?php foreach ($emprunts as $e):
            $dateFin = strtotime($e['date_fin']);
            $joursRestants = max(0, ceil(($dateFin - time()) / 86400));
            $urgent = $joursRestants <= 2;
        ?>
        <div class="card mb-3 <?= $urgent ? 'border-danger' : '' ?>">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1"><?= htmlspecialchars($e['jeu_nom']) ?></h5>
                    <span class="badge bg-info"><?= ucfirst($e['type_demande']) ?></span>
                    <span class="text-muted small ms-2"><?= date('d/m/Y', strtotime($e['date_debut'])) ?> → <?= date('d/m/Y', $dateFin) ?></span>
                </div>
                <div class="text-end">
                    <div class="fs-4 fw-bold <?= $urgent ? 'text-danger' : 'text-primary' ?>"><?= $joursRestants ?> jour(s)</div>
                    <small class="text-muted">restant(s)</small>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
