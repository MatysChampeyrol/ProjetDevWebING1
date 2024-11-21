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

// Paramètres de connexion à la base de données
$servername = "localhost"; 
$username = "web"; 
$password = "ProjetWeb"; 
$database = "rencontre"; 

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// On récupère les données du formulaire de connexion  
$abonnement = $_POST['abonnement'];
$abonnement2 = 'abonne';


$stmt = $conn->prepare("UPDATE Usager SET profil = ? WHERE login = ?");
$stmt->bind_param("ss", $abonnement2, $user_info['login']); // "ss" indique que les paramètres sont de type chaîne (string)
$stmt->execute();

if($abonnement=="mois"){
    $date_fin_abonnement = date('Y-m-d', strtotime('+1 month'));
    $stmtmois = $conn->prepare("UPDATE Usager SET date_fin_abonnement = ? WHERE login = ?");
    $stmtmois->bind_param("ss", $date_fin_abonnement, $user_info['login']);
    $stmtmois->execute();
}

if($abonnement=="semestre"){
    $date_fin_abonnement = date('Y-m-d', strtotime('+6 month'));
    $stmtsemestre = $conn->prepare("UPDATE Usager SET date_fin_abonnement = ? WHERE login = ?");
    $stmtsemestre->bind_param("ss", $date_fin_abonnement, $user_info['login']);
    $stmtsemestre->execute();
}

if($abonnement=="annee"){
    $date_fin_abonnement = date('Y-m-d', strtotime('+1 year'));
    $stmtannee = $conn->prepare("UPDATE Usager SET date_fin_abonnement = ? WHERE login = ?");
    $stmtannee->bind_param("ss", $date_fin_abonnement, $user_info['login']);
    $stmtannee->execute();
}

if($abonnement=="essai"){
    $date_fin_abonnement = date('Y-m-d', strtotime('+10 day'));
    $stmtessai = $conn->prepare("UPDATE Usager SET date_fin_abonnement = ? WHERE login = ?");
    $stmtessai->bind_param("ss", $date_fin_abonnement, $user_info['login']);
    $stmtessai->execute();
}


$sqlretour = "SELECT * FROM Usager WHERE login = ?";
$stmtretour = $conn->prepare($sqlretour);
$stmtretour->bind_param("s", $user_info['login']);
$stmtretour->execute();
$result = $stmtretour->get_result();
$res_requete = $result->fetch_assoc();
$_SESSION['usager'] = $res_requete;
$user_info = $_SESSION['usager']; // Mettre à jour $user_info avec les nouvelles données de session


$stmt2 = $conn->prepare("SELECT profil FROM Usager WHERE login = ?");
$stmt2->bind_param("s",$user_info['login']);
$stmt2->execute();
$stmt2->bind_result($profil);
$stmt2->fetch();




if($profil=='abonne'){
    echo 'Vous êtes maintenant un membre premium merci!';
    header("Location: utilisateura.php");
    exit;
}
else {
    echo 'Erreur lors de l inscription';
    header("Location: abonnement.php");
}



// On ferme la connexion à la base de données 
$stmt->close();
$stmt2->close();
$stmtretour->close();
$conn->close();
?>



