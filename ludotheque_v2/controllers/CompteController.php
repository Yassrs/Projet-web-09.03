<?php
class CompteController {

    public function profil() {
        requireLogin();
        $user = currentUser();
        
        $demandeModel = new Demande();
        $demandes = $demandeModel->getByUser(currentUserId());
        $recentDemandes = array_slice($demandes, 0, 5);

        $pageTitle = 'Mon Compte';
        require BASE_PATH . '/views/layout/header.php';
        require BASE_PATH . '/views/compte/profil.php';
        require BASE_PATH . '/views/layout/footer.php';
    }

    public function demandes() {
        requireLogin();
        
        $demandeModel = new Demande();
        $demandes = $demandeModel->getByUser(currentUserId());

        $pageTitle = 'Mes Demandes';
        require BASE_PATH . '/views/layout/header.php';
        require BASE_PATH . '/views/compte/demandes.php';
        require BASE_PATH . '/views/layout/footer.php';
    }

    public function emprunts() {
        requireLogin();
        
        $demandeModel = new Demande();
        $allDemandes = $demandeModel->getByUser(currentUserId());
        // Filtrer uniquement les emprunts/locations validés
        $emprunts = array_filter($allDemandes, function($d) {
            return $d['statut'] === DEMANDE_VALIDEE && in_array($d['type_demande'], ['emprunt', 'location']);
        });

        $pageTitle = 'Mes Emprunts & Locations';
        require BASE_PATH . '/views/layout/header.php';
        require BASE_PATH . '/views/compte/emprunts.php';
        require BASE_PATH . '/views/layout/footer.php';
    }
}
