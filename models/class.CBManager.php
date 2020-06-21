<?php

require_once("Model.php");

class CBManager {

    private PDO $bdd;

    public function __construct() {
        $this->bdd = Model::getDatabase();
    }

    public function addCB(string $numCB, string $nomCompletCB, DateTime $dateExpirationCB, int $cryptoCB) {
        
        $sql = "INSERT INTO CB(numCB, dateExpirationCB, nomCompletCB, cryptoCB) VALUES(:numCB, :dateExpirationCB, :nomCompletCB, :cryptoCB)";

        $req = $this->bdd->prepare($sql);

        $req->bindValue('numCB', $numCB);
        $req->bindValue('dateExpirationCB', $dateExpirationCB->format("Y-m-d"));
        $req->bindValue('cryptoCB', $cryptoCB);
        $req->bindValue('nomCompletCB', $nomCompletCB);

        $req->execute();

        return new CB((intVal($this->bdd->lastInsertId())));

    }
}


?>