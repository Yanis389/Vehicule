<form action="index.php?page=vehicules&action=update&id=<?= $vehicule->getId() ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $vehicule->getId() ?>">

    <div class="form-group">
        <label for="marque">Marque</label>
        <input type="text" name="marque" id="marque" class="form-control" value="<?= $vehicule->getMarque() ?>" required>
    </div>
    <div class="form-group">
        <label for="modele">Modèle</label>
        <input type="text" name="modele" id="modele" class="form-control" value="<?= $vehicule->getModele() ?>" required>
    </div>
    <div class="form-group">
        <label for="matricule">Matricule</label>
        <input type="text" name="matricule" id="matricule" class="form-control" value="<?= $vehicule->getMatricule() ?>" required>
    </div>
    <div class="form-group">
        <label for="type">Type de véhicule</label>
        <input type="text" name="type" id="type" class="form-control" value="<?= $vehicule->getType() ?>" required>
    </div>
    <div class="form-group">
        <label for="prix_journalier">Prix Journalier</label>
        <input type="number" name="prix_journalier" id="prix_journalier" class="form-control" value="<?= $vehicule->getPrixJournalier() ?>" required>
    </div>
    <div class="form-group">
        <label for="disponible">Disponible</label>
        <select name="disponible" id="disponible" class="form-control" required>
            <option value="1" <?= $vehicule->getDisponible() == 1 ? 'selected' : '' ?>>Oui</option>
            <option value="0" <?= $vehicule->getDisponible() == 0 ? 'selected' : '' ?>>Non</option>
        </select>
    </div>
    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" name="photo" id="photo" class="form-control">
        <img src="path/to/photos/<?= $vehicule->getPhoto() ?>" alt="Photo du véhicule" width="100">
    </div>

    <input type="submit" value="Modifier" class="btn btn-warning mt-2">
</form>
