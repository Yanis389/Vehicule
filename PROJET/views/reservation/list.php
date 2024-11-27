<?php ob_start(); ?>
<h2 class="text-center">Liste des Réservations</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Véhicule</th>
            <th>Utilisateur</th>
            <th>Date Début</th>
            <th>Date Fin</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reservations as $reservation): ?>
        <tr>
            <?php
            // Récupérer les informations du véhicule et de l'utilisateur
            $vehicule = $reservation->getVehicule();
            $utilisateur = $reservation->getUtilisateur();
            ?>
            <td><?= htmlentities($vehicule->getMarque() . ' ' . $vehicule->getModele()) ?></td>
            <td><?= htmlentities($utilisateur->getNom()) ?></td>
            <td><?= htmlentities($reservation->getDateDebut()) ?></td>
            <td><?= htmlentities($reservation->getDateFin()) ?></td>
            <td>
                <!-- Ajout du bouton pour annuler la réservation -->
                <a href="?action=deleteReservation&id=<?= $reservation->getId() ?>" class="btn btn-danger btn-sm">Annuler</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
$contenu = ob_get_clean();
include "Projet/public/template.php";
?>
