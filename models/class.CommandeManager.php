<?php

require_once("Model.php");

require_once("class.Commande.php");
class CommandeManager {

    private PDO $bdd;

    public function __construct() {
        $this->bdd = Model::getDatabase();
    }

    //TODO : inverser les parties commentées et décommentées pour ne sélectionner que les commandes d'un utilisateur// TO DO

    //public function getAll(int $idUtilisateur){
    public function getAll(){
        $this->bdd = Model::getDatabase();
    
        //$req = $this->bdd->prepare("SELECT idCommande FROM Commande WHERE  idUtilisateur = :idU");
        //$req->bindParam('idU', $idUtilisateur);
        $req = $this->bdd->prepare("SELECT idCommande FROM Commande");
        $req->execute();

        $result = $req->fetchAll();
        $liste=array();
        foreach($result as $indice=>$value){
            $commande=new Commande($value['idCommande']);
            array_push($liste,$commande);
        }
        return $liste;
    }

    public function addCommande() {
            $sql = "INSERT INTO Commande(idStatutCommande,dateCommande) VALUES(1,SYSDATE)";

            $req = $this->bdd->prepare($sql);

            $req->execute();
            $commandeID = (intVal($this->bdd->lastInsertId()));
            var_dump($commandeID);
            return new Commande($commandeID);
    }

    public function updateStatutCommande(Commande $commande) {

        $sql = "UPDATE Commande SET idStatutCommande = :idStatutCommande,dateCommande = SYSDATE WHERE idCommande = :idCommande";

        $req = $this->bdd->prepare($sql);

        $req->bindValue('idCommande', $commande->getidCommande());
        
        $req->bindValue('idStatutCommande', $commande->getStatutCommande()->getidStatutCommande());

        $req->execute();
    }

    public function updateUserCommande(Commande $commande) {

        $sql = "UPDATE Commande SET idUtilisateur = :idUser WHERE idCommande = :idCommande";

        $req = $this->bdd->prepare($sql);

        $req->bindValue('idUser', $commande->getUser()->getIdUtilisateur());

        $req->execute();

    }

    public function deleteCommande(int $idCommande) {

        $sql = "DELETE FROM Commande WHERE idCommande = :idCommande";

        $req = $this->bdd->prepare($sql);
        $req->bindValue('idCommande', $idCommande);

        $req->execute();

    }

    public function commandeExist(int $idCommande) : bool {

        $sql = "SELECT idCommande FROM Commande WHERE id = :id";

        $req = $this->bdd->prepare($sql);

        $req->bindValue('id', $idCommande);
        $req->execute();

        $data = $req->fetch();

        return count($data) > 0;
    }

}


?>