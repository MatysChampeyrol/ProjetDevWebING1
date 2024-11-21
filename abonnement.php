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
if($user_info['profil']=="admin"){
    header("Location: utilisateura.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnement</title>
    <link rel="stylesheet" href="style_abo.css">
</head>
<body>
    <div id="container">
        <div id="banniere">
            <div id="menu">
                <nav>
                    <ul>
                        <li><a href="utilisateurd.php">Découvrir</a></li>
                        <li><a href="#">Messagerie</a></li>
                        <li><a href="#">Profil</a></li>
                        <li><a href="#">Abonnement</a></li>
                    </ul>
                </nav>
            </div>
            <div id="image1">
                <img src="Image/coeur.png">
            </div>
    <div class="containerabo">
        <div class="half left">
            <img id="imageabo" img src="Image/image_abo.jpeg" >
        </div>
        <div class="half right">
            <h1><B>Offre Premium</B></h1>
            <p>+   Echangez sans limite avec les utilisateurs Premium</p>
            <p>+   Accédez à vos listes de Visites</p>
            <p>+   Décidez qui peut vous contacter</p>
            <p>+   Démarquez-vous avec l'icône Premium</p>
            <p>+   Obtenez une version d'essai gratuite de 10 jours</p>
            <p><B>+   Prix de l'abonnement : </B></p>
            <p> 10€/mois    50€/semestre    90€/an</p>
            <form action="verificationabonnement.php" method="post">
            <div class="form-group">
            <label for="Typeabonnement">Abonnement :</label>
            <select id="Typeabonnement" name="abonnement">
                <option value="mois">Mois</option>
                <option value="semestre">Semestre</option>
                <option value="annee">Année</option>
                <option value="essai">Essai</option>
            </select>
        </div>  
            <div>
            <button>S'abonner</button>
            </div>
        </form>
        </div>
    </div>

