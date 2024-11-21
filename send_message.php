<?php
// Récupérer les données POST
$expediteur = $_POST['expediteur'];
$destinataire = $_POST['destinataire'];
$message = $_POST['message'];

// Connexion à la base de données
$conn = new mysqli("localhost", "web", "ProjetWeb", "rencontre");

// Vérifier la connexion à la base de données
if ($conn->connect_error) {
    // En cas d'échec, renvoyer une réponse JSON avec un message d'erreur
    $response = ['success' => false, 'error' => "Connexion à la base de données échouée : " . $conn->connect_error];
    echo json_encode($response);
    exit;
}

// Préparer la requête d'insertion du message dans la base de données
$stmt = $conn->prepare("INSERT INTO Messages (expediteur, destinataire, contenu) VALUES (?, ?, ?)");

// Vérifier si la préparation de la requête a réussi
if (!$stmt) {
    // En cas d'échec, renvoyer une réponse JSON avec un message d'erreur
    $response = ['success' => false, 'error' => "Erreur lors de la préparation de la requête"];
    echo json_encode($response);
    exit;
}

// Lier les valeurs aux paramètres de la requête
$stmt->bind_param("sss", $expediteur, $destinataire, $message);

// Exécuter la requête d'insertion
if ($stmt->execute()) {
    // Si l'insertion réussit, renvoyer une réponse JSON avec succès
    $response = ['success' => true];
    echo json_encode($response);
} else {
    // Si l'insertion échoue, renvoyer une réponse JSON avec un message d'erreur
    $response = ['success' => false, 'error' => "Erreur lors de l'insertion du message dans la base de données"];
    echo json_encode($response);
}

// Fermer la connexion à la base de données
$stmt->close();
$conn->close();
?>
