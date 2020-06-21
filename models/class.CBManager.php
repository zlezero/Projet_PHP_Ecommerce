<?php

require_once("Model.php");

class CBManager {

    private PDO $bdd;

    public function __construct() {
        $this->bdd = Model::getDatabase();
    }

    public function addCB(string $numCB, string $nomCompletCB, DateTime $dateExpirationCB, int $cryptoCB) {
        
        $sql = "INSERT INTO CB(numCB, dateExpirationCB, cryptoCB, nomCompletCB) VALUES(:nom, :prenom, :email, :mdp, :idRole, :idCB)";

        


    }
}


?>