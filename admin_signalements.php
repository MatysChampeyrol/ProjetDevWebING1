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
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles_signalements.css">
</head>
<body>
    <div id="container">
        <div id="banniere">
            <div id="menu">
                <nav>
                    <ul>
                        <li><a href="admin.php">Utilisateurs</a></li>
                        <li><a href="#">Messageries</a></li>
                        <li><a href="profil.php">Profil <p><?php echo $user_info['login']; ?></p></a></li>
                        <li><a href="admin_signalements.php">Signalements</a></li>
                        
                    </ul>
                </nav>
            </div>
            <div id="image1">
                <img src="Image/coeur.png">
            </div>
        </div>
<div id="container_profils">
 <!--_on va créer un conteneur de référence qui va servir pour afficher l'ensemble des utilisateurs-->
 <div class="containerp2">
        
        <div class="form-group">
    <form action="supressionutilisateur.php" method="post">
    <label for="recherche">Entrer le pseudo de l'utilisateur à supprimer</label>
    <input type="text" id="recherche" name="utilisateur" placeholder="Entrer...">
    <div>
    <button class= "boutonsupprimer">Supprimer</button>
    </div>
                
    </div>
    
                
                  <!--on va implementer le bouton sur une ligne supprimer directement-->

              
                
        </div>


<?php

// Connexion à la base de données

$servername = "localhost"; 
$username = "web"; 
$password = "ProjetWeb"; 
$database = "rencontre"; 

// Connexion à la base de données
$connexion = new mysqli($servername, $username, $password, $database);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

// Requête SQL pour récupérer tous les utilisateurs
$sql = "SELECT * FROM Signalements";
$resultat = $connexion->query($sql);

// Vérification s'il y a des résultats
if ($resultat->num_rows > 0) {
    // Affichage des données de chaque utilisateur
    while($utilisateurs_info = $resultat->fetch_assoc()) {
        $sqlph="SELECT * FROM Usager WHERE login='{$utilisateurs_info['login']}'" ;
        $resultatph = $connexion->query($sqlph);
        $ph = $resultatph->fetch_assoc();
        echo '<div class="containerp2 conteneur-utilisateur">';
        echo '<div class="profil">';
        echo '<div class="ligne">';
        echo '<p><strong>Signaleur</strong></p>';echo '<input type="text" readonly class="prenom" name="pseudo" value="' . $utilisateurs_info['id_signaleur'] . '">';
        echo '<p><strong> Signalé</strong></p>';
        echo '<input type="text" readonly class="nom" name="nom" value="' . $utilisateurs_info['id_signalee'] . '">';
        echo '</div>';



        echo '<p><strong>Motif </strong></p>';
        echo '<textarea class="prenom" name="prenom">' .$utilisateurs_info['motif']. '</textarea>';
        
        echo '</div>';
        
        
        echo '</div>';
    }
} else {
    echo "Aucun utilisateur trouvé.";
}

// Fermeture de la connexion
$connexion->close();
?>
    
    </div>
        
        




    </div>
    
</body>
</html>
