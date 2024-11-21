<?php
session_start();

if (!isset($_SESSION['usager'])) {
    header("Location: login.php");
    exit;
}
        
$nomReceveur = $_SESSION['usager']['receveur'];
$user_info = $_SESSION['usager'];

$conn = mysqli_connect('localhost', 'web', 'ProjetWeb', 'rencontre');

//$query = "SELECT * FROM Discussion WHERE (id_expediteur = '{$user_info['login']}' AND id_receveur = '{$user_info['receveur']}') OR (id_receveur = '{$user_info['login']}' AND id_expediteur = '{$user_info['receveur']}')"; 
$query = "SELECT * FROM Discussion WHERE id_expediteur = '{$user_info['login']}' OR id_receveur = '{$user_info['login']}'"; 

$result = mysqli_query($conn, $query);

$donnees = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode($donnees);
?>

