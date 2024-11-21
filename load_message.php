<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "web", "ProjetWeb", "rencontre");

// Vérifier la connexion à la base de données
if ($conn->connect_error) {
    die("Connexion à la base de données échouée : " . $conn->connect_error);
}

$sql = "SELECT expediteur, contenu FROM Messages ORDER BY horaire DESC";
$result = $conn->query($sql);

$messages = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = array(
            'expediteur' => $row['expediteur'],
            'contenu' => $row['contenu']
        );
    }
}
$conn->close();
header('Content-Type: application/json');
echo json_encode($messages);
?>
