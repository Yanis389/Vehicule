<?php ob_start(); ?>
<div class="container text-center">
    <h1>Bienvenue sur notre plateforme de location de véhicules</h1>

    <p>Choisissez une option dans le menu pour commencer :</p>

    <?php if (isset($_SESSION['user'])): ?>
        <?php if (unserialize($_SESSION['user'])->getRole() == "GERANT"): ?>
            <p><a href="?page=vehicules&action=list" class="btn btn-primary">Gérer les véhicules</a></p>
            <p><a href="?page=reservations&action=list" class="btn btn-primary">Voir les réservations</a></p>
            <p><a href="?page=users&action=manage" class="btn btn-primary">Gérer les utilisateurs</a></p>
        <?php endif; ?>

        <p><a href="?page=vehicules&action=list" class="btn btn-primary">Voir les véhicules disponibles</a></p>
        <p><a href="?page=reservations&action=create" class="btn btn-success">Faire une réservation</a></p>
        <p><a href="?page=commentaires&action=list" class="btn btn-info">Voir les commentaires</a></p>
    <?php else: ?>
        <p><a href="?page=users&action=register" class="btn btn-primary">S'inscrire</a></p>
        <p><a href="?page=users&action=login" class="btn btn-secondary">Se connecter</a></p>
    <?php endif; ?>
</div>
<?php 
$contenu = ob_get_clean();
include "Projet/public/template.php";
?>
