<?php
class Commande {
    private $table; //Table
    private $Plats; //array Plats

    private $Bdd; //PDO

    public function __construct($table,$Bdd){
        $this->table = $table;
        $this->Plats = Array();
        $this->Bdd = $Bdd;
    }
}