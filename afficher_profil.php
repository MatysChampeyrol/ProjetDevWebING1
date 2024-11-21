<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['usager'])) {
    header("Location: login.php");
    exit;
}

// Connexion à la base de données
$conn = new mysqli("localhost", "web", "ProjetWeb", "rencontre");

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Initialiser une variable pour stocker les profils à afficher
$profils = '';

// Construire la requête SQL de base
$sql = "SELECT * FROM Usager WHERE 1";

// Traitement du formulaire de recherche de compte
if (isset($_POST["submit"])) {
    // Récupérer les données du formulaire
    $recherche = $conn->real_escape_string($_POST['recherche']);
    $genre = $conn->real_escape_string($_POST['sexe']);
    $situation = $conn->real_escape_string($_POST['situation']);
    $ageMIN = intval($_POST['ageMIN']);
    $ageMAX = intval($_POST['ageMAX']);

    // Ajouter la clause SQL pour le genre si spécifié
    if (!empty($genre)) {
        $sql .= " AND sexe = '$genre'";
    }

    // Ajouter la clause SQL pour la situation si spécifiée
    if (!empty($situation)) {
        $sql .= " AND situation = '$situation'";
    }

    // Ajouter la clause SQL pour l'âge
    $sql .= " AND age BETWEEN $ageMIN AND $ageMAX";

    // Ajouter la clause SQL pour la recherche si spécifiée
    if (!empty($recherche)) {
        $sql .= " AND (login LIKE '%$recherche%' OR nom LIKE '%$recherche%' OR prenom LIKE '%$recherche%')";
    }
}

// Exécuter la requête SQL
$result = $conn->query($sql);

// Construire la liste des profils correspondants
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $profils .= "<div class='profil'>";
        $profils .= "<img class='image_profil' src='" . $row['photo_profil'] . "'>";
        $profils .= "<div class='infos'>";
        $profils .= "<p>Pseudonyme : " . $row["login"] . "</p>" . "</br>";
        $profils .= "<p>Age : " . $row["age"] . "</p>";
        $profils .= "<button onclick='showAdditionalInfo(\"" . $row['login'] . "\")'>Afficher le profil</button>";
        $profils .= "</div>";
        $profils .= "</div>";


        // Informations additionnelles cachées pour chaque profil
        $profils .= "<div id='additional-info-" . $row['login'] . "' class='additional-info hidden'>";
        $profils .= "<h2>" . htmlspecialchars($row['login'], ENT_QUOTES, 'UTF-8') . "</h2>";
        $profils .= "<img class='addition_image_profil' src='" . $row['photo_profil'] . "'>";
        $profils .= "<button class='message-btn' onclick='envoyerMessage(\"" . $_SESSION['usager']['login'] . "\", \"" . $row['login'] . "\")'>Envoyer un message</button>";
        $profils .= "<button class='report-btn' onclick='showSignalementForm(\"" . $row['login'] . "\")'>Reporter l'utilisateur</button>";
        // Utilisation d'input de type "text" avec l'attribut readonly pour afficher les informations et des labels
        $profils .= "<label>Age :</label><input type='text' value='" . htmlspecialchars($row['age'], ENT_QUOTES, 'UTF-8') . "' readonly><br>";
        $profils .= "<label>Sexe :</label><input type='text' value='" . htmlspecialchars($row['sexe'], ENT_QUOTES, 'UTF-8') . "' readonly><br>";
        
        if (isset($row['ville'])){
            $profils .= "<label>Ville :</label><input type='text' value='" . htmlspecialchars($row['ville'], ENT_QUOTES, 'UTF-8') . "' readonly><br>";
        }
        if (isset($row['profession'])){
            $profils .= "<label>Profession :</label><input type='text' value='" . htmlspecialchars($row['profession'], ENT_QUOTES, 'UTF-8') . "' readonly><br>";
        }
        if (isset($row['situation'])){
            $profils .= "<label>Situation amoureuse :</label><input type='text' value='" . htmlspecialchars($row['situation'], ENT_QUOTES, 'UTF-8') . "' readonly><br>";
        }
        if (isset($row['description'])){
            $profils .= "<label>Description physique :</label><textarea id='adresse_complete' name='adresse_complete' maxlength='500'>" . htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . "</textarea><br>";
        }
        if (isset($row['informations'])){
            $profils .= "<label>Information supplémentaire :</label><textarea id='adresse_complete' name='adresse_complete' maxlength='500'>" . htmlspecialchars($row['informations'], ENT_QUOTES, 'UTF-8') . "</textarea><br>";
        }

        $profils .= "<div class='addition_image_presentation'>";
        $profils .= "<h4>Albums Photos:</h4>";
        if (!empty($row['image1'])) {
            $profils .= "<img src='" . $row['image1'] . "'>";
        }
        if (!empty($row['image2'])) {
            $profils .= "<img src='" . $row['image2'] . "'>";
        }
        if (!empty($row['image3'])) {
            $profils .= "<img src='" . $row['image3'] . "'>";
        }
        $profils .= "</div>";
        $profils .= "</div>";


        $profils .= "<div id='signalement-form-" . $row['login'] . "' style='display: none;'>";
        $profils .= "<div class='modal-content2'>";
        // $profils .= "<span class='close-btn' onclick='hideSignalementForm()'>×</span>";
        $profils .= "<form id='signalement-form' action='verification_signalement.php' method='post'>";
        $profils .= "<input type='hidden' name='signalee' value='" . $row['login'] . "'>";
        $profils .= "<label for='motif'>Motif du signalement :</label>";
        $profils .= "<input type='text' id='motif' name='motif'><br>";
        $profils .= "<button type='submit' name='submit'>Soumettre le signalement</button>";

        $profils .= "</form>";
        $profils .= "</div>";
        $profils .= "</div>";
    }

} else {
        $profils = "<h1>Aucun compte trouvé.</h1>";
    }

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles_affiche_profil.css">
</head>
<body>
    <div id="container">
        <div id="banniere">
            <div id="menu">
                <nav>
                    <ul>
                        <li><a href="#">Découvrir</a></li>
                        <li><a href="abonnement.php">Messagerie</a></li>
                        <li><a href="profil.php">Profil</a></li>
                        <li><a href="abonnement.php">Abonnement</a></li>
                    </ul>
                </nav>
            </div>
            <div id="image1">
                <img src="Image/coeur.png">
            </div>
        </div>
        <div id="container_profils">
            <div id="profils">
                <?php echo $profils; ?>
            </div>
        </div>

        <div id="modal-background" class="modal-background">
            <div class="modal-content">
                <span class="close-btn" onclick="hideAdditionalInfo()">&times;</span>
                <div id="modal-info">
                    
                </div>
            </div>
        </div>
    </div>

<div id="signalement-modal-background" >
    <div class="modal-content1">
        <span class="close-btn" onclick="hideSignalementForm()">&times;</span>
        <div id="signalement-modal-info"></div>
    </div>
</div>
</div>
    <script src="index.js"></script>
</body>
</html>
