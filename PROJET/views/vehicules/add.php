<?php ob_start(); ?>
<h2 class="text-center">Ajouter un Véhicule</h2>

<form action="" method="post">
    <div class="form-group">
        <label for="marque">Marque</label>
        <input type="text" name="marque" id="marque" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="modele">Modèle</label>
        <input type="text" name="modele" id="modele" class="form-control" required>
    </div>
    <input type="submit" value="Ajouter" class="btn btn-success mt-2">
</form>

<?php 
$contenu = ob_get_clean();
include "template.php";
