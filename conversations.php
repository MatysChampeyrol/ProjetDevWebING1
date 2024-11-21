<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['usager'])) {
    header("Location: login.php");
    exit;
}

// Connexion à la base de données
$servername = "localhost";
$username = "web";
$password = "ProjetWeb";
$dbname = "rencontre";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupérer l'utilisateur actuel
$utilisateur_actuel = $_SESSION['usager']['login'];

// Requête SQL pour récupérer les contacts avec lesquels l'utilisateur actuel a interagi
$sql_contacts = "SELECT DISTINCT contact FROM (
    SELECT expediteur AS contact FROM Messages WHERE destinataire = ? 
    UNION 
    SELECT destinataire AS contact FROM Messages WHERE expediteur = ?
) AS contacts";
$stmt_contacts = $conn->prepare($sql_contacts);
$stmt_contacts->bind_param("ss", $utilisateur_actuel, $utilisateur_actuel);
$stmt_contacts->execute();
$result_contacts = $stmt_contacts->get_result();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venuse</title>
    <link rel="icon" href="Image/Logo.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="conv.css" />
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
                    <h1>Liste des Conversations</h1>
                    <div class="conversation-list">
                        <?php
                        // Afficher les contacts avec lesquels l'utilisateur a déjà eu une conversation
                        while ($row = $result_contacts->fetch_assoc()) {
                            $other_user = $row['contact']; // Utilisez la clé 'contact' pour récupérer le nom de l'autre utilisateur
                            echo "<div class='conversation'>";
                            echo "<h2><a href='messagerie.php?expediteur=$utilisateur_actuel&destinataire=$other_user'>Conversation avec $other_user</a></h2>";
                            echo "</div>";
                            
                        }
                        ?>
                    </div>
                </div>
            </div> 
        </div> 
    <script src="jscript.js"></script>  
</body>
</html>

<?php
// Fermer la connexion à la base de données
$stmt_contacts->close();
$conn->close();
?>
