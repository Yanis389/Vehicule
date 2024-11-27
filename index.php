<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Démarrage de la session
session_start();

// Inclusion des fichiers nécessaires
include "Projet/concept/database.sql";
include "Projet/controllers/VehiculeController.php";
include "Projet/controllers/ReservationController.php";
include "Projet/controllers/UserController.php";
include "Projet/controllers/CommentaireController.php";

include "Projet/models/Reservation.php";
include "Projet/models/User.php";
include "Projet/models/Commentaire.php";
include "Projet/models/Vehicule.php";


// Variables dynamiques pour le template
$title = 'Accueil';
$contenu = '';

// Routeur basique
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

// Contrôleurs
$vehiculeController = new VehiculeController();
$reservationController = new ReservationController();
$userController = new UserController();
$commentaireController = new CommentaireController();

// Logique de routage
ob_start(); // Démarrage du buffer
switch ($page) {
    case 'home':
        include 'PROJET/views/home.php';
        break;
    case 'vehicules':
        switch ($action) {
            case 'list':
                $vehiculeController->listVehicules();
                break;
            case 'add':
                $vehiculeController->addVehicule();
                break;
            case 'edit':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $vehiculeController->updateVehicule($id);
                }
                break;
            case 'delete':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $vehiculeController->deleteVehicule($id);
                }
                break;
        }
        break;
    case 'reservations':
        switch ($action) {
            case 'list':
                $reservationController->listReservations();
                break;
            case 'create':
                $reservationController->createReservation();
                break;
            case 'cancel':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $reservationController->cancelReservation($id);
                }
                break;
        }
        break;
    case 'users':
        switch ($action) {
            case 'register':
                $userController->register();
                break;
            case 'login':
                $userController->login();
                break;
            case 'manage':
                $userController->manageUsers();
                break;
        }
        break;
    case 'commentaires':
        switch ($action) {
            case 'list':
                $vehiculeId = $_GET['vehicule_id'] ?? null;
                if ($vehiculeId) {
                    $commentaireController->listCommentaires($vehiculeId);
                }
                break;
            case 'add':
                $commentaireController->addCommentaire();
                break;
        }
        break;
}
$contenu = ob_get_clean(); // Récupération du contenu généré

// Inclusion du template principal
include "Projet/public/template.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
