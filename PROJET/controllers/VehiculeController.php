<?php

class VehiculeController
{
    // Afficher les véhicules disponibles
    public function listVehicules()
    {
        // Appel à la méthode pour obtenir tous les véhicules
        $vehicules = (new Vehicule())->getAll();

        // Inclure la vue pour afficher les véhicules
        include './views/vehicules/list.php';  // Vue des véhicules
    }

    // Ajouter un véhicule
    public function addVehicule()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Collecte des données envoyées via POST
            $data = [
                'marque' => $_POST['marque'],
                'modele' => $_POST['modele'],
                'immatriculation' => $_POST['immatriculation'],
                'type' => $_POST['type'],
                'prix_journalier' => $_POST['prix_journalier'],
                'disponible' => $_POST['disponible'],
                'photo' => $_POST['photo'],
            ];

            // Appel à la méthode d'ajout du véhicule
            $vehicule = new Vehicule();
            $vehicule->add($data);

            // Redirection vers la page des véhicules
            header('Location: /vehicules');
            exit;
        }

        // Affichage du formulaire d'ajout de véhicule
        include './views/vehicules/add.php';  // Formulaire d'ajout de véhicule
    }

    // Modifier un véhicule
    public function updateVehicule($id)
    {
        // Récupération du véhicule à modifier
        $vehicule = (new Vehicule())->getById($id);

        // Si la requête est en méthode POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Collecte des données envoyées via POST
            $data = [
                'marque' => $_POST['marque'],
                'modele' => $_POST['modele'],
                'immatriculation' => $_POST['immatriculation'],
                'type' => $_POST['type'],
                'prix_journalier' => $_POST['prix_journalier'],
                'disponible' => $_POST['disponible'],
                'photo' => $_POST['photo'],
            ];

            // Appel à la méthode de mise à jour du véhicule
            $vehicule->update($id, $data);

            // Redirection vers la page des véhicules
            header('Location: /vehicules');
            exit;
        }

        // Affichage du formulaire de modification de véhicule
        include './views/vehicules/edit.php'; // Formulaire de modification de véhicule
    }

    // Supprimer un véhicule
    public function deleteVehicule($id)
    {
        // Appel à la méthode de suppression du véhicule
        $vehicule = new Vehicule();
        $vehicule->delete($id);

        // Redirection vers la page des véhicules
        header('Location: /vehicules');
        exit;
    }

    // Mettre à jour la disponibilité du véhicule
    public function updateVehiculeAvailability($id, $disponible)
    {
        // Appel à la méthode pour mettre à jour la disponibilité
        $vehicule = new Vehicule();
        $vehicule->update($id, ['disponible' => $disponible]);
    }
}

?>
