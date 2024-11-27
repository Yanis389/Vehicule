<?php

require_once 'PROJET/models/ModelGenerique.php';

class Vehicule extends ModelGenerique
{
    private $id;
    private $marque;
    private $modele;
    private $matricule;
    private $type;
    private $prixJournalier;
    private $disponible;
    private $photo;
    private $reservations;

    public function __construct(
        $id = null, 
        $marque = null, 
        $modele = null, 
        $matricule = null, 
        $type = null, 
        $prixJournalier = null, 
        $disponible = null, 
        $photo = null, 
        $reservations = []
    ) {
        parent::__construct();
        if ($id !== null) {
            $this->id = $id;
            $this->marque = $marque;
            $this->modele = $modele;
            $this->matricule = $matricule;
            $this->type = $type;
            $this->prixJournalier = $prixJournalier;
            $this->disponible = $disponible;
            $this->photo = $photo;
            $this->reservations = $reservations;
        }
    }

    // Récupérer tous les véhicules
    public function getAll()
    {
        $query = "SELECT * FROM vehicule";
        $stmt = $this->executeReq($query);

        $vehicules = [];
        while ($vehiculeData = $stmt->fetch()) {
            $vehicules[] = new self(
                $vehiculeData['id_vehicule'],
                $vehiculeData['marque'],
                $vehiculeData['modele'],
                $vehiculeData['matricule'],
                $vehiculeData['type_vehicule'],
                $vehiculeData['prix_journalier'],
                $vehiculeData['statut_dispo'],
                $vehiculeData['photo']
            );
        }
        return $vehicules;
    }

    // Récupérer un véhicule par son ID
    public function getById($id)
    {
        $query = "SELECT * FROM vehicule WHERE id_vehicule = :id";
        $stmt = $this->executeReq($query, ['id' => $id]);

        $vehiculeData = $stmt->fetch();
        if ($vehiculeData) {
            return new self(
                $vehiculeData['id_vehicule'],
                $vehiculeData['marque'],
                $vehiculeData['modele'],
                $vehiculeData['matricule'],
                $vehiculeData['type_vehicule'],
                $vehiculeData['prix_journalier'],
                $vehiculeData['statut_dispo'],
                $vehiculeData['photo']
            );
        }
        return null;
    }

    // Ajouter un véhicule
    public function add($data)
    {
        $query = "INSERT INTO vehicule (marque, modele, matricule, type_vehicule, prix_journalier, statut_dispo, photo) 
                  VALUES (:marque, :modele, :matricule, :type_vehicule, :prix_journalier, :statut_dispo, :photo)";

        return $this->executeReq($query, [
            'marque' => $data['marque'],
            'modele' => $data['modele'],
            'matricule' => $data['matricule'],
            'type_vehicule' => $data['type'],
            'prix_journalier' => $data['prix_journalier'],
            'statut_dispo' => $data['disponible'],
            'photo' => $data['photo']
        ]);
    }

    // Mettre à jour un véhicule
    public function update($data)
    {
        $query = "UPDATE vehicule 
                  SET marque = :marque, modele = :modele, matricule = :matricule, 
                      type_vehicule = :type_vehicule, prix_journalier = :prix_journalier, 
                      statut_dispo = :statut_dispo, photo = :photo 
                  WHERE id_vehicule = :id";

        return $this->executeReq($query, [
            'id' => $data['id'],
            'marque' => $data['marque'],
            'modele' => $data['modele'],
            'matricule' => $data['matricule'],
            'type_vehicule' => $data['type'],
            'prix_journalier' => $data['prix_journalier'],
            'statut_dispo' => $data['disponible'],
            'photo' => $data['photo']
        ]);
    }

    // Supprimer un véhicule
    public function delete($id)
    {
        $query = "DELETE FROM vehicule WHERE id_vehicule = :id";
        return $this->executeReq($query, ['id' => $id]);
    }

    // Récupérer les véhicules disponibles
    public function getAvailable()
    {
        $query = "SELECT * FROM vehicule WHERE statut_dispo = 1";
        $stmt = $this->executeReq($query);
        $vehicules = [];
        while ($vehiculeData = $stmt->fetch()) {
            $vehicules[] = new self(
                $vehiculeData['id_vehicule'],
                $vehiculeData['marque'],
                $vehiculeData['modele'],
                $vehiculeData['matricule'],
                $vehiculeData['type_vehicule'],
                $vehiculeData['prix_journalier'],
                $vehiculeData['statut_dispo'],
                $vehiculeData['photo']
            );
        }
        return $vehicules;
    }

    // Mettre à jour la disponibilité d'un véhicule
    public function updateAvailability($id, $disponible)
    {
        $query = "UPDATE vehicule SET statut_dispo = :statut_dispo WHERE id_vehicule = :id";
        return $this->executeReq($query, ['id' => $id, 'statut_dispo' => $disponible]);
    }

    // Getters pour les propriétés privées
    public function getId() { return $this->id; }
    public function getMarque() { return $this->marque; }
    public function getModele() { return $this->modele; }
    public function getMatricule() { return $this->matricule; }
    public function getType() { return $this->type; }
    public function getPrixJournalier() { return $this->prixJournalier; }
    public function getDisponible() { return $this->disponible; }
    public function getPhoto() { return $this->photo; }
    public function getReservations() { return $this->reservations; }
}
