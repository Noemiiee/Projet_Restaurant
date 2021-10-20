<?php
require ("Obj/Commande.php");
require ("Obj/Plats.php");
require ("Obj/Table.php");
session_start();

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

$req = "SELECT * FROM innit";
$Ores = $Bdd->query($req);
if($tables = $Ores->fetch()){
    if($tables->ini == 0){
        $req = "CREATE TABLE `commandes` (
            `id_commandes` int(11) NOT NULL,
            `id_tables` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $Ores = $Bdd->query($req);
    
    
        $req = "CREATE TABLE `commande_plats` (
            `id_commande` int(11) NOT NULL,
            `id_plats` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $Ores = $Bdd->query($req);
    
    
        $req = "CREATE TABLE `plats` (
      `id_plat` int(11) NOT NULL,
      `nom` varchar(100) NOT NULL,
      `prix` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $Ores = $Bdd->query($req);
    
        $req = "INSERT INTO `plats` (`id_plat`, `nom`, `prix`) VALUES
        (1, 'Pâtes Bolognaise', 10),
        (3, 'Pâtes Carbonara', 7),
        (4, 'Calzonne', 12),
        (5, 'Pizza Italienne', 14);";
        $Ores = $Bdd->query($req);
    
        $req = "CREATE TABLE `tables` (
            `id_tables` int(11) NOT NULL,
            `nb_places` int(11) NOT NULL,
            `handicapes` tinyint(1) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $Ores = $Bdd->query($req);
    
        $req = "INSERT INTO `tables` (`id_tables`, `nb_places`, `handicapes`) VALUES
        (1, 2, 1),
        (2, 4, 1);";
        $Ores = $Bdd->query($req);
    
    
        $req = "ALTER TABLE `commandes`
        ADD PRIMARY KEY (`id_commandes`),
        ADD KEY `id_tables` (`id_tables`);";
        $Ores = $Bdd->query($req);
    
        $req = "ALTER TABLE `commande_plats`
        ADD KEY `id_commande` (`id_commande`),
        ADD KEY `id_plats` (`id_plats`);";
        $Ores = $Bdd->query($req);
    
        $req = "ALTER TABLE `plats`
        ADD PRIMARY KEY (`id_plat`);";
        $Ores = $Bdd->query($req);
    
        $req = "ALTER TABLE `tables`
        ADD PRIMARY KEY (`id_tables`);";
        $Ores = $Bdd->query($req);
    
        $req = "ALTER TABLE `commandes`
        MODIFY `id_commandes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;";
        $Ores = $Bdd->query($req);
    
        $req = "ALTER TABLE `plats`
        MODIFY `id_plat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;";
        $Ores = $Bdd->query($req);
    
        $req = "ALTER TABLE `tables`
        MODIFY `id_tables` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;";
        $Ores = $Bdd->query($req);
    
        $req = "ALTER TABLE `commandes`
        ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`id_tables`) REFERENCES `tables` (`id_tables`);";
        $Ores = $Bdd->query($req);
    
        $req = "ALTER TABLE `commande_plats`
        ADD CONSTRAINT `commande_plats_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commandes` (`id_commandes`),
        ADD CONSTRAINT `commande_plats_ibfk_2` FOREIGN KEY (`id_plats`) REFERENCES `plats` (`id_plat`);";
        $Ores = $Bdd->query($req);


        $req = "CREATE TABLE `innit` (
            `ini` tinyint(1) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $Ores = $Bdd->query($req);

        $req = "INSERT INTO `innit` (`ini`) VALUES
        (1)";
        $Ores = $Bdd->query($req);
    }
}
?>