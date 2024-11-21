

//document.getElementById('btn').addEventListener('click', load);

load();
setInterval(load,500);

function load(){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'anciensmsg.php', true);

    xhr.onload = function(){
        if(this.status == 200){
            var msg = JSON.parse(this.responseText);
            var output = '';
            var expeditors = []; // Tableau pour stocker les expéditeurs déjà rencontrés
            
            for(var i in msg) {
                // Vérifie si l'expéditeur actuel est déjà dans le tableau
                if (expeditors.indexOf(msg[i].id_expediteur) === -1 ) {
                    output += 
                    '<a href="messagerie.html" class="' + msg[i].id_receveur + '">' +
                        '<div class="discussion"' + msg[i].id_receveur + '>' + 
                            '<p>' + 
                            msg[i].id_expediteur +
                            //go rajouter la photo aussi
                            '</p>' + 
                        "</div>" + 
                    '</a>';
                    expeditors.push(msg[i].id_expediteur);
                }
            }

            document.getElementById('donnees').innerHTML = output;
        }
    }
    xhr.send();
}

const liens = document.querySelectorAll('a');

liens.forEach(lien => {
    lien.addEventListener('click', function(){
        $_SESSION['usager']['receveur'] = ""+this.getAttribute('class');
        //window.open('', '_blank');
    });
});