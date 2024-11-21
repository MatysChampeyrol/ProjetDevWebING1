<?php
session_start();

if (!isset($_SESSION['usager'])) {
    header("Location: login.php");
    exit;
}

$user_info = $_SESSION['usager'];

$conn = mysqli_connect('localhost', 'web', 'ProjetWeb', 'rencontre');

if(isset($_POST['name'])){

    $horaire = date("Y-m-d H:i:s");

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    echo 'Message entré : '. $_POST['name'];

    //$query = "INSERT INTO Discussion(id_expediteur, contenu, horaire) VALUES('$name','$name', '$horaire');";

    $query = $conn->prepare("INSERT INTO Discussion(id_expediteur, contenu) VALUES(?,?);");
    $query->bind_param("ss", $user_info['login'], $name); //receveur
    $query->execute();
    $query->close();

    //celle la sera a modifier donc pour mettre en accord avec le php et le compte: login ect pour que ca se fasse tout seul

    if(mysqli_query($conn, $query)){
        echo ' ca marche';
    }else{
        echo '  Connexion à la BDD impossible';
    }
}

?>


