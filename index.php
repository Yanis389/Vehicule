<?php
// Point d'entrée principal du projet

// Inclusion des fichiers nécessaires
require_once '../config/database.php';
require_once '../controllers/VehiculeController.php';
require_once '../controllers/ReservationController.php';
require_once '../controllers/UserController.php';

// Instanciation des contrôleurs
$vehiculeController = new VehiculeController();
$reservationController = new ReservationController();
$userController = new UserController();

// Liste des véhicules
$vehicules = $vehiculeController->listVehicules();

// Inclure l'en-tête
include 'header.php';
?>

<main>
    <h1>Bienvenue sur la plateforme de gestion de location de véhicules</h1>

    <section>
        <h2>Liste des véhicules disponibles</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Matricule</th>
                    <th>Prix Journalier (€)</th>
                    <th>Type</th>
                    <th>Disponibilité</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehicules as $vehicule): ?>
                    <tr>
                        <td><?= htmlspecialchars($vehicule['marque']) ?></td>
                        <td><?= htmlspecialchars($vehicule['modele']) ?></td>
                        <td><?= htmlspecialchars($vehicule['matricule']) ?></td>
                        <td><?= htmlspecialchars($vehicule['prix_journalier']) ?></td>
                        <td><?= htmlspecialchars($vehicule['type_vehicule']) ?></td>
                        <td><?= $vehicule['statut_dispo'] ? 'Disponible' : 'Indisponible' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<?php
// Inclure le pied de page
include 'footer.php';
?>
