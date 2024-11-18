<?php

class UserController
{
    // Inscription d'un utilisateur
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $civilite = $_POST['civilite'];
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $login = $_POST['login'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $tel = $_POST['tel'];
            $password = $_POST['password'];

            // Validation des données
            if (strlen($login) < 4 || strlen($password) < 4) {
                die('Le login et le mot de passe doivent contenir au moins 4 caractères.');
            }

            // Préparation des données pour l'ajout
            $data = [
                'civilite' => $civilite,
                'prenom' => $prenom,
                'nom' => $nom,
                'login' => $login,
                'email' => $email,
                'role' => $role,
                'tel' => $tel,
                'mdp' => $password,  // Le mot de passe sera haché dans le modèle
            ];

            // Appel à la méthode pour ajouter l'utilisateur
            $user = new User(); // Instance de User
            $user->add($data);  // Ajout de l'utilisateur dans la base de données

            // Redirection vers la page de connexion
            header('Location: /login');
            exit;
        }

        // Affichage du formulaire d'inscription
        include './views/users/register.php'; // Formulaire d'inscription
    }

    // Connexion
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'];
            $password = $_POST['password'];

            // Création d'une instance de User pour récupérer l'utilisateur par login
            $user = new User();
            $user = $user->getByLogin($login); // Récupération de l'utilisateur par login

            if ($user && password_verify($password, $user->getPassword())) {
                // Si la connexion est réussie, on initialise les sessions
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['role'] = $user->getRole();
                header('Location: /dashboard');
                exit;
            } else {
                die('Connexion échouée. Vérifiez vos identifiants.');
            }
        }

        // Affichage du formulaire de connexion
        include './views/users/login.php'; // Formulaire de connexion
    }

    // Gestion des utilisateurs par l'administrateur
    public function manageUsers()
    {
        // Vérification que l'utilisateur est un administrateur
        if ($_SESSION['role'] !== 'ADMIN') {
            die('Accès interdit. Vous devez être administrateur pour accéder à cette page.');
        }

        // Création d'une instance de User pour récupérer tous les utilisateurs
        $user = new User();
        $users = $user->getAll(); // Récupération de tous les utilisateurs

        // Affichage de la vue de gestion des utilisateurs
        include './views/users/manage.php'; // Vue de gestion des utilisateurs
    }
}
?>
