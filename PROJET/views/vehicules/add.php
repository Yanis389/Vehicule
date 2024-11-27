<h2 class="text-center">Ajouter un Véhicule</h2>

<form action="index.php?page=vehicules&action=add" method="post">
    <div class="form-group">
        <label for="marque">Marque</label>
        <input type="text" name="marque" id="marque" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="modele">Modèle</label>
        <input type="text" name="modele" id="modele" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="matricule">Immatriculation</label>
        <input type="text" name="matricule" id="matricule" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="type">Type</label>
        <input type="text" name="type" id="type" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="prix_journalier">Prix journalier</label>
        <input type="number" name="prix_journalier" id="prix_journalier" class="form-control" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="disponible">Disponible</label>
        <select name="disponible" id="disponible" class="form-control" required>
            <option value="1">Disponible</option>
            <option value="0">Indisponible</option>
        </select>
    </div>
    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="text" name="photo" id="photo" class="form-control">
    </div>
    <input type="submit" value="Ajouter" class="btn btn-success mt-2">
</form>
