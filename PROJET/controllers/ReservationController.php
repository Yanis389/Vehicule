<?php

class ReservationController
{
    // Liste des réservations
    public function listReservations()
    {
        $reservation = new Reservation();
        $reservations = $reservation->getAll();
        include 'PROJET/views/reservation/list.php';
    }

    // Créer une réservation
    public function createReservation()
    {
        // Récupérer les véhicules disponibles
        $vehiculeController = new VehiculeController();
        $vehicules = $vehiculeController->getAvailableVehicles();

        // Si aucun véhicule n'est disponible
        if (empty($vehicules)) {
            echo "Aucun véhicule disponible à la réservation.";
            return;
        }

        // Gérer la soumission du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vehiculeId = $_POST['id_vehicule'] ?? null;
            $dateDebut = $_POST['date_debut'] ?? null;
            $dateFin = $_POST['date_fin'] ?? null;

            // Validation
            if (!$vehiculeId || !$dateDebut || !$dateFin) {
                die('Veuillez remplir tous les champs.');
            }

            if ($dateDebut >= $dateFin) {
                die('La date de fin doit être après la date de début.');
            }

            $userId = $_SESSION['user_id'] ?? null; // ID utilisateur connecté
            if (!$userId) {
                die('Utilisateur non connecté.');
            }

            // Ajouter la réservation
            $reservation = new Reservation();
            $reservation->add([
                'idVehicule' => $vehiculeId,
                'idUser' => $userId,
                'dateDebut' => $dateDebut,
                'dateFin' => $dateFin,
            ]);

            // Mettre à jour la disponibilité du véhicule
            $vehiculeController->updateVehiculeAvailability($vehiculeId, 0);

            // Redirection
            header('Location: /vehicule/index.php?page=reservations&action=list');
            exit;
        }

        // Inclure le formulaire
        include 'PROJET/views/reservation/create.php';
    }

    // Annuler une réservation
    public function cancelReservation($id)
    {
        // Assurez-vous que l'id de la réservation est bien passé
        if ($id) {
            $reservation = new Reservation();
            $reservation->delete($id); // Suppression de la réservation
        }
        // Redirection vers la liste des réservations après suppression
        header('Location: /vehicule/index.php?page=reservations&action=list');
        exit;
    }
}
?>
