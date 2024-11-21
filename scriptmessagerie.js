
function retourAccueil(){
    window.location.href = "accueilMessagerie.html";
}

document.getElementById('postForm').addEventListener('submit', getName);

function getName(e){
    e.preventDefault();

    var name = document.getElementById('name1').value;
    var params = "name="+name;


    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'messageriephp.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        console.log(this.responseText);
        document.getElementById("name1").value = "";
    }

    xhr.send(params);
}


//document.getElementById('btn').addEventListener('click', load);
load();
setInterval(load,500);

function load(){
    const params = new URLSearchParams(window.location.search);
    const nomReceveur = params.get('nomReceveur');
    //console.log(nomReceveur);

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'loaddiscussion.php?nomReceveur=' + encodeURIComponent(nomReceveur), true);

    xhr.onload = function(){
        if(this.status == 200){
            var msg = JSON.parse(this.responseText);
            var output = '';
            
            for(var i in msg){ 
                output += 
                '<div class="txt">' + 
                    '<p>' + 
                        msg[i].contenu +
                    '</p>' + 
                "</div>" + '<br class="sautLigne"></br>';
            }

            document.getElementById('donnees').innerHTML = output;
        }
    }
    xhr.send();
}