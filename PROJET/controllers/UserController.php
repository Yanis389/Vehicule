    <?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

    class UserController
    {
        // Inscription d'un utilisateur
        public function register()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupération des données du formulaire
                $civilite = $_POST['civilite'] ?? null;
                $prenom = trim($_POST['prenom'] ?? '');
                $nom = trim($_POST['nom'] ?? '');
                $login = trim($_POST['login'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $role = $_POST['role'] ?? 'CLIENT';
                $tel = trim($_POST['tel'] ?? '');
                $password = $_POST['password'] ?? '';

                // Validation des données
                if (strlen($login) < 4 || strlen($password) < 4) {
                    $this->redirectWithError('Le login et le mot de passe doivent contenir au moins 4 caractères.', 'register');
                }
                if (empty($prenom) || empty($nom) || empty($email) || empty($tel)) {
                    $this->redirectWithError('Tous les champs sont obligatoires.', 'register');
                }

                // Vérification de l'unicité du login
                $user = new User();
                $existingUser = $user->getByLogin($login);
                if ($existingUser) {
                    $this->redirectWithError('Ce login est déjà pris. Veuillez en choisir un autre.', 'register');
                }

                // Préparation des données
                $data = [
                    'civilite' => $civilite,
                    'prenom' => $prenom,
                    'nom' => $nom,
                    'login' => $login,
                    'email' => $email,
                    'role' => $role,
                    'tel' => $tel,
                    'mdp' => $password, // Stockage du mot de passe en clair (non sécurisé)
                ];

                // Ajout de l'utilisateur
                $user->add($data);

                // Redirection vers la page de connexion avec message de succès
                $this->redirectWithSuccess('Inscription réussie ! Veuillez vous connecter.', 'login');
            }

            // Affichage du formulaire d'inscription
            include 'PROJET/views/users/register.php';
        }

        // Connexion d'un utilisateur
        public function login()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $login = trim($_POST['login'] ?? '');
                $password = $_POST['password'] ?? '';

                // Validation des champs
                if (empty($login) || empty($password)) {
                    $this->redirectWithError('Login ou mot de passe manquant.', 'login');
                }

                // Récupération de l'utilisateur
                $user = new User();
                $userData = $user->getByLogin($login);

                if (!$userData) {
                    $this->redirectWithError('Utilisateur non trouvé. Vérifiez vos identifiants.', 'login');
                }

                // Vérification du mot de passe (sans hachage)
                if ($password === $userData->getPassword()) {
                    // Mot de passe correct
                    $_SESSION['user_id'] = $userData->getId();
                    $_SESSION['role'] = $userData->getRole();

                    // Redirection vers le tableau de bord
                    header('Location: ?page=reservations&action=create');
                    exit;
                } else {
                    $this->redirectWithError('Mot de passe incorrect.', 'login');
                }
            }

            // Affichage du formulaire de connexion
            include 'PROJET/views/users/login.php';
        }

        // Gestion des utilisateurs pour l'administrateur
        public function manageUsers()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Vérification du rôle
            if ($_SESSION['role'] !== 'ADMIN') {
                $this->redirectWithError('Accès interdit. Vous devez être administrateur.', 'dashboard');
            }

            // Récupération de tous les utilisateurs
            $user = new User();
            $users = $user->getAll();

            // Affichage de la vue de gestion des utilisateurs
            include 'PROJET/views/users/manage.php';
        }

        // Redirection avec un message d'erreur
        private function redirectWithError($message, $page)
        {
            $_SESSION['error'] = $message;
            header("Location: index.php?page=users&action=$page");
            exit;
        }

        // Redirection avec un message de succès
        private function redirectWithSuccess($message, $page)
        {
            $_SESSION['success'] = $message;
            header("Location: index.php?page=users&action=$page");
            exit;
        }
    }

    ?>
