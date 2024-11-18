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
            <td><?= htmlentities($reservation['marque'] . ' ' . $reservation['modele']) ?></td>
            <td><?= htmlentities($reservation['nom_utilisateur']) ?></td>
            <td><?= htmlentities($reservation['date_debut']) ?></td>
            <td><?= htmlentities($reservation['date_fin']) ?></td>
            <td>
                <a href="?action=deleteReservation&id=<?= $reservation['id'] ?>" class="btn btn-danger btn-sm">Annuler</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
$contenu = ob_get_clean();
include 'public/template.php'; 
