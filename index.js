function showAdditionalInfo(login) {
    var modalBackground = document.getElementById('modal-background');
    var modalInfo = document.getElementById('modal-info');
    
    // Récupération des informations cachées et leur affichage dans la bulle modale
    var additionalInfo = document.getElementById('additional-info-' + login).innerHTML;
    modalInfo.innerHTML = additionalInfo;
    
    modalBackground.style.display = 'block'; // Affichage de la bulle modale
}

function hideAdditionalInfo() {
    var modalBackground = document.getElementById('modal-background');
    modalBackground.style.display = 'none'; // Masquage de la bulle modale
    var modalInfo = document.getElementById('modal-info');
    modalInfo.innerHTML = ''; // Nettoyage de la bulle modale
}

// Fonction pour reporter un utilisateur
// function reportUser(login) {
//     // Rediriger vers la page de signalement avec le nom d'utilisateur en paramètre
//     window.location.href = 'signalement.php?user=' + encodeURIComponent(login);
// }

// Fonction pour envoyer un message à un utilisateur
function envoyerMessage(expediteur, destinataire) {
    // Rediriger vers la page de messagerie avec l'expéditeur et le destinataire en paramètres
    window.location.href = 'messagerie.php?expediteur=' + encodeURIComponent(expediteur) + '&destinataire=' + encodeURIComponent(destinataire);
}


function showSignalementForm(login) {
    var signalementModalBackground = document.getElementById('signalement-modal-background');
    var signalementModalInfo = document.getElementById('signalement-modal-info');

    // Récupération du contenu du formulaire de signalement et affichage dans le modal
    var signalementFormContent = document.getElementById('signalement-form-' + login).innerHTML;
    signalementModalInfo.innerHTML = signalementFormContent;

    signalementModalBackground.style.display = 'block'; // Affichage du modal de signalement
}

function hideSignalementForm() {
    var signalementModalBackground = document.getElementById('signalement-modal-background');
    signalementModalBackground.style.display = 'none';
}


