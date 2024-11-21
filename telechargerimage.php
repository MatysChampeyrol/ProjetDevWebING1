<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['usager'])) {
    header("Location: login.php");
    exit;
}

$user_info = $_SESSION['usager'];

// Vérifier si le formulaire a été soumis et si des fichiers ont été téléchargés
if (isset($_POST['submit'])) {
    // Vérifier si une photo de profil a été téléchargée
    if ($_FILES['user_image']['error'] === UPLOAD_ERR_OK) {
        // Chemin où la photo de profil sera sauvegardée
        $uploadDirectory = 'profile_photos/';
        $targetFile = $uploadDirectory . basename($_FILES['user_image']['name']);

        // Déplacer la photo de profil téléchargée vers le répertoire de destination
        if (move_uploaded_file($_FILES['user_image']['tmp_name'], $targetFile)) {
            // Connexion à la base de données
            $conn = new mysqli("localhost", "web", "ProjetWeb", "rencontre");

            // Vérifier la connexion
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Mise à jour du chemin de la photo de profil dans la table Usager
            $sql = "UPDATE Usager SET photo_profil = ? WHERE login = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $targetFile, $user_info['login']);
            $stmt->execute();
            $stmt->close();

            echo "La photo de profil a été téléchargée avec succès.<br>";
        } else {
            echo "Une erreur s'est produite lors du téléchargement de la photo de profil.<br>";
        }
    }

    // Vérifier si des photos de présentation ont été téléchargées
    if (!empty(array_filter($_FILES['presentation_photos']['name']))) {
        // Chemin où les images seront sauvegardées
        $uploadDirectory = 'presentation_photos/';

        // Compteur pour vérifier le nombre de photos téléchargées
        $count = 0;

        // Parcourir toutes les photos téléchargées
        foreach ($_FILES['presentation_photos']['tmp_name'] as $key => $tmp_name) {
            // Vérifier si l'image a été téléchargée avec succès
            if ($_FILES['presentation_photos']['error'][$key] === UPLOAD_ERR_OK) {
                $targetFile = $uploadDirectory . basename($_FILES['presentation_photos']['name'][$key]);

                // Déplacer l'image téléchargée vers le répertoire de destination
                if (move_uploaded_file($_FILES['presentation_photos']['tmp_name'][$key], $targetFile)) {
                    // Insertion de l'image dans la table PhotosPresentation
                    $sql = "INSERT INTO PhotosPresentation (id_usager, image) VALUES (?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $user_info['login'], $targetFile);
                    $stmt->execute();
                    $stmt->close();

                    // Incrémenter le compteur de photos téléchargées
                    $count++;
                } else {
                    echo "Une erreur s'est produite lors du téléchargement d'une photo de présentation.<br>";
                }
            }
        }

        if ($count > 0) {
            echo "Les photos de présentation ont été téléchargées avec succès.";
        } else {
            echo "Aucune photo de présentation n'a été téléchargée.";
        }
    }
}

header("Location: profil.php");
exit;
?>

