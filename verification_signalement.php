<?php
session_start();

// Vérifier si l'utilisateur est connecté (s'il y a des informations utilisateur dans la session)
if (!isset($_SESSION['usager'])) {
    // Si l'utilisateur n'est pas connecté, le rediriger vers la page de connexion
    echo "erreur";
    exit;
}

$user_info = $_SESSION['usager'];

// Vérifier si le formulaire a été soumis
if(isset($_POST["submit"])) {
    $servername = "localhost";
    $username = "web";
    $password = "ProjetWeb";
    $database = "rencontre";

    // Connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Récupération des données du formulaire
    $motif = $_POST['motif'];
    $signalee = $_POST['signalee'];

    // Requête SQL INSERT
    // $sql = "INSERT INTO Signalements (id_signaleur, id_signalee, motif) VALUES (?, ?, ?)";
    echo "oui1";
    $stmt = $conn->prepare("INSERT INTO Signalements (id_signaleur, id_signalee, motif) VALUES (?, ?, ?)");
    echo "oui2";
    $stmt->bind_param("sss", $user_info['login'], $signalee, $motif);
    echo "oui3";
    $stmt->execute();

    // Redirection vers la page précédente avec un paramètre GET pour indiquer le succès
    header("Location: utilisateurd.php");
    exit;

    // Fermeture de la connexion à la base de données
    $stmt->close();
    $conn->close();
} else {
    // Si le formulaire n'a pas été soumis, rediriger vers la page précédente avec un paramètre GET pour indiquer l'échec
    header("Location: utilisateurd.php");
    exit;
}
?>
