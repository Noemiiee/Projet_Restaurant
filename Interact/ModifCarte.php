<?php
require("../header.php");
$bdUser = "root"; // Utilisateur de la base de données
$bdPasswd = ""; // Son mot de passe
$dbname = "restorente"; // nom de la base de données
$host = "localhost"; // Hôte
try {
    $Bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $bdUser, $bdPasswd); // SE CONNECTER A LA BDD
    $Bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); // METTRE LE MODE OBJET PAR DEFAUT
} catch (PDOException $e) {
    echo ("Erreur : impossible de se connecter à la bdd");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="resto.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Noto+Sans+JP:wght@500&family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">

</head>
<body>
<div class="container">
        <div id="data">
        
    <form action="" class="ins" method="POST">
        Entrez le nouveau prix : </br> </br>
    <select name="plats" id="plats" class="bouton">
        <?php
            $req = "SELECT * FROM plats";
            $Ores = $Bdd->query($req);
   
            while($plats=$Ores->fetch()){
                echo ("<option value='$plats->id_plat'>$plats->nom </option>");
            }
        ?>
        <br>
    </select>
    <input type="number" id="tentacles" name="Prix" min="1" max="500" class="bouton">
    <button class="bouton">Envoyer la modif</button>
  


</body>
</html>

<?php
if(isset($_POST["plats"]) && isset($_POST["Prix"])){
    $prix = $_POST["Prix"];
    $id = $_POST["plats"];

    $req = "UPDATE plats SET prix = '$prix' WHERE id_plat = '$id'";
    $Ores = $Bdd->query($req);
}

