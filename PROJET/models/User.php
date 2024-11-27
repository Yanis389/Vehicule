<?php

class User extends ModelGenerique
{
    private $id;
    private $civilite;
    private $prenom;
    private $nom;
    private $login;
    private $email;
    private $role;
    private $dateInscription;
    private $tel;
    private $password;

    // Constructeur pour initialiser l'utilisateur
    public function __construct(
        $id = null, 
        $civilite = null, 
        $prenom = null, 
        $nom = null, 
        $login = null, 
        $email = null, 
        $role = 'CLIENT', 
        $dateInscription = null, 
        $tel = null, 
        $password = null
    ) {
        parent::__construct();

        $this->id = $id;
        $this->civilite = $civilite;
        $this->prenom = trim($prenom ?? '');
        $this->nom = trim($nom ?? '');
        $this->login = trim($login ?? '');
        $this->email = trim($email ?? '');
        $this->role = $role;
        $this->dateInscription = $dateInscription;
        $this->tel = trim($tel ?? '');
        $this->password = $password;
    }

    // Méthode pour obtenir un utilisateur par son login
    public function getByLogin($login)
    {
        $login = trim($login);
        $query = "SELECT * FROM personne WHERE login = :login";

        $stmt = $this->executeReq($query, ['login' => $login]);
        $userData = $stmt->fetch();

        return $userData ? new self(
            $userData['id_personne'],
            $userData['civilite'],
            $userData['prenom'],
            $userData['nom'],
            $userData['login'],
            $userData['email'],
            $userData['role'],
            $userData['date_inscription'],
            $userData['tel'],
            $userData['mdp'] // Mot de passe en clair
        ) : null;
    }

    // Méthode pour ajouter un utilisateur
    public function add($data)
    {
        $data = array_map('trim', $data);

        $query = "INSERT INTO personne (civilite, prenom, nom, login, email, role, tel, mdp) 
                  VALUES (:civilite, :prenom, :nom, :login, :email, :role, :tel, :mdp)";

        return $this->executeReq($query, $data);
    }

    // Méthode pour authentifier un utilisateur
    public function authenticate($login, $passwordEntré)
    {
        $login = trim($login);
        $passwordEntré = trim($passwordEntré);

        // Récupérer l'utilisateur
        $user = $this->getByLogin($login);

        if (!$user) {
            throw new Exception("Utilisateur non trouvé.");
        }

        // Comparer les mots de passe (en clair)
        if ($passwordEntré !== $user->getPassword()) {
            throw new Exception("Mot de passe incorrect.");
        }

        return $user; // Retourner l'utilisateur en cas de succès
    }

    // Obtenir tous les utilisateurs
    public function getAll()
    {
        $query = "SELECT * FROM personne";
        $stmt = $this->executeReq($query);

        $users = [];
        while ($userData = $stmt->fetch()) {
            $users[] = new self(
                $userData['id_personne'], 
                $userData['civilite'],
                $userData['prenom'], 
                $userData['nom'], 
                $userData['login'], 
                $userData['email'], 
                $userData['role'], 
                $userData['date_inscription'], 
                $userData['tel'], 
                $userData['mdp']
            );
        }
        return $users;
    }

    // Supprimer un utilisateur par son ID
    public function delete($id)
    {
        $query = "DELETE FROM personne WHERE id_personne = :id";
        return $this->executeReq($query, ['id' => $id]);
    }

    // Getters pour les propriétés privées
    public function getId() { return $this->id; }
    public function getCivilite() { return $this->civilite; }
    public function getPrenom() { return $this->prenom; }
    public function getNom() { return $this->nom; }
    public function getLogin() { return $this->login; }
    public function getEmail() { return $this->email; }
    public function getRole() { return $this->role; }
    public function getDateInscription() { return $this->dateInscription; }
    public function getTel() { return $this->tel; }
    public function getPassword() { return $this->password; }
}
?>
