<?php
session_start();

// Paramètres de connexion à la base de données
$servername = "localhost"; 
$username = "web"; 
$password = "ProjetWeb"; 
$database = "rencontre"; 


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 
$login = $_POST['utilisateur'];  //le login est bien récupéré

//Pour que l'utilisateur soit bien supprimé, il faut d'abord effacer ses références dans d'autres tables (clés étrangères):
//on desactive les contraintes d'intégrité

$sql0 = "SET FOREIGN_KEY_CHECKS=0"; 
$stmt0 = $conn->prepare($sql0);

// Vérifiez si la préparation de la requête a réussi
if ($stmt0) {
    $stmt0->execute();
} else {
    // Gérez l'échec de la préparation de la requête
    echo "Erreur : Impossible de préparer la requête.";
    // Par exemple, afficher un message d'erreur ou enregistrer des journaux
}


$sql1 = "DELETE FROM PhotosPresentation WHERE id_usager = ?"; 
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("s", $login); 
$stmt1->execute();

$sql2 = "DELETE FROM Conversation WHERE login1 = ?"; 
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("s", $login); 
$stmt2->execute();

$sql3 = "DELETE FROM Conversation WHERE login2 = ?"; 
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("s", $login); 
$stmt3->execute();

$sql4 = "DELETE FROM Message WHERE receveur = ?"; 
$stmt4 = $conn->prepare($sql4);
$stmt4->bind_param("s", $login); 
$stmt4->execute();

$sql5 = "DELETE FROM Message WHERE expediteur = ?"; 
$stmt5 = $conn->prepare($sql5);
$stmt5->bind_param("s", $login); 
$stmt5->execute();


$sql = "DELETE FROM Usager WHERE login = ?"; 
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login);
$stmt->execute();

$sqlf = "SET FOREIGN_KEY_CHECKS=1"; 
$stmtf = $conn->prepare($sqlf);
$stmtf->execute();

header("Location: admin.php");
exit;

// On ferme la connexion à la base de données
$conn->close();
?>