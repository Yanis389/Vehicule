<?php ob_start(); ?>
<h2 class="text-center">Liste des Clients</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Login</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($clients)): ?>
            <?php foreach ($clients as $client): ?>
            <tr>
                <td><?= htmlspecialchars($client['prenom']) ?></td>
                <td><?= htmlspecialchars($client['login']) ?></td>
                <td><?= htmlspecialchars($client['email']) ?></td>
                <td>
                    <!-- Exemple d'action à ajouter pour chaque client -->
                    <a href="?action=viewProfile&id=<?= $client['id'] ?>" class="btn btn-info">Voir Profil</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">Aucun client trouvé</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php 
$contenu = ob_get_clean();
include 'public/template.php'; 
?>
