<?php ob_start(); ?>
<h2 class="text-center">Liste des Véhicules</h2>

<?php if (!isset($_SESSION['user_id'])): ?>
    <p class="alert alert-warning text-center">Vous devez être connecté pour voir cette liste et effectuer des actions.</p>
<?php else: ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($vehicules)): ?>
                <?php foreach ($vehicules as $vehicule): ?>
                    <tr>
                        <td><?= htmlentities($vehicule->getMarque()) ?></td>
                        <td><?= htmlentities($vehicule->getModele()) ?></td>
                        <td><?= $vehicule->getDisponible() ? "Disponible" : "Indisponible" ?></td>
                        <td>
                            <a href="index.php?page=vehicules&action=edit&id=<?= $vehicule->getId() ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="index.php?page=vehicules&action=delete&id=<?= $vehicule->getId() ?>" class="btn btn-danger btn-sm">Supprimer</a>
                            <!-- Lien vers les détails du véhicule et les commentaires -->
                            <a href="index.php?page=vehicules&action=details&id=<?= $vehicule->getId() ?>" class="btn btn-info btn-sm">Détails</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Aucun véhicule disponible</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Lien d'ajout de véhicule -->
    <a href="index.php?page=vehicules&action=add" class="btn btn-success">Ajouter un véhicule</a>
<?php endif; ?>

<?php 
$contenu = ob_get_clean();
include "PROJET/public/template.php"; // Modifiez le chemin du template si nécessaire
?>
