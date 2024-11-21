<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venus - swipe</title>
    <link rel="stylesheet" href="styleSwipe.css">
</head>
<script>
    function valide(){
        var container = document.getElementById("containerSwipe");
        container.style.left = '200%';

        setTimeout(function() {
            // Revenir au centre
            container.style.left = '50%';
            container.style.transform = 'translate(-50%, -50%)';
        }, 1000); // 1000 millisecondes = 1 seconde
    }
    function nonValide(){
        var container = document.getElementById("containerSwipe");
        container.style.left = '-100%';

        // Attendre un court instant (par exemple, 1 seconde)
        setTimeout(function() {
            // Revenir au centre
            container.style.left = '50%';
            container.style.transform = 'translate(-50%, -50%)';
        }, 1000); // 1000 millisecondes = 1 seconde
    }
</script>
<body>
    <div id="containerSwipe">
        <div id="galeriePretendant">
            <h1 id="prenom"> C</h1>
            <img id="photoPretendant" src ="Image/photo1.jpg"></img>
            <img id="photoPretendant" src ="Image/photo2.jpg"></img>
            <img id="photoPretendant" src ="Image/photo3.jpg"></img>

        </div> 
        <div id="descriptionPersonne">
            <h1>Clothilde</h1>
            <section id="hobies">
                <h1>HOBBIES</h1>
                <h3>fume</h3>
                <h3>yeux bleux</h3>
            </section>
            <section id="description"> 
                <h1> Description </h1>
                <h3>J'adore manger des pommes et danser et fumer des fois, j'adore aussi faire des trucs et parler et blablablablablablablablablalblablabla +1 si t'aime latifi</h3>
            <section>
        </div>
    </div>
    <div id="boutonSwipe">
        <button id="oui"><img id="ouiImg" src="Image/oui.png" onclick="valide()"></button>
        <button id="non"><img id="nonImg" src="Image/non.png" onclick="nonValide()"></button>
    </div>
    <footer>
        <div class="footer-nav">
                <ul>
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
        </div>
        <div class="copyright">
            <p>&copy; 2024 Site de Rencontre - Tous droits réservés</p>
        </div>

    </footer>
</body>
</html>