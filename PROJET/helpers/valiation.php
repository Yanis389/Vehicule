<?php

// Fonction pour valider le formulaire d'inscription
function validateSignupForm($prenom, $login, $password) {
    $errors = [];

    // Vérification du prénom
    if (empty($prenom)) {
        $errors[] = 'Le prénom est obligatoire.';
    }

    // Vérification du login
    if (empty($login)) {
        $errors[] = 'Le login est obligatoire.';
    } elseif (strpos($login, ' ') !== false) {
        $errors[] = 'Le login ne doit pas contenir d\'espaces.';
    }

    // Vérification du mot de passe
    if (empty($password)) {
        $errors[] = 'Le mot de passe est obligatoire.';
    } elseif (strpos($password, ' ') !== false) {
        $errors[] = 'Le mot de passe ne doit pas contenir d\'espaces.';
    } elseif (strlen($password) < 4) {
        $errors[] = 'Le mot de passe doit comporter au moins 4 caractères.';
    }

    return $errors;
}

// Fonction pour valider un prix journalier de véhicule
function validatePrice($prix) {
    if ($prix < 100 || $prix > 350) {
        return 'Le prix journalier doit être compris entre 100 et 350.';
    }
    return null;
}

// Fonction pour valider le type de véhicule
function validateVehicleType($type) {
    $validTypes = ['voiture', 'camion', '2 roues'];
    if (!in_array(strtolower($type), $validTypes)) {
        return 'Le type de véhicule doit être "voiture", "camion" ou "2 roues".';
    }
    return null;
}

// Fonction pour valider les dates de réservation
function validateReservationDates($startDate, $endDate) {
    if (empty($startDate) || empty($endDate)) {
        return 'Les dates de début et de fin sont obligatoires.';
    }

    $start = new DateTime($startDate);
    $end = new DateTime($endDate);

    if ($end <= $start) {
        return 'La date de fin doit être après la date de début.';
    }
    return null;
}
