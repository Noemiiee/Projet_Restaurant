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
    <select name="tables" id="plats" class="bouton">
        <?php
            $req = "SELECT * FROM tables";
            $Ores = $Bdd->query($req);
            $i=1;
            while($tables=$Ores->fetch()){
                echo ("<option value='$tables->id_tables'>Table $tables->id_tables</option>");
                $i=$i+1;
            }
        ?>
        <br>
    </select>
    <button class="bouton" formaction="addplats.php">Ajouter Plats</button>
    <button class="bouton">Envoyer command</button>
  


</body>
</html>


<?php
if(isset($_POST["tables"])){
    $conn = mysqli_connect($host,$bdUser, $bdPasswd, $dbname);
    $tables = $_POST["tables"];
    $req = "INSERT INTO `commandes` (`id_commandes`, `id_tables`) VALUES (NULL, '$tables');";
    $conn->query($req);
    $idCommande = mysqli_insert_id($conn);

    if(isset($_SESSION['Tabplat'])){
        foreach ($_SESSION['Tabplat'] as $value){
            $req = "INSERT INTO `commande_plats` (`id_commande`, `id_plats`) VALUES ('$idCommande', '$value');";
            $Bdd->query($req);
        }
    }
    unset($_SESSION['Tabplat']);
}
