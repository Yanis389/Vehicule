<?php ob_start(); ?>
<h2 class="text-center">Liste des Véhicules</h2>

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
                    <td><?= htmlentities($vehicule['marque']) ?></td>
                    <td><?= htmlentities($vehicule['modele']) ?></td>
                    <td><?= $vehicule['statut_dispo'] ? "Disponible" : "Indisponible" ?></td>
                    <td>
                        <a href="?action=editVehicule&id=<?= $vehicule['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="?action=deleteVehicule&id=<?= $vehicule['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
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

<a href="?action=addVehicule" class="btn btn-success">Ajouter un véhicule</a>
<?php 
$contenu = ob_get_clean();
include 'public/template.php'; 
?>
