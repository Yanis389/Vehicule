<?php
// Assurez-vous d'avoir inclus les modèles Vehicule et Commentaire
require_once 'PROJET/models/Vehicule.php';
require_once 'PROJET/models/Commentaire.php';

// Vérification de l'existence de l'ID du véhicule dans l'URL
if (isset($_GET['id'])) {
    $vehiculeId = $_GET['id'];

    // Récupérer les informations du véhicule
    $vehicule = (new Vehicule())->getById($vehiculeId);
    if (!$vehicule) {
        echo "Véhicule non trouvé.";
        exit;
    }

    // Récupérer les commentaires pour le véhicule
    $commentaires = Commentaire::getByVehicule($vehiculeId);
    $noteMoyenne = 0;

    // Calculer la note moyenne des commentaires
    if (!empty($commentaires)) {
        $totalNotes = 0;
        foreach ($commentaires as $commentaire) {
            $totalNotes += $commentaire->getNote();
        }
        $noteMoyenne = $totalNotes / count($commentaires);
    }
} else {
    // Si l'ID du véhicule n'est pas défini, rediriger vers une page d'erreur
    echo "Aucun véhicule trouvé.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Véhicule</title>
    <!-- Ajoutez ici vos liens CSS ou autres ressources -->
</head>
<body>
    <h1>Détails du Véhicule</h1>

    <!-- Affichage des informations du véhicule -->
    <div class="vehicule-details">
        <img src="uploads/<?= htmlspecialchars($vehicule->getPhoto()) ?>" alt="Photo du véhicule" style="width: 300px; height: auto;">
        <p><strong>Marque:</strong> <?= htmlspecialchars($vehicule->getMarque()) ?></p>
        <p><strong>Modèle:</strong> <?= htmlspecialchars($vehicule->getModele()) ?></p>
        <p><strong>Matricule:</strong> <?= htmlspecialchars($vehicule->getMatricule()) ?></p>
        <p><strong>Type:</strong> <?= htmlspecialchars($vehicule->getType()) ?></p>
        <p><strong>Prix Journalier:</strong> <?= number_format($vehicule->getPrixJournalier(), 2) ?> €</p>
        <p><strong>Statut:</strong> <?= $vehicule->getDisponible() ? "Disponible" : "Indisponible" ?></p>

        <!-- Affichage de la note moyenne -->
        <p><strong>Note moyenne:</strong> <?= number_format($noteMoyenne, 2) ?> / 5</p>

        <!-- Formulaire de réservation (optionnel) -->
        <?php if ($vehicule->getDisponible()) : ?>
            <a href="reservation.php?vehicule_id=<?= $vehicule->getId() ?>" class="btn-reservation">Réserver ce véhicule</a>
        <?php else : ?>
            <p><em>Ce véhicule est actuellement indisponible.</em></p>
        <?php endif; ?>
    </div>

    <!-- Section des commentaires -->
    <h2>Commentaires</h2>

    <?php if (empty($commentaires)) : ?>
        <p>Aucun commentaire pour ce véhicule.</p>
    <?php else : ?>
        <ul>
            <?php foreach ($commentaires as $commentaire) : ?>
                <li>
                    <p><strong>Note:</strong> <?= $commentaire->getNote() ?>/5</p>
                    <p><strong>Commentaire:</strong> <?= nl2br(htmlspecialchars($commentaire->getCommentaire())) ?></p>
                    <p><strong>Par utilisateur ID:</strong> <?= $commentaire->getIdUser() ?></p>

                    <!-- Lien pour supprimer un commentaire (si l'utilisateur a les droits) -->
                    <a href="index.php?page=commentaire&action=delete&id=<?= $commentaire->getId() ?>">Supprimer</a>
                </li>
                <br>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <!-- Lien pour ajouter un commentaire -->
    <a href="index.php?page=commentaire&action=create&vehicule_id=<?= $vehiculeId ?>">Ajouter un commentaire</a>

</body>
</html>
