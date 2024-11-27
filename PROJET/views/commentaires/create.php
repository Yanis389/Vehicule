<form action="index.php?page=commentaire&action=add" method="POST">
    <input type="hidden" name="vehicule_id" value="<?= $_GET['vehicule_id'] ?>">

    <label for="note">Note (1-5):</label>
    <input type="number" name="note" id="note" min="1" max="5" required><br><br>

    <label for="commentaire">Commentaire:</label><br>
    <textarea name="commentaire" id="commentaire" rows="4" cols="50" required></textarea><br><br>

    <button type="submit">Soumettre</button>
</form>
