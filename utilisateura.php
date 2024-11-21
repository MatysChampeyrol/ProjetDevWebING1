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

if($user_info['profil']=="utilisateur"){
    header("Location: utilisateurd.php");
    exit;
}


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles_utilisateura.css">
</head>
<body>
    <div id="container">
        <div id="banniere">
            <div id="menu">
                <nav>
                    <ul>
                        <li><a href="utilisateura">Découvrir</a></li>
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
                <img id="imagerencontre"src="Image/rencontrea.jpg">
            </div>
        </div>
        <div class="container">
            <h1>Que recherchez-vous?</h1>       
            <form action="#">

                <div class="form-group">
                    <label for="recherche">Rechercher</label>
                    <input type="text" id="recherche" name="q" placeholder="Rechercher...">
                </div>

                <div class="form-group">
                    <label for="genderSelect">Sélectionnez la situation :</label>
                    <select id="genderSelect" name="gender">
                        <option value="homme">Homme</option>
                        <option value="femme">Femme</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="genderSelect">Sélectionnez le genre :</label>
                    <select id="genderSelect" name="gender">
                        <option value="homme">Celibataire</option>
                        <option value="femme">Divorce</option>
                        <option value="autre">Veuf</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ageCategorySelect">Age Minimum-Maximum</label>
                    <input type="number" id="ageCategorySelect" name="ageMIN" step="1" min="18" value="18" required>
                    <input type="number" id="ageCategorySelect" name="ageMAX" step="1" min="18" value="18" required>
                </div>
                <button type="submit">Rechercher</button>
            </form>
        </div>
    </div> 
</body>
</html>
