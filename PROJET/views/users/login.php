<?php ob_start(); ?>
<h2 class="text-center">Connexion</h2>

<form action="" method="post">
    <div class="form-group">
        <label for="login">Login</label>
        <input type="text" name="login" id="login" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Mot de Passe</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <input type="submit" value="Connexion" class="btn btn-success mt-2">
</form>

<?php
// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Vérifier l'existence de l'utilisateur dans la base de données
    $query = "SELECT * FROM personne WHERE login = :login";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['login' => $login]);
    $user = $stmt->fetch();

    if ($user) {
        // Vérifier le mot de passe
        if (password_verify($password, $user['mdp'])) {
            // Connecter l'utilisateur (enregistrement de la session)
            session_start();
            $_SESSION['id_personne'] = $user['id_personne'];
            $_SESSION['role'] = $user['role']; // Enregistrer le rôle de l'utilisateur

            // Rediriger en fonction du rôle
            if ($user['role'] == 'ADMIN') {
                // Si administrateur, rediriger vers le tableau de bord admin
                header('Location: /vehicule/admin/dashboard.php');
                exit();
            } else {
                // Si utilisateur, rediriger vers la page de création de réservation
                header('Location: /vehicule/user/create_reservation.php');
                exit();
            }
        } else {
            // Mot de passe incorrect
            echo '<div class="alert alert-danger">Mot de passe incorrect</div>';
        }
    } else {
        // Utilisateur non trouvé
        echo '<div class="alert alert-danger">Utilisateur non trouvé</div>';
    }
}

$contenu = ob_get_clean();
include "Projet/public/template.php";
?>
