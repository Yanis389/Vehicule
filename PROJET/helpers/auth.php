<?php
session_start();  // Démarrer la session si ce n'est pas déjà fait

// Fonction pour vérifier si l'utilisateur est connecté
function isLoggedIn() {
    return isset($_SESSION['user']) && $_SESSION['user'] !== null;
}

// Fonction pour se connecter
function login($pdo, $login, $password) {
    // Instancier un objet User
    $user = new User($pdo);  // Assurez-vous de passer le PDO si nécessaire pour les méthodes
    $userDetails = $user->getByLogin($login);  // Recherche l'utilisateur dans la base de données

    if ($userDetails && password_verify($password, $userDetails['password'])) {
        // Si les mots de passe correspondent, sauvegarde les informations de l'utilisateur en session
        $_SESSION['user'] = serialize($userDetails);  
        return true;
    }
    return false;  // Si les informations ne correspondent pas
}

// Fonction pour s'inscrire
function register($pdo, $prenom, $login, $password, $role = 'CLIENT') {
    // Instancier un objet User
    $user = new User($pdo);  // Assurez-vous de passer le PDO si nécessaire pour les méthodes

    // Vérifie si le login existe déjà
    $existingUser = $user->getByLogin($login);
    if ($existingUser) {
        return 'Le login est déjà utilisé.';
    }

    // Crée un nouvel utilisateur
    $data = [
        'prenom' => $prenom,
        'login' => $login,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'role' => $role
    ];

    // Ajoute l'utilisateur dans la base de données
    $result = $user->add($data);
    if ($result) {
        return 'Inscription réussie.';
    } else {
        return 'Erreur lors de l\'inscription.';
    }
}

// Fonction pour se déconnecter
function logout() {
    session_destroy();  // Détruire la session de l'utilisateur
    header("Location: index.php");  // Redirige vers la page d'accueil
    exit();
}

// Fonction pour récupérer l'utilisateur actuellement connecté
function getCurrentUser() {
    return isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;
}
?>
