<?php ob_start(); ?>
<h2 class="text-center">Connexion</h2>

<form action="" method="post">
    <div class="form-group">
        <label for="login">Login</label>
        <input type="text" name="login" id="login" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Mot de Passe</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <input type="submit" value="Connexion" class="btn btn-success mt-2">
</form>

<?php 
$contenu = ob_get_clean();
include "template.php";
