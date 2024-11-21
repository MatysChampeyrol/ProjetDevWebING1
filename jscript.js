document.getElementById('postForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var message = document.getElementById('message').value;
    var expediteur = document.getElementById('expediteur').value;
    var destinataire = document.getElementById('destinataire').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'send_message.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status == 200) {
            loadMessages();
        }
    };
    xhr.send('expediteur=' + encodeURIComponent(expediteur) + '&destinataire=' + encodeURIComponent(destinataire) + '&message=' + encodeURIComponent(message));
});

function loadMessages() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'load_message.php', true);
    xhr.onload = function() {
        if (this.status == 200) {
            var messages = JSON.parse(this.responseText);
            displayMessages(messages);
            scrollToBottom(); // Appel de la fonction de défilement vers le bas une fois que les messages sont chargés
        }
    };
    xhr.send();
}

function scrollToBottom() {
    var messageBox = document.querySelector('.message-box');
    if (messageBox) {
        messageBox.scrollTop = messageBox.scrollHeight;
    }
}


function displayMessages(messages) {
    var messageBox = document.querySelector('.message-box');
    messageBox.innerHTML = '';
    messages.reverse(); // Inverse l'ordre des messages pour afficher les plus récents en haut
    messages.forEach(function(message) {
        var div = document.createElement('div');
        div.className = 'message';
        if (message.expediteur === "<?php echo $destinataire; ?>") {
            div.classList.add('receiver');
            div.textContent = message.expediteur + ': ' + message.contenu;
        } else {
            div.classList.add('sender');
            div.textContent = message.contenu + ': ' + message.expediteur;
        }
        messageBox.appendChild(div);
    });
}


window.onload = function() {
    var messageBox = document.querySelector('.message-box');
    if (messageBox) {
        messageBox.scrollTop = messageBox.scrollHeight;
    }
}

// function displayMessages(messages) {
//     var messageBox = document.querySelector('.conversation');
//     messageBox.innerHTML = ''; // Vide la boîte de messages existante
//     messages.reverse(); // Inverse l'ordre des messages pour afficher les plus récents en haut
//     messages.forEach(function(message) {
//         var div = document.createElement('div');
//         div.className = 'message';
//         if (message.expediteur === "<?php echo $destinataire; ?>") { // Si le message vient du destinataire
//             div.classList.add('receiver'); // Ajoute la classe receiver pour l'alignement à droite
//         } else { // Si le message vient de l'expéditeur
//             div.classList.add('sender'); // Ajoute la classe sender pour l'alignement à gauche
//         }
//         var messageText = document.createTextNode(message.expediteur + ': ' + message.contenu);
//         div.appendChild(messageText); // Ajoute le texte du message à l'élément div
//         messageBox.appendChild(div);
//     });
// }


window.onload = function() {
    loadMessages(); // Charger les messages au chargement de la page
}
