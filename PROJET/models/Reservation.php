<?php

class Reservation extends ModelGenerique
{
    private $id;
    private $idVehicule;
    private $idUser;
    private $dateDebut;
    private $dateFin;
    private $prixTotal;

    // Constructeur pour initialiser les propriétés
    public function __construct($id = null, $idVehicule = null, $idUser = null, $dateDebut = null, $dateFin = null, $prixTotal = null)
    {
        parent::__construct();  // Appel au constructeur de ModelGenerique
        if ($id !== null) {
            $this->id = $id;
            $this->idVehicule = $idVehicule;
            $this->idUser = $idUser;
            $this->dateDebut = $dateDebut;
            $this->dateFin = $dateFin;
            $this->prixTotal = $prixTotal;
        }
    }

    // Obtenir toutes les réservations
    public function getAll()
    {
        $query = "SELECT * FROM reservation";
        $stmt = $this->executeReq($query);
        $reservations = [];
        while ($data = $stmt->fetch()) {
            $reservations[] = new self($data['id_reservation'], $data['id_vehicule'], $data['id_personne'], $data['date_debut'], $data['date_fin'], $data['prix_total']);
        }
        return $reservations;
    }

    // Obtenir une réservation par ID
    public function getById($id)
    {
        $query = "SELECT * FROM reservation WHERE id_reservation = :id";
        $stmt = $this->executeReq($query, ['id' => $id]);
        $data = $stmt->fetch();
        if ($data) {
            return new self($data['id_reservation'], $data['id_vehicule'], $data['id_personne'], $data['date_debut'], $data['date_fin'], $data['prix_total']);
        }
        return null;
    }

    // Ajouter une réservation
    public function add($data)
    {
        $query = "INSERT INTO reservation (id_vehicule, id_personne, date_debut, date_fin, prix_total) 
                  VALUES (:idVehicule, :idUser, :dateDebut, :dateFin, :prixTotal)";
        return $this->executeReq($query, $data);
    }

    // Mettre à jour une réservation
    public function update($id, $data)
    {
        $query = "UPDATE reservation SET id_vehicule = :idVehicule, id_personne = :idUser, date_debut = :dateDebut, 
                  date_fin = :dateFin, prix_total = :prixTotal WHERE id_reservation = :id";
        $data['id'] = $id;
        return $this->executeReq($query, $data);
    }

    // Supprimer une réservation
    public function delete($id)
    {
        $query = "DELETE FROM reservation WHERE id_reservation = :id";
        return $this->executeReq($query, ['id' => $id]);
    }

    // Getters pour accéder aux données privées
    public function getId() { return $this->id; }
    public function getIdVehicule() { return $this->idVehicule; }
    public function getIdUser() { return $this->idUser; }
    public function getDateDebut() { return $this->dateDebut; }
    public function getDateFin() { return $this->dateFin; }
    public function getPrixTotal() { return $this->prixTotal; }
}
?>
