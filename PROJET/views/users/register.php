<?php ob_start(); ?>
<h2 class="text-center">Inscription</h2>

<form action="" method="post">
    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" class="form-control" required>
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

<?php 
$contenu = ob_get_clean();
include "template.php";
