<div class="row">
    <div class="col-md-3">
        <div class="list-group mb-4">
            <a href="<?= url('admin') ?>" class="list-group-item list-group-item-action"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            <a href="<?= url('admin/jeux') ?>" class="list-group-item list-group-item-action"><i class="bi bi-controller me-2"></i>Gestion des Jeux</a>
            <a href="<?= url('admin/evenements') ?>" class="list-group-item list-group-item-action active"><i class="bi bi-calendar-event me-2"></i>Gestion Événements</a>
            <a href="<?= url('admin/demandes') ?>" class="list-group-item list-group-item-action"><i class="bi bi-list-check me-2"></i>Traitement Demandes</a>
        </div>
    </div>
    <div class="col-md-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-calendar-event me-2"></i>Gestion des Événements</h2>
            <a href="<?= url('admin/evenements/ajouter') ?>" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Ajouter</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light"><tr><th>Titre</th><th>Date</th><th>Lieu</th><th>Catégorie</th><th>Actions</th></tr></thead>
                <tbody>
                <?php
                $catLabels = ['salle_jeudi'=>'Salle du Jeudi','jeu_jeudi'=>'Jeu du Jeudi','soiree_jeux'=>'Soirée Jeux','occasionnel'=>'Occasionnel'];
                $catColors = ['salle_jeudi'=>'primary','jeu_jeudi'=>'success','soiree_jeux'=>'warning','occasionnel'=>'danger'];
                foreach ($evenements as $evt): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($evt['titre']) ?></strong></td>
                    <td><?= date('d/m/Y H:i', strtotime($evt['date_evenement'] . ' ' . $evt['heure'])) ?></td>
                    <td><?= htmlspecialchars($evt['lieu']) ?></td>
                    <td><span class="badge bg-<?= $catColors[$evt['categorie']] ?? 'secondary' ?>"><?= $catLabels[$evt['categorie']] ?? '' ?></span></td>
                    <td>
                        <a href="<?= url('admin/evenements/modifier/' . $evt['id']) ?>" class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil"></i></a>
                        <a href="<?= url('admin/evenements/supprimer/' . $evt['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Supprimer cet événement ?')"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
