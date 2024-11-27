<h2>Commentaires pour le véhicule</h2>

<?php if (empty($commentaires)): ?>
    <p>Aucun commentaire pour ce véhicule.</p>
<?php else: ?>
    <ul>
        <?php foreach ($commentaires as $commentaire): ?>
            <li>
                <strong>Note:</strong> <?= $commentaire->getNote() ?>/5<br>
                <strong>Commentaire:</strong> <?= nl2br(htmlspecialchars($commentaire->getCommentaire())) ?><br>
                <a href="/commentaire/delete/<?= $commentaire->getId() ?>">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
