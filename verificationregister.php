<?php
session_start();
 
$conn = mysqli_connect("localhost", "web", "ProjetWeb", "rencontre");
 
if (!$conn) {
    die("Connexion échouée : " . mysqli_connect_error());
}
 
if(isset($_POST["submit"])) {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $login = $_POST["login"];
    $ddn = $_POST["ddn"];
    $sexe = $_POST["sexe"];
    $mdp = $_POST["mdp"];

    // Définir le chemin de la photo de profil par défaut
    $photo_profil_par_defaut = 'Image/defaut.png';
    
    // Vérifier si le login est déjà utilisé
    $stmt_check = $conn->prepare("SELECT login FROM Usager WHERE login = ?");
    $stmt_check->bind_param("s", $login);
    $stmt_check->execute();
    $stmt_check->store_result();
 
    if($stmt_check->num_rows > 0) {
        echo "Le login est déjà utilisé. Veuillez en choisir un autre.";
    } else {
        // Insertion dans la base de données
        //$mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
        $profil = "utilisateur";
        $date_inscription = date("Y-m-d");
 
        $stmt_insert = $conn->prepare("INSERT INTO Usager (login, mdp, sexe, date_inscription, nom, prenom, ddn, profil, photo_profil) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("sssssssss", $login, $mdp, $sexe, $date_inscription, $nom, $prenom, $ddn, $profil,$photo_profil_par_defaut);
        $stmt_insert->execute();
        $stmt_insert->close();
        echo "Vous êtes inscrit";
        header('Location: login.php');
    }
 
    $stmt_check->close();
}
 
mysqli_close($conn);
?>
