<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?= url('') ?>">
            <i class="bi bi-dice-5-fill me-2"></i>
            <span class="fw-bold">Ludothèque</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= ($pageTitle ?? '') === 'Accueil' ? 'active' : '' ?>" href="<?= url('') ?>">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($pageTitle ?? '') === 'Événements' ? 'active' : '' ?>" href="<?= url('evenements') ?>">Événements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($pageTitle ?? '') === 'Ludothèque' ? 'active' : '' ?>" href="<?= url('ludotheque') ?>">Ludothèque</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($pageTitle ?? '') === 'À Propos' ? 'active' : '' ?>" href="<?= url('a-propos') ?>">À Propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($pageTitle ?? '') === 'Contact' ? 'active' : '' ?>" href="<?= url('contact') ?>">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (isLoggedIn()): ?>
                    <?php if (isAdmin()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= url('admin') ?>">
                                <i class="bi bi-speedometer2 me-1"></i>Admin
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (isPresident()): ?>
                        <li class="nav-item">
                            <a class="nav-link text-warning" href="<?= url('president') ?>">
                                <i class="bi bi-star-fill me-1"></i>Bureau
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            <?= htmlspecialchars(currentUser()['prenom']) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><span class="dropdown-item-text text-muted small">
                                <?php 
                                    $roleLabels = ['non_membre'=>'Non-membre', 'membre'=>'Membre', 'admin'=>'Administrateur', 'president'=>'Président'];
                                    echo $roleLabels[currentUserRole()] ?? currentUserRole();
                                ?>
                            </span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= url('mon-compte') ?>"><i class="bi bi-person me-2"></i>Mon Profil</a></li>
                            <li><a class="dropdown-item" href="<?= url('mon-compte/demandes') ?>"><i class="bi bi-list-check me-2"></i>Mes Demandes</a></li>
                            <li><a class="dropdown-item" href="<?= url('mon-compte/emprunts') ?>"><i class="bi bi-box-seam me-2"></i>Mes Emprunts</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= url('deconnexion') ?>"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('connexion') ?>">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Connexion
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
