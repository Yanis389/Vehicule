<?php

abstract class ModelGenerique {

    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=127.0.0.1;dbname=projet", "root", "", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Active les exceptions pour les erreurs PDO
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Définit le mode de récupération par défaut
            ]);
        } catch (PDOException $e) {
            // Affiche un message d'erreur si la connexion échoue
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    // Méthode pour récupérer l'utilisateur depuis la session
    public function user() {
        return isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;
    }

    // Méthode générique pour exécuter une requête préparée avec des données sécurisées
    public function executeReq(string $query, array $data = []) {
        $stmt = $this->pdo->prepare($query);

        // Échappe les données pour éviter les injections XSS
        foreach ($data as $cle => $valeur) {
            $data[$cle] = htmlentities($valeur);
        }

        $stmt->execute($data);
        return $stmt;
    }
}
