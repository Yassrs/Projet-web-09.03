<?php $roleLabels = ['non_membre'=>'Non-membre','membre'=>'Membre','admin'=>'Administrateur','president'=>'Président']; ?>

<div class="row">
    <!-- Sidebar -->
    <div class="col-md-3">
        <div class="list-group mb-4">
            <a href="<?= url('mon-compte') ?>" class="list-group-item list-group-item-action active"><i class="bi bi-person me-2"></i>Mon Profil</a>
            <a href="<?= url('mon-compte/emprunts') ?>" class="list-group-item list-group-item-action"><i class="bi bi-box-seam me-2"></i>Mes Emprunts</a>
            <a href="<?= url('mon-compte/demandes') ?>" class="list-group-item list-group-item-action"><i class="bi bi-list-check me-2"></i>Mes Demandes</a>
            <?php if (isAdmin()): ?>
            <a href="<?= url('admin') ?>" class="list-group-item list-group-item-action text-danger"><i class="bi bi-speedometer2 me-2"></i>Administration</a>
            <?php endif; ?>
            <a href="<?= url('deconnexion') ?>" class="list-group-item list-group-item-action text-danger"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a>
        </div>
    </div>

    <!-- Content -->
    <div class="col-md-9">
        <h2 class="mb-4">Mon Profil</h2>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted small">Nom</label>
                        <p class="fw-bold"><?= htmlspecialchars($user['nom']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Prénom</label>
                        <p class="fw-bold"><?= htmlspecialchars($user['prenom']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Email</label>
                        <p class="fw-bold"><?= htmlspecialchars($user['email']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small">Statut</label>
                        <p><span class="badge bg-primary"><?= $roleLabels[$user['role']] ?? $user['role'] ?></span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Demandes récentes -->
        <h4>Demandes récentes</h4>
        <?php if (empty($recentDemandes)): ?>
            <p class="text-muted">Aucune demande pour le moment.</p>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light"><tr><th>Jeu</th><th>Type</th><th>Dates</th><th>Statut</th></tr></thead>
                <tbody>
                <?php
                $statutBadge = ['en_attente'=>'warning','validee'=>'success','refusee'=>'danger'];
                $statutLabel = ['en_attente'=>'En attente','validee'=>'Validée','refusee'=>'Refusée'];
                foreach ($recentDemandes as $d): ?>
                <tr>
                    <td><?= htmlspecialchars($d['jeu_nom']) ?></td>
                    <td><?= ucfirst($d['type_demande']) ?></td>
                    <td><?= date('d/m/Y', strtotime($d['date_debut'])) ?> → <?= date('d/m/Y', strtotime($d['date_fin'])) ?></td>
                    <td><span class="badge bg-<?= $statutBadge[$d['statut']] ?? 'secondary' ?>"><?= $statutLabel[$d['statut']] ?? $d['statut'] ?></span></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <a href="<?= url('mon-compte/demandes') ?>" class="btn btn-outline-primary btn-sm">Voir toutes mes demandes</a>
        <?php endif; ?>
    </div>
</div>
