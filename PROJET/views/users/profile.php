<?php ob_start(); ?>
<h2 class="text-center">Profil de <?= htmlentities($user->getPrenom()) ?></h2>

<p><strong>Nom:</strong> <?= htmlentities($user->getNom()) ?></p>
<p><strong>Email:</strong> <?= htmlentities($user->getEmail()) ?></p>

<a href="?action=logout" class="btn btn-danger">Déconnexion</a>

<?php 
$contenu = ob_get_clean();
include "Projet/public/template.php";
?>
