<?php ob_start(); ?>
<h2 class="text-center">Supprimer une Réservation</h2>

<p>Êtes-vous sûr de vouloir supprimer cette réservation ?</p>
<form action="" method="post">
    <input type="submit" name="confirm" value="yes" class="btn btn-danger">
    <a href="index.php?action=listReservations" class="btn btn-secondary">Annuler</a>
</form>

<?php
$contenu = ob_get_clean();
include "Projet/public/template.php";
?>
