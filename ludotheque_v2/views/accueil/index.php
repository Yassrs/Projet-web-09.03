<!-- Hero Section -->
<div class="bg-primary text-white rounded-4 p-5 mb-5 text-center hero-section">
    <h1 class="display-5 fw-bold mb-3"><i class="bi bi-dice-5-fill me-2"></i>Bienvenue à la Ludothèque</h1>
    <p class="lead mb-4">L'association étudiante qui anime votre campus avec des jeux de société, des événements et bien plus encore !</p>
    <a href="<?= url('ludotheque') ?>" class="btn btn-light btn-lg"><i class="bi bi-controller me-2"></i>Découvrir nos jeux</a>
</div>

<!-- Événements par catégorie -->
<h2 class="mb-4"><i class="bi bi-calendar-event me-2"></i>Nos Événements</h2>
<div class="row g-4 mb-5">
    <?php
    $categories = [
        'salle_jeudi' => ['label' => 'Salle du Jeudi', 'icon' => 'bi-door-open', 'color' => 'primary', 'events' => $salleJeudi],
        'jeu_jeudi' => ['label' => 'Jeu du Jeudi', 'icon' => 'bi-joystick', 'color' => 'success', 'events' => $jeuJeudi],
        'soiree_jeux' => ['label' => 'Soirée Jeux', 'icon' => 'bi-moon-stars', 'color' => 'warning', 'events' => $soireeJeux],
        'occasionnel' => ['label' => 'Événement Occasionnel', 'icon' => 'bi-star', 'color' => 'danger', 'events' => $occasionnel],
    ];
    foreach ($categories as $key => $cat):
        $event = $cat['events'][0] ?? null;
    ?>
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-<?= $cat['color'] ?> card-hover">
            <?php if ($event): ?>
                <div class="card-img-top bg-<?= $cat['color'] ?> bg-opacity-10 text-center py-4">
                    <i class="bi <?= $cat['icon'] ?> display-3 text-<?= $cat['color'] ?>"></i>
                </div>
                <div class="card-body">
                    <span class="badge bg-<?= $cat['color'] ?> mb-2"><?= $cat['label'] ?></span>
                    <h5 class="card-title"><?= htmlspecialchars($event['titre']) ?></h5>
                    <p class="text-muted small">
                        <i class="bi bi-calendar3 me-1"></i><?= date('d/m/Y', strtotime($event['date_evenement'])) ?>
                        à <?= date('H\hi', strtotime($event['heure'])) ?><br>
                        <i class="bi bi-geo-alt me-1"></i><?= htmlspecialchars($event['lieu']) ?>
                    </p>
                    <p class="card-text small"><?= htmlspecialchars(substr($event['description'], 0, 100)) ?>...</p>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="<?= url('evenements/' . $event['id']) ?>" class="btn btn-outline-<?= $cat['color'] ?> btn-sm w-100">Voir les détails</a>
                </div>
            <?php else: ?>
                <div class="card-img-top bg-light text-center py-4">
                    <i class="bi <?= $cat['icon'] ?> display-3 text-muted"></i>
                </div>
                <div class="card-body text-center">
                    <span class="badge bg-<?= $cat['color'] ?> mb-2"><?= $cat['label'] ?></span>
                    <p class="text-muted">Aucun événement prévu</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Présentation -->
<div class="row g-4 mb-5">
    <div class="col-lg-8">
        <h2 class="mb-3"><i class="bi bi-info-circle me-2"></i>Notre Association</h2>
        <p>Notre association étudiante propose une ludothèque de jeux de société, accessible à tous les étudiants du campus. Que vous soyez membre ou non, venez découvrir nos jeux, participer à nos événements et rejoindre notre communauté !</p>
        <p>Les <strong>membres</strong> de l'association bénéficient d'emprunts gratuits de 1 à 2 semaines. Les <strong>non-membres</strong> peuvent louer des jeux à petit prix. Tout le monde peut réserver des jeux pour le <em>Jeu du Jeudi</em>.</p>
        <a href="<?= url('a-propos') ?>" class="btn btn-outline-primary">En savoir plus</a>
    </div>
    <div class="col-lg-4">
        <div class="card bg-light">
            <div class="card-body text-center">
                <h5><i class="bi bi-chat-dots me-2"></i>Contactez-nous</h5>
                <p class="mb-2"><i class="bi bi-envelope me-1"></i> contact@ludotheque.fr</p>
                <div class="d-flex gap-2 justify-content-center">
                    <span class="badge bg-secondary"><i class="bi bi-instagram me-1"></i>Instagram</span>
                    <span class="badge bg-secondary"><i class="bi bi-discord me-1"></i>Discord</span>
                </div>
                <a href="<?= url('contact') ?>" class="btn btn-primary btn-sm mt-3">Nous écrire</a>
            </div>
        </div>
    </div>
</div>
