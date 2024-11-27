<?php
session_start();  // Démarrer la session si ce n'est pas déjà fait

class Auth {
    private $pdo;

    // Constructeur pour initialiser le PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Vérifie si l'utilisateur est connecté
    public function isLoggedIn() {
        return isset($_SESSION['user']) && $_SESSION['user'] !== null;
    }

    // Connecte l'utilisateur
    public function login($login, $password) {
        // Instancier un objet User
        $user = new User($this->pdo);  // Assurez-vous que la classe User accepte $pdo
        $userDetails = $user->getByLogin($login);  // Recherche l'utilisateur dans la base

        if ($userDetails && password_verify($password, $userDetails->getPassword())) {
            // Si les mots de passe correspondent, sauvegarde l'utilisateur en session
            $_SESSION['user'] = serialize($userDetails);  
            return true;
        }

        return false;  // Si le login ou le mot de passe est incorrect
    }

    // Inscrit un nouvel utilisateur
    public function register($prenom, $login, $password, $role = 'CLIENT') {
        $user = new User($this->pdo);  // Instancier un objet User

        // Vérifie si le login existe déjà
        $existingUser = $user->getByLogin($login);
        if ($existingUser) {
            return 'Le login est déjà utilisé.';
        }

        // Prépare les données pour l'insertion
        $data = [
            'civilite' => null,  // Ou une valeur par défaut
            'prenom' => $prenom,
            'nom' => null,  // Ou une valeur par défaut
            'login' => $login,
            'email' => null,  // Ou une valeur par défaut
            'role' => $role,
            'tel' => null,  // Ou une valeur par défaut
            'mdp' => password_hash($password, PASSWORD_DEFAULT)
        ];

        // Ajoute l'utilisateur dans la base
        $result = $user->add($data);
        if ($result) {
            return 'Inscription réussie.';
        } else {
            return 'Erreur lors de l\'inscription.';
        }
    }

    // Déconnecte l'utilisateur
    public function logout() {
        session_destroy();  // Détruit la session
        header("Location: index.php");  // Redirige vers la page d'accueil
        exit();
    }

    // Récupère l'utilisateur actuellement connecté
    public function getCurrentUser() {
        return isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;
    }
}
?>
