<?php
class Commentaire extends ModelGenerique
{
    private $id;
    private $idVehicule;
    private $idUser;
    private $note;
    private $commentaire;

    // Constructeur de la classe Commentaire
    public function __construct($id = null, $idVehicule = null, $idUser = null, $note = null, $commentaire = null)
    {
        parent::__construct(); // Appel du constructeur de ModelGenerique
        $this->id = $id;
        $this->idVehicule = $idVehicule;
        $this->idUser = $idUser;
        $this->note = $note;
        $this->commentaire = $commentaire;
    }

    // Récupérer tous les commentaires pour un véhicule donné
    public static function getByVehicule($vehiculeId)
    {
        $query = "SELECT * FROM commentaires WHERE id_vehicule = :idVehicule";
        $stmt = (new self())->executeReq($query, ['idVehicule' => $vehiculeId]);

        // Retourner les résultats sous forme d'objet Commentaire
        return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // Récupérer un commentaire par son ID
    public static function getById($id)
    {
        $query = "SELECT * FROM commentaires WHERE id = :id";
        $stmt = (new self())->executeReq($query, ['id' => $id]);

        // Retourner l'objet Commentaire correspondant
        return $stmt->fetchObject(self::class);
    }

    // Ajouter un commentaire dans la base de données
    public static function add($data)
    {
        $query = "INSERT INTO commentaires (id_vehicule, id_user, note, commentaire) 
                  VALUES (:idVehicule, :idUser, :note, :commentaire)";
        $stmt = (new self())->executeReq($query, $data);

        return $stmt;
    }

    // Supprimer un commentaire par son ID
    public static function delete($id)
    {
        $query = "DELETE FROM commentaires WHERE id = :id";
        $stmt = (new self())->executeReq($query, ['id' => $id]);

        return $stmt;
    }

    // Getters pour accéder aux propriétés du commentaire
    public function getId()
    {
        return $this->id;
    }

    public function getIdVehicule()
    {
        return $this->idVehicule;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function getCommentaire()
    {
        return $this->commentaire;
    }
}

?>
