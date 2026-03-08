<a href="<?= url('ludotheque') ?>" class="text-decoration-none text-muted mb-3 d-inline-block">
    <i class="bi bi-arrow-left me-1"></i>Retour au catalogue
</a>

<div class="row g-4">
    <!-- Image -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center py-5 bg-light">
                <?php if ($jeu['image'] && $jeu['image'] !== 'default_jeu.png'): ?>
                    <img src="<?= SITE_URL ?>/public/img/jeux/<?= htmlspecialchars($jeu['image']) ?>" alt="<?= htmlspecialchars($jeu['nom']) ?>" class="img-fluid">
                <?php else: ?>
                    <i class="bi bi-box-seam display-1 text-muted"></i>
                    <p class="text-muted mt-2">Image non disponible</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Informations -->
    <div class="col-md-8">
        <div class="d-flex align-items-center gap-3 mb-3">
            <h1 class="mb-0"><?= htmlspecialchars($jeu['nom']) ?></h1>
            <?php
            $statutBadge = ['en_stock'=>'success', 'emprunte'=>'warning', 'loue'=>'info', 'perdu'=>'danger'];
            $statutLabel = ['en_stock'=>'En stock', 'emprunte'=>'Emprunté', 'loue'=>'Loué', 'perdu'=>'Indisponible'];
            ?>
            <span class="badge bg-<?= $statutBadge[$jeu['statut']] ?? 'secondary' ?> fs-6">
                <?= $statutLabel[$jeu['statut']] ?? $jeu['statut'] ?>
            </span>
        </div>

        <!-- Caractéristiques -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="card bg-light text-center p-3">
                    <i class="bi bi-people fs-4 text-primary"></i>
                    <div class="fw-bold"><?= $jeu['nb_joueurs_min'] ?> — <?= $jeu['nb_joueurs_max'] ?></div>
                    <small class="text-muted">Joueurs</small>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card bg-light text-center p-3">
                    <i class="bi bi-clock fs-4 text-primary"></i>
                    <div class="fw-bold"><?= $jeu['temps_jeu_minutes'] ?> min</div>
                    <small class="text-muted">Temps de jeu</small>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card bg-light text-center p-3">
                    <i class="bi bi-mortarboard fs-4 text-primary"></i>
                    <div class="fw-bold"><?= ucfirst($jeu['difficulte_apprentissage']) ?></div>
                    <small class="text-muted">Apprentissage</small>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card bg-light text-center p-3">
                    <i class="bi bi-trophy fs-4 text-primary"></i>
                    <div class="fw-bold"><?= ucfirst($jeu['difficulte_jeu']) ?></div>
                    <small class="text-muted">Difficulté</small>
                </div>
            </div>
        </div>

        <!-- Description -->
        <?php if ($jeu['description']): ?>
        <h5>Description</h5>
        <p><?= nl2br(htmlspecialchars($jeu['description'])) ?></p>
        <?php endif; ?>

        <!-- Règles -->
        <?php if ($jeu['regles']): ?>
        <h5>Règles du jeu</h5>
        <p><?= nl2br(htmlspecialchars($jeu['regles'])) ?></p>
        <?php endif; ?>

        <!-- Actions -->
        <div class="mt-4">
            <?php if (!isLoggedIn()): ?>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    <a href="<?= url('connexion') ?>">Connectez-vous</a> pour emprunter, louer ou réserver ce jeu.
                </div>

            <?php elseif ($hasActiveRequest): ?>
                <div class="alert alert-warning">
                    <i class="bi bi-hourglass-split me-2"></i>
                    Vous avez déjà une demande en cours pour ce jeu.
                    <a href="<?= url('mon-compte/demandes') ?>">Voir mes demandes</a>
                </div>

            <?php elseif ($jeu['statut'] === STATUT_EN_STOCK): ?>
                <div class="d-flex flex-wrap gap-2">
                    <?php if (isMembre()): ?>
                    <!-- Emprunt (membres uniquement) -->
                    <form method="POST" action="<?= url('demande/emprunt/' . $jeu['id']) ?>" class="d-inline">
                        <?= csrf_field() ?>
                        <div class="input-group">
                            <select name="duree" class="form-select form-select-sm" style="max-width:140px;">
                                <option value="7">1 semaine</option>
                                <option value="14">2 semaines</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="bi bi-box-arrow-up me-1"></i>Emprunter
                            </button>
                        </div>
                    </form>
                    <?php endif; ?>

                    <!-- Location (tous les connectés) -->
                    <form method="POST" action="<?= url('demande/location/' . $jeu['id']) ?>" class="d-inline">
                        <?= csrf_field() ?>
                        <div class="input-group">
                            <select name="duree" class="form-select form-select-sm" style="max-width:140px;">
                                <option value="7">1 semaine</option>
                                <option value="14">2 semaines</option>
                            </select>
                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-cart me-1"></i>Louer
                            </button>
                        </div>
                    </form>

                    <!-- Réservation Jeu du Jeudi -->
                    <form method="POST" action="<?= url('demande/reservation/' . $jeu['id']) ?>" class="d-inline">
                        <?= csrf_field() ?>
                        <div class="input-group">
                            <input type="date" name="date_reservation" class="form-control form-control-sm" style="max-width:160px;" required>
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="bi bi-calendar-check me-1"></i>Réserver (Jeu du Jeudi)
                            </button>
                        </div>
                    </form>
                </div>
                <?php if (!isMembre()): ?>
                    <small class="text-muted mt-2 d-block">
                        <i class="bi bi-info-circle me-1"></i>Devenez membre pour emprunter gratuitement.
                    </small>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-secondary">
                    <i class="bi bi-x-circle me-2"></i>
                    Ce jeu n'est pas disponible actuellement (<?= $statutLabel[$jeu['statut']] ?? $jeu['statut'] ?>).
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
