<?php

require_once("Model.php");

require_once("class.Commande.php");
class CommandeManager {

    private PDO $bdd;

    public function __construct() {
        $this->bdd = Model::getDatabase();
    }

    public function addCommande() {
            $sql = "INSERT INTO Commande(idStatutCommande) VALUES(1)";

            $req = $this->bdd->prepare($sql);
    
            $req->execute();
            $commandeID = (intVal($this->bdd->lastInsertId()));
            var_dump($commandeID);
            return new Commande($commandeID);
    }

    public function updateStatutCommande(Commande $commande) {

        $sql = "UPDATE Commande SET idStatutCommande = :idStatutCommande WHERE idCommande = :idCommande";

        $req = $this->bdd->prepare($sql);

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