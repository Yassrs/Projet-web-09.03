<div class="row">
    <div class="col-md-3">
        <div class="list-group mb-4">
            <a href="<?= url('mon-compte') ?>" class="list-group-item list-group-item-action"><i class="bi bi-person me-2"></i>Mon Profil</a>
            <a href="<?= url('mon-compte/emprunts') ?>" class="list-group-item list-group-item-action"><i class="bi bi-box-seam me-2"></i>Mes Emprunts</a>
            <a href="<?= url('mon-compte/demandes') ?>" class="list-group-item list-group-item-action active"><i class="bi bi-list-check me-2"></i>Mes Demandes</a>
            <a href="<?= url('deconnexion') ?>" class="list-group-item list-group-item-action text-danger"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a>
        </div>
    </div>
    <div class="col-md-9">
        <h2 class="mb-4">Mes Demandes</h2>
        <?php if (empty($demandes)): ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-inbox display-4"></i>
                <p class="mt-3">Vous n'avez aucune demande.</p>
                <a href="<?= url('ludotheque') ?>" class="btn btn-primary">Parcourir les jeux</a>
            </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light"><tr><th>Jeu</th><th>Type</th><th>Date début</th><th>Date fin</th><th>Statut</th><th>Date demande</th></tr></thead>
                <tbody>
                <?php
                $statutBadge = ['en_attente'=>'warning','validee'=>'success','refusee'=>'danger'];
                $statutLabel = ['en_attente'=>'En attente','validee'=>'Validée','refusee'=>'Refusée'];
                foreach ($demandes as $d): ?>
                <tr>
                    <td><a href="<?= url('ludotheque/jeu/' . $d['id_jeu']) ?>"><?= htmlspecialchars($d['jeu_nom']) ?></a></td>
                    <td><?= ucfirst($d['type_demande']) ?></td>
                    <td><?= date('d/m/Y', strtotime($d['date_debut'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($d['date_fin'])) ?></td>
                    <td><span class="badge bg-<?= $statutBadge[$d['statut']] ?? 'secondary' ?>"><?= $statutLabel[$d['statut']] ?? $d['statut'] ?></span></td>
                    <td class="text-muted small"><?= date('d/m/Y H:i', strtotime($d['date_demande'])) ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
