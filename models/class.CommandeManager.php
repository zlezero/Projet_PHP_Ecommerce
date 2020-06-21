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
        $userID = $_SESSION["sessionManager"]->getUser()->getIdUtilisateur();
        $req = $this->bdd->prepare("SELECT idCommande FROM Commande WHERE idUtilisateur = :idUtilisateur");
        $req->bindParam('idUtilisateur',$userID );
        $req->execute();

        $result = $req->fetchAll();
        $liste=array();
        foreach($result as $indice=>$value) {
            $commande=new Commande($value['idCommande']);
            array_push($liste,$commande);
        }
        return $liste;
    }

    public function addCommande() {

        $valeurCookie = hash("sha512", random_bytes(10));

        setcookie('panier', $valeurCookie, time() + 365*24*3600, null, null, false, true);

        $sql = "INSERT INTO Commande(idStatutCommande, dateCommande, cookieUtilisateur) VALUES(1, SYSDATE(), :valeurCookie)";

        $req = $this->bdd->prepare($sql);

        $req->bindValue("valeurCookie", $valeurCookie);

        $req->execute();
        $commandeID = (intVal($this->bdd->lastInsertId()));
        
        return new Commande($commandeID);
    }

    public function updateStatutCommande(Commande $commande) {

        $sql = "UPDATE Commande SET idStatutCommande = :idStatutCommande, dateCommande = SYSDATE() WHERE idCommande = :idCommande";

        $req = $this->bdd->prepare($sql);

        $req->bindValue('idCommande', $commande->getidCommande());
        
        $req->bindValue('idStatutCommande', $commande->getStatutCommande()->getidStatutCommande());

        $req->execute();
    }

    public function updateUserCommande(Commande $commande) {

        $sql = "UPDATE Commande SET idUtilisateur = :idUser WHERE idCommande = :idCommande";

        $req = $this->bdd->prepare($sql);

        $req->bindValue('idCommande', $commande->getidCommande());
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