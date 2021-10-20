<?php
class Plats {
    private $Nom; //String
    private $Prix; //Int
    private $id; //Int

    public function __construct($id,$Prix,$Nom){
        $this->id = $id;
        $this->Prix = $Prix;
        $this->Nom = $Nom;;
    }
}