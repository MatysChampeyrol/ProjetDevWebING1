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

// Définir le chemin de la photo de profil par défaut
$photo_profil_par_defaut = 'Image/defaut.png';




// Vérifier si un ID d'utilisateur est passé dans l'URL
if(!isset($_GET['id'])) {
    // Récupérer l'ID de l'utilisateur depuis l'URL
    header("Location: login.php");}

$utilisateur_id = $_GET['login'];

// Vérifier si l'utilisateur a une photo de profil personnalisée
if (!empty($utilisateur_id['photo_profil'])) {
    // Utiliser la photo de profil personnalisée si elle existe
    $photo_profil = $utilisateur_id['photo_profil'];
} else {
    // Utiliser la photo de profil par défaut si l'utilisateur n'a pas de photo personnalisée
    $photo_profil = $photo_profil_par_defaut;
}
?>

    
    


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venuse</title>
    <link rel="stylesheet" href="stylesheetprofil.css">
</head>

<body>
    <form action="modifier_profiladmin.php" method="post" enctype="multipart/form-data">
        <div id="container">
            <div id="banniere">
                <div id="menu">
                    <nav>
                      <ul>
                        <li><a href="utilisateura.php">Accueil</a></li>
                        <li><a href="#">Messagerie</a></li>
                        <li><a href="#">Profil</a></li>
                        <li><a href="utilisateura.php">Découvrir</a></li>
                      </ul>
                    </nav>
                </div>
                <div id="image1">
                    <img src="Image/coeur.png">
                </div>
            </div>
            <div id="containerinfo">
                <div id="infopersonnel">
                    <p><strong>Pseudonyme :</strong></p>
                    <input type="text" id="login" name="login" value="<?php htmlspecialchars($utilisateur_id,ENT_QUOTES,'UTF-8')?>" readonly>

                    <p><strong>Sexe :</strong></p>
                    <input type="text" id="sexe" name="sexe" value="<?php echo $utilisateur_id['sexe']?>" required>

                    <p><strong>Date de naissance :</strong></p>
                    <input type="text" id="ddn" name="ddn" value="<?php echo $utilisateur_id['ddn']?>">

                    <p><strong>Profession :</strong></p>
                    <input type="text" id="profession" name="profession" value="<?php echo $utilisateur_id['profession']?>">

                    <p><strong>Ville :</strong></p>
                    <input type="text" id="ville" name="ville" value="<?php echo $utilisateur_id['ville']?>">

                    <p><strong>Situation amoureuse :</strong></p>
                    <input type="text" id="situation" name="situation" value="<?php echo $utilisateur_id['situation']?>">

                    <p><strong>Mot de passe :</strong></p>
                    <input type="text" id="mdp" name="mdp" value="<?php echo $utilisateur_id['mdp']?>" required>

                    <p><strong>Date d'inscription :</strong></p>
                    <input type="text" id="date_inscription" name="date_inscription" value="<?php echo $utilisateur_id['date_inscription']?>" readonly>
                </div>
                <div id="infosupp">
                    <p><strong>Description physique :</strong>(<span id="compteur1">500</span> caractères restants)</p>
                    <textarea id="description" name="description" maxlength="500"><?php echo $utilisateur_id['description']?></textarea>

                    <p><strong>Informations personnelles :</strong>(<span id="compteur1">500</span> caractères restants)</p>
                    <textarea id="informations" name="informations" maxlength="500"><?php echo htmlspecialchars($utilisateur_info)?></textarea>

                    <p><strong>Adresse complète :</strong>(<span id="compteur1">500</span> caractères restants)</p>
                    <textarea id="adresse_complete" name="adresse_complete" maxlength="500"><?php echo $utilisateur_id['adresse_complete']?></textarea>
                </div>
            </div>

            <div id="containerp2">
                <div id="profil">
                    <p><strong>Nom :</strong></p>
                    <input type="text" id="nom" name="nom" value="<?php echo $utilisateur_id['nom']?>">

                    <p><strong>Prénom :</strong></p>
                    <input type="text" id="prenom" name="prenom" value="<?php echo $utilisateur_id['prenom']?>">

                    <p><strong>Age :</strong></p>
                    <input type="text" id="age" name="age" value="<?php echo $utilisateur_id['age']?>">
                </div>

                <div id="imageprofil">
                    <img src="<?php echo $photo_profil;?>" alt="Photo de profil">
                </div>
                <div id="form1">
                    <label for="user_image">Choisir une photo de profil :</label>
                    <input type="file" name="user_image" id="user_image" accept="image/*"><br>
                </div>
            </div>

            <div id="containerimagesprofil">

                
                <div id="formim1">
                </div>
                <div id="imageA">
                    <label for="presentation_photos">Image 1 <br></label>
                    <img src="<?php echo $utilisateur_id['image1'];?>" alt="Image1">
                    <input type="file" name="photo1" id="presentation_photosA" accept="image/*"><br>
                </div>
                <div id="imageB">
                    <label for="presentation_photos">Image 2 <br></label>
                    <img src="<?php echo $utilisateur_id['image2'];?>" alt="Image2">
                    <input type="file" name="photo2" id="presentation_photosB" accept="image/*"><br>
                </div>
                <div id="imageC">
                    <label for="presentation_photos">Image 3 <br></label>
                    <img src="<?php echo $utilisateur_id['image3'];?>" alt="Image3">
                    <input type="file" name="photo3" id="presentation_photosC" accept="image/*"><br>
                </div>
            </div>

        </div>
        <button type="submit" name="submit">Enregistrer</button>
    </form>
    <form action="modifier_profiladmin.php" method="post">';
    <input type="hidden" name="id_utilisateur" value="<?php echo $utilisateur_id; ?>">;
    <input type="submit" value="">;
    </form>;
</body>
</html>
