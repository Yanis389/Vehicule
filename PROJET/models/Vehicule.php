<?php

class Vehicule extends ModelGenerique
{
    private $id;
    private $marque;
    private $modele;
    private $immatriculation;
    private $type;
    private $prixJournalier;
    private $disponible;
    private $photo;
    private $reservations; // Stocker les réservations liées à ce véhicule

    // Constructeur pour initialiser les propriétés du véhicule
    public function __construct($id = null, $marque = null, $modele = null, $immatriculation = null, $type = null, $prixJournalier = null, $disponible = null, $photo = null, $reservations = [])
    {
        parent::__construct();  // Appel au constructeur de ModelGenerique
        if ($id !== null) {
            $this->id = $id;
            $this->marque = $marque;
            $this->modele = $modele;
            $this->immatriculation = $immatriculation;
            $this->type = $type;
            $this->prixJournalier = $prixJournalier;
            $this->disponible = $disponible;
            $this->photo = $photo;
            $this->reservations = $reservations;
        }
    }

    // Obtenir tous les véhicules
    public function getAll()
    {
        $query = "SELECT * FROM vehicules";
        $stmt = $this->executeReq($query);
        $vehicules = [];
        while ($data = $stmt->fetch()) {
            $vehicules[] = new self(
                $data['id_vehicule'], 
                $data['marque'], 
                $data['modele'], 
                $data['immatriculation'], 
                $data['type'], 
                $data['prix_journalier'], 
                $data['statut_dispo'], 
                $data['photo']
            );
        }
        return $vehicules;
    }

    // Obtenir un véhicule par son ID
    public function getById($id)
    {
        $query = "SELECT * FROM vehicules WHERE id_vehicule = :id";
        $stmt = $this->executeReq($query, ['id' => $id]);
        $data = $stmt->fetch();
        if ($data) {
            return new self(
                $data['id_vehicule'], 
                $data['marque'], 
                $data['modele'], 
                $data['immatriculation'], 
                $data['type'], 
                $data['prix_journalier'], 
                $data['statut_dispo'], 
                $data['photo']
            );
        }
        return null;
    }

    // Ajouter un véhicule
    public function add($data)
    {
        $query = "INSERT INTO vehicules (marque, modele, immatriculation, type, prix_journalier, statut_dispo, photo) 
                  VALUES (:marque, :modele, :immatriculation, :type, :prix_journalier, :statut_dispo, :photo)";
        return $this->executeReq($query, $data);
    }

    // Mettre à jour un véhicule
    public function update($id, $data)
    {
        $query = "UPDATE vehicules SET marque = :marque, modele = :modele, immatriculation = :immatriculation, 
                  type = :type, prix_journalier = :prix_journalier, statut_dispo = :statut_dispo, photo = :photo 
                  WHERE id_vehicule = :id";
        $data['id'] = $id;
        return $this->executeReq($query, $data);
    }

    // Supprimer un véhicule
    public function delete($id)
    {
        $query = "DELETE FROM vehicules WHERE id_vehicule = :id";
        return $this->executeReq($query, ['id' => $id]);
    }

    // Récupérer les véhicules disponibles
    public function getAvailable()
    {
        $query = "SELECT * FROM vehicules WHERE statut_dispo = 1";  // statut_dispo = 1 signifie disponible
        $stmt = $this->executeReq($query);
        $vehicules = [];
        while ($data = $stmt->fetch()) {
            $vehicules[] = new self(
                $data['id_vehicule'], 
                $data['marque'], 
                $data['modele'], 
                $data['immatriculation'], 
                $data['type'], 
                $data['prix_journalier'], 
                $data['statut_dispo'], 
                $data['photo']
            );
        }
        return $vehicules;
    }

    // Filtrer les véhicules par marque, modèle ou type
    public function filter($criteria)
    {
        $query = "SELECT * FROM vehicules WHERE marque LIKE :criteria OR modele LIKE :criteria OR type LIKE :criteria";
        $stmt = $this->executeReq($query, ['criteria' => '%' . $criteria . '%']);
        $vehicules = [];
        while ($data = $stmt->fetch()) {
            $vehicules[] = new self(
                $data['id_vehicule'], 
                $data['marque'], 
                $data['modele'], 
                $data['immatriculation'], 
                $data['type'], 
                $data['prix_journalier'], 
                $data['statut_dispo'], 
                $data['photo']
            );
        }
        return $vehicules;
    }

    // Obtenir les réservations liées à ce véhicule
    public function getReservations()
    {
        // On suppose qu'il existe une table `reservation` avec une relation entre véhicule et réservation
        $query = "SELECT * FROM reservation WHERE id_vehicule = :id_vehicule";
        $stmt = $this->executeReq($query, ['id_vehicule' => $this->id]);
        $reservations = [];
        while ($data = $stmt->fetch()) {
            $reservations[] = new Reservation($data['id_reservation'], $data['id_vehicule'], $data['id_personne'], $data['date_debut'], $data['date_fin']);
        }
        return $reservations;
    }

    // Getters pour les propriétés privées
    public function getId() { return $this->id; }
    public function getMarque() { return $this->marque; }
    public function getModele() { return $this->modele; }
    public function getImmatriculation() { return $this->immatriculation; }
    public function getType() { return $this->type; }
    public function getPrixJournalier() { return $this->prixJournalier; }
    public function getDisponible() { return $this->disponible; }
    public function getPhoto() { return $this->photo; }
}

?>
