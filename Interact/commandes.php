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
    <link href="commandes.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Noto+Sans+JP:wght@500&family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">

</head>
<body>
    <p>Voici les commandes : </p>
    <?php
        $req = "SELECT * FROM commandes";
        $Ores = $Bdd->query($req);
        while($tables = $Ores->fetch()){

            $req = "SELECT tables.id_tables, commandes.id_commandes, SUM(plats.prix) AS prix FROM tables,plats,commande_plats,commandes WHERE commande_plats.id_plats=plats.id_plat and commande_plats.id_commande=commandes.id_commandes and commandes.id_tables=tables.id_tables and commande_plats.id_commande=$tables->id_commandes";
            $Ores3 = $Bdd->query($req);
            while($prix = $Ores3->fetch()){
                echo("<br>");
                echo("Tables $tables->id_tables : $prix->prix € <br>");   
            }



        $req = "SELECT commande_plats.id_commande, plats.id_plat ,plats.nom, plats.prix FROM commande_plats, plats WHERE commande_plats.id_plats=plats.id_plat and id_commande=$tables->id_commandes";
        $Ores2 = $Bdd->query($req);
            while($plats = $Ores2->fetch()){
                echo("$plats->nom<br>");
            }
        }
    ?>
    
</body>
</html>