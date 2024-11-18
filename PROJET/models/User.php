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
    public function __construct($id = null, $civilite = null, $prenom = null, $nom = null, $login = null, $email = null, $role = 'CLIENT', $dateInscription = null, $tel = null, $password = null)
    {
        parent::__construct();  // Appel au constructeur de ModelGenerique

        if ($id !== null) {
            $this->id = $id;
            $this->civilite = $civilite;
            $this->prenom = $prenom;
            $this->nom = $nom;
            $this->login = $login;
            $this->email = $email;
            $this->role = $role;
            $this->dateInscription = $dateInscription;
            $this->tel = $tel;
            $this->password = $password;
        }
    }

    // Méthode pour obtenir un utilisateur par son login
    public function getByLogin($login)
    {
        $query = "SELECT * FROM personne WHERE login = :login";
        $stmt = $this->executeReq($query, ['login' => $login]);

        $userData = $stmt->fetch();
        if ($userData) {
            return new self(
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
        return null;
    }

    // Ajouter un utilisateur
    public function add($data)
    {
        $query = "INSERT INTO personne (civilite, prenom, nom, login, email, role, tel, mdp) 
                  VALUES (:civilite, :prenom, :nom, :login, :email, :role, :tel, :mdp)";
        
        // Hashing du mot de passe
        $data['mdp'] = password_hash($data['mdp'], PASSWORD_DEFAULT);

        return $this->executeReq($query, $data);
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
