<?php ob_start(); ?>
<h2 class="text-center">Modifier un Véhicule</h2>

<form action="" method="post">
    <input type="hidden" name="id" value="<?= $vehicule->getId() ?>">
    <div class="form-group">
        <label for="marque">Marque</label>
        <input type="text" name="marque" id="marque" class="form-control" value="<?= $vehicule->getMarque() ?>" required>
    </div>
    <div class="form-group">
        <label for="modele">Modèle</label>
        <input type="text" name="modele" id="modele" class="form-control" value="<?= $vehicule->getModele() ?>" required>
    </div>
    <input type="submit" value="Modifier" class="btn btn-warning mt-2">
</form>

<?php 
$contenu = ob_get_clean();
include "template.php";
