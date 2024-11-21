
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venuse</title>
    <link rel="icon" href="Image/Logo.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="stylesheetLog.css" />
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
            <div id="inscription">
                <button><a href="register.php">S'inscrire</a></button>
            </div>
        </div>
        <div class="content">
            <img id="imagerencontre"src="Image/rencontre1.png">
        </div>
        <div id="main">
            <div class="container2" id="container2">
                <div class="form-container se-connecter">
                    <form action="verificationconnexion.php" method="post">
                        <h1>Se connecter</h1>
                            <input type="text" name="login" placeholder="Login" required>
                            <input type="password" name="mdp" placeholder="Mot de passe" required>
                            <div id="connection">
                                <button>Se connecter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>   
</body>
</html>
