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
    <link href="serveur.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Noto+Sans+JP:wght@500&family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">    
    <link rel="preconnect" href="https://fonts.gstatic.com">
</head>
<body>
    <p>Ajouter une commande : </p>
<div class="container">
    <form action="" method="POST">
    <select name="plats" id="plats" class="bouton">
        <?php
            $req = "SELECT plats.id_plat, plats.nom, plats.prix FROM plats ORDER BY prix";
            $Ores = $Bdd->query($req);
   
            while($tables=$Ores->fetch()){
                echo ("<option value='$tables->id_plat'>$tables->nom  $tables->prix € </option>");
            }
        ?>
        <br>
    </select>
    <button class="bouton">Add</button>
    <button class="bouton" formaction="Serveur.php">Fin</button>
</body>
</html>


<?php
if(isset($_POST["plats"])){
    if(!isset($_SESSION['Tabplat'])){
        $_SESSION['Tabplat'] = array();
    }
    $_SESSION['Tabplat'][] = $_POST["plats"];
}
