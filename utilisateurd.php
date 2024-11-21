<?php
session_start();

// Vérifier si l'utilisateur est connecté (s'il y a des informations utilisateur dans la session)
if (!isset($_SESSION['usager'])) {
    // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
    header("Location: login.php");
    exit;
}
// Utiliser les informations de l'utilisateur pour personnaliser la page d'accueil
$user_info = $_SESSION['usager'];

if($user_info['profil']=="abonne"){
    header("Location: utilisateura.php");
    exit;
}


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles_utilisateur.css">
</head>
<body>
    <div id="container">
        <div id="banniere">
            <div id="menu">
                <nav>
                    <ul>
                        <li><a href="#utilisateurd.php">Découvrir</a></li>
                        <li><a href="abonnement.php">Messagerie</a></li>
                        <li><a href="profil.php">Profil</a></li>
                        <li><a href="abonnement.php">Abonnement</a></li>
                        
                    </ul>
                </nav>
            </div>
            <div id="image1">
                <img src="Image/coeur.png">
            </div>
            <div class="content">
                <img id="imagerencontre"src="Image/utilisateurrencontre2">
            </div>
        </div>
        <div class="container">
            <h1>Que recherchez-vous?</h1>       
            <form action="afficher_profil.php" method="post">

                <div class="form-group">
                    <label for="recherche">Rechercher</label>
                    <input type="text" id="recherche" name="recherche" placeholder="Rechercher...">
                </div>

                <div class="form-group">
                    <label for="genderSelect">Sélectionnez le genre :</label>
                    <select class="genderSelect" name="sexe">
                        <option value="">Sélectionnez une option</option>
                        <option value="homme">Homme</option>
                        <option value="femme">Femme</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="genderSelect">Sélectionnez la situation :</label>
                    <select class="genderSelect" name="situation">
                        <option value="">Sélectionnez une option</option>
                        <option value="celibataire">Célibataire</option>
                        <option value="divorce">Divorcé(e)</option>
                        <option value="veuf">Veuf(ve)</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="ageCategorySelect">Age Minimum-Maximum</label>
                    <input type="number" class="ageCategorySelect" name="ageMIN" step="1" min="18" value="18" required>
                    <input type="number" class="ageCategorySelect" name="ageMAX" step="1" min="18" value="18" required>
                </div>
                <button type="submit" name="submit">Rechercher</button>
            </form>
        </div>
        <div class="banner">
            <a href="abonnement.php" class="premium-offer">
                <h2>Passer à l'offre Premium</h2>
                <p>Messagerie privée</p>
                <p>Voir qui a liké votre profil</p>
            </a>
        </div>
    </div> 
</body>
</html>
