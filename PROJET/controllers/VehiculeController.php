<?php
class VehiculeController
{
    // Vérification de la connexion de l'utilisateur
    private function isUserConnected()
    {
        return isset($_SESSION['user_id']);
    }

    // Afficher la liste des véhicules
    public function listVehicules()
    {
        if (!$this->isUserConnected()) {
            $_SESSION['error'] = 'Vous devez être connecté pour accéder à la gestion des véhicules.';
            header('Location: /login');
            exit;
        }

        // Récupérer et afficher les véhicules
        $vehicules = (new Vehicule())->getAll();
        include 'PROJET/views/vehicules/list.php';
    }

    // Ajouter un véhicule
    public function addVehicule()
    {
        if (!$this->isUserConnected()) {
            $_SESSION['error'] = 'Vous devez être connecté pour ajouter un véhicule.';
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['matricule'])) {
                $_SESSION['error'] = 'Le matricule ne peut pas être vide.';
                header('Location: index.php?page=vehicules&action=add');
                exit;
            }

            // Collecte des données
            $data = [
                'marque' => $_POST['marque'] ?? '',
                'modele' => $_POST['modele'] ?? '',
                'matricule' => $_POST['matricule'],
                'type' => $_POST['type'] ?? '',
                'prix_journalier' => $_POST['prix_journalier'] ?? 0,
                'disponible' => $_POST['disponible'] ?? 1,
            ];

            // Ajouter le véhicule
            try {
                $vehicule = new Vehicule();
                $vehicule->add($data);

                $_SESSION['success'] = 'Véhicule ajouté avec succès!';
                header('Location: index.php?page=vehicules&action=list');
                exit;
            } catch (Exception $e) {
                $_SESSION['error'] = 'Erreur lors de l\'ajout du véhicule: ' . $e->getMessage();
                header('Location: index.php?page=vehicules&action=add');
                exit;
            }
        }

        include 'PROJET/views/vehicules/add.php';  // Formulaire d'ajout
    }

    // Modifier un véhicule
    public function updateVehicule($id)
    {
        if (!$this->isUserConnected()) {
            $_SESSION['error'] = 'Vous devez être connecté pour modifier un véhicule.';
            header('Location: /login');
            exit;
        }
    
        // Récupérer le véhicule à modifier
        $vehicule = (new Vehicule())->getById($id);
    
        if (!$vehicule) {
            $_SESSION['error'] = 'Véhicule introuvable.';
            header('Location: index.php?page=vehicules&action=list');
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifier les champs du formulaire
            if (empty($_POST['matricule'])) {
                $_SESSION['error'] = 'Le matricule ne peut pas être vide.';
                header('Location: index.php?page=vehicules&action=update&id=' . $id);
                exit;
            }
    
            // Gestion de la photo (si uploadée)
            $photo = $vehicule->getPhoto(); // Photo existante par défaut
            if (!empty($_FILES['photo']['name'])) {
                $photoName = $_FILES['photo']['name'];
                $photoTmp = $_FILES['photo']['tmp_name'];
                $photoError = $_FILES['photo']['error'];
    
                if ($photoError === UPLOAD_ERR_OK) {
                    $photoPath = 'path/to/photos/' . $photoName;
                    if (move_uploaded_file($photoTmp, $photoPath)) {
                        $photo = $photoName;
                    } else {
                        $_SESSION['error'] = 'Erreur lors de l\'upload de la photo.';
                        header('Location: index.php?page=vehicules&action=update&id=' . $id);
                        exit;
                    }
                }
            }
    
            // Récupérer les données du formulaire
            $data = [
                'marque' => $_POST['marque'],
                'modele' => $_POST['modele'],
                'matricule' => $_POST['matricule'],
                'type' => $_POST['type'],
                'prix_journalier' => $_POST['prix_journalier'],
                'disponible' => $_POST['disponible'],
                'photo' => $photo
            ];
    
            // Mettre à jour le véhicule
            try {
                $vehicule->update($data);
                $_SESSION['success'] = 'Véhicule mis à jour avec succès!';
                header('Location: index.php?page=vehicules&action=list');
                exit;
            } catch (Exception $e) {
                $_SESSION['error'] = 'Erreur lors de la modification du véhicule: ' . $e->getMessage();
                header('Location: index.php?page=vehicules&action=update&id=' . $id);
                exit;
            }
        }
    
        include 'PROJET/views/vehicules/edit.php';
    }
    

    public function deleteVehicule()
    {
        // Vérifier que l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Vous devez être connecté pour supprimer un véhicule.';
            header('Location: index.php?page=login');
            exit;
        }
    
        // Vérifier que l'ID du véhicule existe
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = (int) $_GET['id'];
    
            // Appeler la méthode delete du modèle Vehicule
            $vehicule = new Vehicule();
            $vehicule->delete($id);
    
            // Message de succès
            $_SESSION['success'] = 'Véhicule supprimé avec succès!';
        } else {
            $_SESSION['error'] = 'ID de véhicule invalide.';
        }
    
        // Redirection vers la page de la liste des véhicules
        header('Location: index.php?page=vehicules&action=list');
        exit;
    }
        // Récupérer les véhicules disponibles
        public function getAvailableVehicles()
        {
            // Récupérer tous les véhicules disponibles (non réservés)
            $vehicule = new Vehicule();
            return $vehicule->getAvailable();
        }
    
        // Mise à jour de la disponibilité d'un véhicule
        public function updateVehiculeAvailability($idVehicule, $disponible)
        {
            $vehicule = new Vehicule();
            $vehicule->updateAvailability($idVehicule, $disponible);
        }
}    
 
?>
