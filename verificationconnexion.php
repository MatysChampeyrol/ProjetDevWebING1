<?php
session_start();

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
$login = $_POST['login'];
$mdp = $_POST['mdp'];

$sql = "SELECT * FROM Usager WHERE login = ? AND mdp = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $login, $mdp); // "ss" indique que les paramètres sont de type chaîne (string)
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows >0) {
    
    $reponse = $result->fetch_assoc(); //pour récupérer result sous la forme d'un tableau associatif

    // On stocke les informations de l'utilisateur dans la session
    $_SESSION['usager'] = $reponse;
    if($_SESSION['usager']['profil']=="admin"){
        header("Location: admin.php");
    exit;
    }
    if($_SESSION['usager']['profil']=="utilisateur"){
        // Rediriger vers la page d'accueil
    header("Location: utilisateurd.php");
    exit;
    }
    if($_SESSION['usager']['profil']=="abonne"){
        // Rediriger vers la page d'accueil
    header("Location: utilisateura.php");
    exit;
    }
    
} else {
    // Authentification échouée, on redirige vers la page de connexion avec un message d'erreur
    header("Location: login.php?error=1");
    exit;
}

// On ferme la connexion à la base de données
$conn->close();
?>
