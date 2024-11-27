<h2 class="text-center">Créer une Réservation</h2>

<form action="" method="post">
    <div class="form-group">
        <label for="id_vehicule">Véhicule</label>
        <select name="id_vehicule" id="id_vehicule" class="form-select" required>
            <?php if (!empty($vehicules)): ?>
                <?php foreach ($vehicules as $vehicule): ?>
                    <option value="<?= $vehicule->getId() ?>">
                        <?= htmlspecialchars($vehicule->getMarque() . ' ' . $vehicule->getModele()) ?>
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option disabled>Aucun véhicule disponible</option>
            <?php endif; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="date_debut">Date de Début</label>
        <input type="date" name="date_debut" id="date_debut" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="date_fin">Date de Fin</label>
        <input type="date" name="date_fin" id="date_fin" class="form-control" required>
    </div>
    <input type="submit" value="Réserver" class="btn btn-success mt-2">
</form>
