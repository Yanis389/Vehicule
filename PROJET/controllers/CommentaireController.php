<?php
class CommentaireController
{
    // Afficher les commentaires pour un véhicule donné
    public function listCommentaires($vehiculeId)
    {
        // Récupère tous les commentaires pour le véhicule spécifique
        $commentaires = Commentaire::getByVehicule($vehiculeId);

        // Inclut la vue pour afficher les commentaires du véhicule
        include 'PROJET/views/commentaires/list.php'; 
    }

    // Ajouter un commentaire pour un véhicule
    public function addCommentaire()
    {
        // Vérifie si la requête est de type POST (soumission du formulaire)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupère les données soumises par le formulaire
            $vehiculeId = $_POST['vehicule_id'];    // ID du véhicule
            $userId = $_SESSION['user_id'];          // ID de l'utilisateur connecté
            $note = $_POST['note'];                  // Note donnée au véhicule
            $commentaire = $_POST['commentaire'];    // Commentaire texte

            // Valide que la note est un nombre entre 1 et 5
            if ($note < 1 || $note > 5) {
                die('La note doit être comprise entre 1 et 5.');
            }

            // Prépare les données à insérer dans la table "commentaires"
            $data = [
                'idVehicule' => $vehiculeId,
                'idUser' => $userId,
                'note' => $note,
                'commentaire' => $commentaire,
            ];

            // Insère le commentaire dans la base de données
            Commentaire::add($data);

            // Redirige l'utilisateur vers la page du véhicule avec les commentaires
            header('Location: /vehicules/details?id=' . $vehiculeId);
            exit;
        }

        // Si la méthode n'est pas POST, on affiche le formulaire pour ajouter un commentaire
        include 'PROJET/views/commentaires/create.php'; // Formulaire d'ajout de commentaire
    }

    // Supprimer un commentaire existant
    public function deleteCommentaire($id)
    {
        // Récupère le commentaire à supprimer
        $commentaire = Commentaire::getById($id);

        // Si le commentaire existe, on le supprime
        if ($commentaire) {
            Commentaire::delete($id);
        }

        // Redirige l'utilisateur vers la page de détails du véhicule après la suppression
        header('Location: /vehicules/details?id=' . $commentaire->getIdVehicule());
        exit;
    }
}
?>