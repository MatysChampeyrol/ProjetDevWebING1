<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['usager'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit;
}

// Vérifier si des données ont été soumises
if (isset($_POST["submit"])) {
    // Paramètres de connexion à la base de données
    $serveur = "localhost";
    $nom_utilisateur = "web";
    $mot_de_passe = "ProjetWeb";
    $nom_base_de_donnees = "rencontre";

    // Connexion à la base de données
    $connexion = new mysqli($serveur, $nom_utilisateur, $mot_de_passe, $nom_base_de_donnees);

    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("La connexion à la base de données a échoué : " . $connexion->connect_error);
    }

    // Récupérer les informations de l'utilisateur à partir de la session
    $user_info = $_SESSION['usager'];
    $user_id = $user_info['login'];

    // Récupérer les données du formulaire
    // Récupérer les données du formulaire
    $nouveau_nom = !empty($_POST['nom']) ? $_POST['nom'] : NULL;
    $nouveau_prenom = !empty($_POST['prenom']) ? $_POST['prenom'] : NULL;
    $nouveau_sexe = !empty($_POST['sexe']) ? $_POST['sexe'] : NULL;
    $nouvelle_ddn = !empty($_POST['ddn']) ? $_POST['ddn'] : NULL;
    $nouvelle_profession = !empty($_POST['profession']) ? $_POST['profession'] : NULL;
    $nouvelle_ville = !empty($_POST['ville']) ? $_POST['ville'] : NULL;
    $nouvelle_situation = !empty($_POST['situation']) ? $_POST['situation'] : NULL;
    $nouveau_mdp = !empty($_POST['mdp']) ? $_POST['mdp'] : NULL;
    $nouveau_description = !empty($_POST['description']) ? $_POST['description'] : NULL;
    $nouveau_informations = !empty($_POST['informations']) ? $_POST['informations'] : NULL;
    $nouveau_adresse_complete = !empty($_POST['adresse_complete']) ? $_POST['adresse_complete'] : NULL;
    

    //telechargement de l'image profil de l'utilisateur vers un dossier qui va stocker les images des utilisateurs
    if(isset($_FILES['user_image']) ){
        $file_name=$_FILES['user_image']['name'];
        $file_tmp=$_FILES['user_image']['tmp_name'];
        $file_type=$_FILES['user_image']['type'];

        move_uploaded_file($file_tmp,"Image/reception_image/" . $file_name);
        $chemin="Image/reception_image/";

        if($file_name!=""){
            $photo_profil = $chemin . $file_name;
        $sqlp = "UPDATE Usager SET photo_profil=? WHERE login=?";
        $stmtp = $connexion->prepare($sqlp);
        $stmtp->bind_param("ss",$photo_profil, $user_id);
        $stmtp->execute();
        }

    }

    //photos de présentation
    if(isset($_FILES['photo1']) ){
        $file_name1=$_FILES['photo1']['name'];
        $file_tmp1=$_FILES['photo1']['tmp_name'];
        $file_type1=$_FILES['photo1']['type'];

        move_uploaded_file($file_tmp1,"Image/reception_image/" . $file_name1);
        $chemin1="Image/reception_image/";

        if($file_name1!=""){
            $image1 = $chemin1 . $file_name1;
        $sql1 = "UPDATE Usager SET image1=? WHERE login=?";
        $stmt1 = $connexion->prepare($sql1);
        $stmt1->bind_param("ss",$image1, $user_id);
        $stmt1->execute();
        }

    }

    
    if(isset($_FILES['photo2']) ){
        $file_name2=$_FILES['photo2']['name'];
        $file_tmp2=$_FILES['photo2']['tmp_name'];
        $file_type2=$_FILES['photo2']['type'];

        move_uploaded_file($file_tmp2,"Image/reception_image/" . $file_name2);
        $chemin2="Image/reception_image/";

        if($file_name2!=""){
            $image2 = $chemin2 . $file_name2;
        $sql2 = "UPDATE Usager SET image2=? WHERE login=?";
        $stmt2 = $connexion->prepare($sql2);
        $stmt2->bind_param("ss",$image2, $user_id);
        $stmt2->execute();
        }

    }

  
    if(isset($_FILES['photo3']) ){
        $file_name3=$_FILES['photo3']['name'];
        $file_tmp3=$_FILES['photo3']['tmp_name'];
        $file_type3=$_FILES['photo3']['type'];

        move_uploaded_file($file_tmp3,"Image/reception_image/" . $file_name3);
        $chemin3="Image/reception_image/";

        if($file_name3!=""){
            $image3 = $chemin3 . $file_name3;
        $sql3 = "UPDATE Usager SET image3=? WHERE login=?";
        $stmt3 = $connexion->prepare($sql3);
        $stmt3->bind_param("ss",$image3, $user_id);
        $stmt3->execute();
        }

    }

   


    // Préparer la requête SQL
    $sql = "UPDATE Usager SET nom=?, prenom=?, sexe=?, ddn=?, profession=?, ville=?, situation=?, mdp=?, description=?, informations=?, adresse_complete=?  WHERE login=?";
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("ssssssssssss", $nouveau_nom, $nouveau_prenom, $nouveau_sexe, $nouvelle_ddn, $nouvelle_profession, $nouvelle_ville, $nouvelle_situation, $nouveau_mdp, $nouveau_description, $nouveau_informations, $nouveau_adresse_complete, $user_id);
    $stmt->execute();
    
    echo "description" . $nouveau_description;


    //on modifie la valeur de la variable $_SESSION pour quelle affiche les infos mises à jour
    $sqlretour = "SELECT * FROM Usager WHERE login = ?";
    $stmtretour = $connexion->prepare($sqlretour);
    $stmtretour->bind_param("s",$user_info['login']);
    $stmtretour->execute();
    $result = $stmtretour->get_result();
    $res_requete = $result->fetch_assoc();
    $_SESSION['usager'] = $res_requete;


    //On ferme la connexion
    $connexion->close();

    
    header("Location: profil.php");
    exit;
}
?>
