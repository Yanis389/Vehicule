<form action="" method="post">
    <div class="form-group">
        <label for="civilite">Civilité</label>
        <select name="civilite" id="civilite" class="form-control" required>
            <option value="">Sélectionnez</option>
            <option value="M">Monsieur</option>
            <option value="Mme">Madame</option>
        </select>
    </div>
    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="tel">Téléphone</label>
        <input type="tel" name="tel" id="tel" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="login">Login</label>
        <input type="text" name="login" id="login" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Mot de Passe</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <input type="submit" value="Inscription" class="btn btn-success mt-2">
</form>
