<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['usager'])) {
    header("Location: login.php");
    exit;
}

// Vérifier si les paramètres GET existent
if (!isset($_GET['expediteur']) || !isset($_GET['destinataire'])) {
    // Rediriger vers une page d'erreur ou afficher un message d'erreur
    header("Location: erreur.php");
    exit;
}

// Récupérer les logins de l'expéditeur et du destinataire depuis les paramètres GET
$expediteur = $_GET['expediteur'];
$destinataire = $_GET['destinataire'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venuse</title>
    <link rel="icon" href="Image/Logo.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="mess.css" />
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
                        <li><a href="utilisateurd.php">Découvrir</a></li>
                        <li><a href="conversations.php">Conversation</a></li>
                        <li><a href="profil.php">Profil</a></li>
                        <li><a href="abonnement.php">Abonnement</a></li>
                        
                    </ul>
                </nav>
            </div>
            <div id="image1">
                <img src="Image/coeur.png">
            </div>
        </div>
            <div id="main">
                <div>
                    <h1>Conversation avec <?php echo $destinataire; ?></h1>
                    <div class="message-box"></div> <!-- Zone de conversation -->
                    <form id="postForm"> <!-- Formulaire d'envoi de message -->
                        <input type="hidden" id="expediteur" value="<?php echo $expediteur; ?>">
                        <input type="hidden" id="destinataire" value="<?php echo $destinataire; ?>">
                        <textarea id="message" placeholder="Écrivez votre message ici"></textarea>
                        <input type="submit" value="Envoyer">
                    </form>
                </div>
            </div> 
        </div> 
    <script src="jscript.js"></script>  
</body>
</html>
