<?php ob_start(); ?>
<h2 class="text-center">Sélectionnez un Véhicule</h2>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error']; ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php if (!empty($vehicules)): ?>
    <form action="?page=reservations&action=create" method="POST">
        <div class="form-group">
            <label for="vehicule">Véhicule</label>
            <select name="vehicule_id" class="form-control" required>
                <option value="">Sélectionner un véhicule</option>
                <?php foreach ($vehicules as $vehicule): ?>
                    <?php if ($vehicule['statut_dispo'] == 1): ?> <!-- Seulement les véhicules disponibles -->
                        <option value="<?= $vehicule['id']; ?>">
                            <?= htmlentities($vehicule['marque']) . ' ' . htmlentities($vehicule['modele']); ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Réserver</button>
    </form>
<?php else: ?>
    <p>Aucun véhicule disponible pour le moment.</p>
<?php endif; ?>

<?php 
$contenu = ob_get_clean();
include "Projet/public/template.php";
?>
