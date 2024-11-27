
<h2>Modifier le commentaire</h2>

<form action="/commentaire/edit/<?= $commentaire->getId() ?>" method="POST">
    <input type="hidden" name="id" value="<?= $commentaire->getId() ?>">

    <label for="note">Note (1-5):</label>
    <input type="number" name="note" id="note" value="<?= $commentaire->getNote() ?>" min="1" max="5" required><br><br>

    <label for="commentaire">Commentaire:</label><br>
    <textarea name="commentaire" id="commentaire" rows="4" cols="50" required><?= htmlspecialchars($commentaire->getCommentaire()) ?></textarea><br><br>

    <button type="submit">Modifier</button>
</form>
<?php
$contenu = ob_get_clean();
include "Projet/public/template.php";
?>