    </div><!-- /.container -->
</main>

<footer class="bg-dark text-light py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5><i class="bi bi-dice-5-fill me-2"></i>Ludothèque</h5>
                <p class="text-muted small">Association étudiante dédiée aux jeux de société. Emprunts, locations et événements pour tous les étudiants du campus.</p>
            </div>
            <div class="col-md-4">
                <h6>Liens rapides</h6>
                <ul class="list-unstyled small">
                    <li><a href="<?= url('ludotheque') ?>" class="text-muted text-decoration-none">Nos jeux</a></li>
                    <li><a href="<?= url('evenements') ?>" class="text-muted text-decoration-none">Événements</a></li>
                    <li><a href="<?= url('a-propos') ?>" class="text-muted text-decoration-none">À propos</a></li>
                    <li><a href="<?= url('contact') ?>" class="text-muted text-decoration-none">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6>Contact</h6>
                <p class="text-muted small">
                    <i class="bi bi-envelope me-1"></i> contact@ludotheque.fr<br>
                    <i class="bi bi-instagram me-1"></i> @ludotheque_ece<br>
                    <i class="bi bi-discord me-1"></i> Ludothèque ECE
                </p>
            </div>
        </div>
        <hr class="border-secondary">
        <p class="text-center text-muted small mb-0">&copy; 2026 Ludothèque — Association Étudiante ECE. Projet Web APP ING3.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="<?= SITE_URL ?>/public/js/main.js"></script>
</body>
</html>
