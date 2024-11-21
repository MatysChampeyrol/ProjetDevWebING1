<?php
session_start();
if(!isset($_SESSION['usager'])) {
    header("Location: login.php");
    exit;
}
$serveur ="localhost";
$utilisateur = "web";
$mdp = "ProjetWeb";
$bdd ="rencontre";

$user_info = $_SESSION['usager'];

$conn = mysqli_connect($serveur,$utilisateur, $mdp, $bdd);


// Vérifier la connexion
if ($connexion->connect_error) {
    die("Erreur de connexion à la base de données : " . $connexion->connect_error);
}

// Requête SQL pour récupérr un usager aléatoire
$sql = "SELECT prenom, age, description, information, profession,  FROM Usager ORDER BY RAND() LIMIT 1";

// Executer requête SQL
$resultat = $connexion ->query($sql);

// vérifier si la requête a réussi
if($resultat->num_rows > 0){
    //recuperer les donées de la ligne résultat
    $ligne = $resultat->fetch_assoc();
    // renvoyer les données de l'usager au format JSON
    echo json_encode($ligne);
    $connexion->close();
}
else{
    echo json_encode([]);
    $connexion->close();
}

?>
