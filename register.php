<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venuse</title>
    <link rel="icon" href="Image/Logo.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="stylesheetREG.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
</head>
<body>
    
<div id="container">
        <div id="banniere">
            <div id="menu">
                <nav>
                  <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="#">Profils</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">A propos</a></li>
                  </ul>
                </nav>
            </div>
            <div id="image1">
                <img src="Image/coeur.png">
            </div>
            <div id="connection">
                <button><a href="login.php">Se connecter</a></button>
            </div>
        <div class="content">
            <img id="imagerencontre"src="Image/rencontre1.png">
        </div>
        <div id="main">
                <div class="container2" id="container2">
                    <div class="form-container créer-compte">
                        <form action="verificationregister.php" method="post">
                            <h1>Inscription</h1>
                            <input type="text" name="nom" placeholder="Nom" required>
                            <input type="text" name="prenom" placeholder="Prenom" required>
                            <input type="text" name="login" placeholder="Pseudonyme" required>
                            <input type="date" name="ddn" placeholder="Date de naissance" required>
                            <div class="genre-selector">
                                <input type="radio" id="genre_homme" name="sexe" value="homme" checked>
                                <label for="genre_homme" class="genre-label">• Homme</label><br>

                                <input type="radio" id="genre_femme" name="sexe" value="femme">
                                <label for="genre_femme" class="genre-label">• Femme</label><br>

                                <input type="radio" id="genre_autre" name="sexe" value="autre">
                                <label for="genre_autre" class="genre-label">• Autre</label><br>
                            </div>
                            <input type="password" name="mdp" placeholder="Mot de passe" required>
                            <div id="creation">
                                <input type="submit" name="submit" value="S'inscrire" >
                            </div>
                            <p>Déjà un compte ? <a href="login.php">Connectez-vous ici</a>.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>   
</body>
</html>