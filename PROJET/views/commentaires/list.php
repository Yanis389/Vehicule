<?php
if (empty($commentaires)) {
    echo "<p>Aucun commentaire pour ce véhicule.</p>";
} else {
    echo "<h2>Commentaires pour ce véhicule</h2>";
    echo "<ul>";
    foreach ($commentaires as $commentaire) {
        echo "<li>";
        echo "<strong>Note: </strong>" . $commentaire->getNote() . "/5<br>";
        echo "<strong>Commentaire: </strong>" . nl2br(htmlspecialchars($commentaire->getCommentaire())) . "<br>";
        echo "<strong>Par utilisateur ID: </strong>" . $commentaire->getIdUser() . "<br>";
        echo "<a href='/commentaire/delete/" . $commentaire->getId() . "'>Supprimer</a>";
        echo "</li><br>";
    }
    echo "</ul>";
}
?>
<a href="/commentaire/create?vehicule_id=<?= $vehiculeId ?>">Ajouter un commentaire</a>
<?php
$contenu = ob_get_clean();
include "public/template.php";
?>