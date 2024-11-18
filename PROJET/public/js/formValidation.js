// Fonction pour valider le formulaire d'inscription
function validateSignupForm() {
    const prenom = document.getElementById('prenom').value.trim();
    const login = document.getElementById('login').value.trim();
    const password = document.getElementById('password').value.trim();

    let isValid = true;
    let errorMessage = '';

    // Vérification du prénom (ne peut pas être vide)
    if (prenom === '') {
        isValid = false;
        errorMessage += 'Le prénom est obligatoire.\n';
    }

    // Vérification du login (ne doit pas contenir d'espaces et doit être non vide)
    if (login === '' || login.includes(' ')) {
        isValid = false;
        errorMessage += 'Le login est obligatoire et ne doit pas contenir d\'espaces.\n';
    }

    // Vérification du mot de passe (ne doit pas contenir d'espaces et longueur minimale de 4 caractères)
    if (password === '' || password.includes(' ') || password.length < 4) {
        isValid = false;
        errorMessage += 'Le mot de passe est obligatoire, ne doit pas contenir d\'espaces et doit comporter au moins 4 caractères.\n';
    }

    // Affichage des messages d'erreur si le formulaire n'est pas valide
    if (!isValid) {
        alert(errorMessage);
    }

    return isValid;
}

// Fonction pour valider le formulaire de gestion des véhicules
function validateVehicleForm() {
    const prixJournalier = document.getElementById('prix_journalier').value.trim();
    const typeVehicule = document.getElementById('type_vehicule').value.trim();

    let isValid = true;
    let errorMessage = '';

    // Vérification du prix journalier (doit être compris entre 100 et 350)
    if (prixJournalier === '' || isNaN(prixJournalier) || prixJournalier < 100 || prixJournalier > 350) {
        isValid = false;
        errorMessage += 'Le prix journalier doit être compris entre 100 et 350.\n';
    }

    // Vérification du type de véhicule (obligatoire)
    if (typeVehicule === '' || !['voiture', 'camion', '2 roues'].includes(typeVehicule.toLowerCase())) {
        isValid = false;
        errorMessage += 'Le type de véhicule est obligatoire et doit être "voiture", "camion" ou "2 roues".\n';
    }

    // Affichage des messages d'erreur si le formulaire n'est pas valide
    if (!isValid) {
        alert(errorMessage);
    }

    return isValid;
}

// Fonction pour confirmer la suppression d'un véhicule
function confirmDeleteVehicle() {
    return confirm("Êtes-vous sûr de vouloir supprimer ce véhicule ?");
}

// Fonction pour valider le formulaire de réservation
function validateReservationForm() {
    const startDate = document.getElementById('start_date').value;
    const endDate = document.getElementById('end_date').value;

    if (startDate && endDate) {
        const start = new Date(startDate);
        const end = new Date(endDate);

        // Vérification que la date de fin est supérieure à la date de début
        if (end <= start) {
            alert('La date de fin doit être après la date de début.');
            return false;
        }
    }
    return true;
}

// Ajouter des gestionnaires d'événements pour les formulaires
document.getElementById('signupForm')?.addEventListener('submit', function(event) {
    if (!validateSignupForm()) {
        event.preventDefault(); // Empêcher la soumission du formulaire si les validations échouent
    }
});

document.getElementById('vehicleForm')?.addEventListener('submit', function(event) {
    if (!validateVehicleForm()) {
        event.preventDefault(); // Empêcher la soumission du formulaire si les validations échouent
    }
});

document.getElementById('reservationForm')?.addEventListener('submit', function(event) {
    if (!validateReservationForm()) {
        event.preventDefault(); // Empêcher la soumission du formulaire si la validation des dates échoue
    }
});

// Gestion de la suppression du véhicule
const deleteButtons = document.querySelectorAll('.delete-vehicle');
deleteButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        if (!confirmDeleteVehicle()) {
            event.preventDefault(); // Annuler la suppression si l'utilisateur annule la confirmation
        }
    });
});
