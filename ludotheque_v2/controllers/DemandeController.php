<?php
class DemandeController {

    public function emprunt($jeuId) {
        requireLogin();
        if (!isMembre()) {
            setFlash('error', 'Seuls les membres peuvent emprunter des jeux.');
            redirect('/ludotheque/jeu/' . $jeuId);
        }
        $this->creerDemande($jeuId, 'emprunt');
    }

    public function location($jeuId) {
        requireLogin();
        $this->creerDemande($jeuId, 'location');
    }

    public function reservation($jeuId) {
        requireLogin();
        
        $dateReservation = sanitize($_POST['date_reservation'] ?? '');
        
        // Vérifier que c'est un jeudi
        if (!empty($dateReservation)) {
            $jour = date('N', strtotime($dateReservation));
            if ($jour != 4) { // 4 = jeudi
                setFlash('error', 'Les réservations sont uniquement possibles pour un jeudi.');
                redirect('/ludotheque/jeu/' . $jeuId);
            }
            
            // Vérifier que la date est dans le futur
            if (strtotime($dateReservation) < strtotime('today')) {
                setFlash('error', 'La date de réservation doit être dans le futur.');
                redirect('/ludotheque/jeu/' . $jeuId);
            }

            // Vérifier que le jeu n'est pas déjà réservé pour cette date
            $demandeModel = new Demande();
            if ($demandeModel->isReservedForDate($jeuId, $dateReservation)) {
                setFlash('error', 'Ce jeu est déjà réservé pour cette date.');
                redirect('/ludotheque/jeu/' . $jeuId);
            }
        }

        $this->creerDemande($jeuId, 'reservation', $dateReservation, $dateReservation);
    }

    private function creerDemande($jeuId, $type, $dateDebut = null, $dateFin = null) {
        if (!verify_csrf($_POST['csrf_token'] ?? '')) {
            setFlash('error', 'Token de sécurité invalide.');
            redirect('/ludotheque/jeu/' . $jeuId);
        }

        $jeuModel = new Jeu();
        $jeu = $jeuModel->findById($jeuId);

        if (!$jeu) {
            setFlash('error', 'Jeu introuvable.');
            redirect('/ludotheque');
        }

        if ($jeu['statut'] !== STATUT_EN_STOCK && $type !== 'reservation') {
            setFlash('error', 'Ce jeu n\'est pas disponible actuellement.');
            redirect('/ludotheque/jeu/' . $jeuId);
        }

        // Vérifier les demandes actives
        $demandeModel = new Demande();
        if ($demandeModel->hasActiveRequest(currentUserId(), $jeuId)) {
            setFlash('warning', 'Vous avez déjà une demande en cours pour ce jeu.');
            redirect('/ludotheque/jeu/' . $jeuId);
        }

        // Dates par défaut pour emprunt/location
        if (!$dateDebut) {
            $duree = intval($_POST['duree'] ?? 7);
            $duree = max(DUREE_MIN_JOURS, min(DUREE_MAX_JOURS, $duree));
            $dateDebut = date('Y-m-d');
            $dateFin = date('Y-m-d', strtotime("+{$duree} days"));
        }

        $data = [
            'id_utilisateur' => currentUserId(),
            'id_jeu' => $jeuId,
            'type_demande' => $type,
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
        ];

        $id = $demandeModel->create($data);
        if ($id) {
            $typeLabel = ['emprunt' => 'emprunt', 'location' => 'location', 'reservation' => 'réservation'];
            setFlash('success', 'Votre demande de ' . ($typeLabel[$type] ?? $type) . ' a été enregistrée. Elle sera traitée par un administrateur.');
        } else {
            setFlash('error', 'Erreur lors de la création de la demande.');
        }

        redirect('/mon-compte/demandes');
    }
}
