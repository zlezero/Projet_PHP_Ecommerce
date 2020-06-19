<?php

require_once("Model.php");

class PanierManager {

    private PDO $bdd;

    public function __construct() {
        $this->bdd = Model::getDatabase();
    }

    public function getAll(int $idCommande){
        $this->bdd = Model::getDatabase();
    
        $req = $this->bdd->prepare("SELECT * FROM Panier WHERE  idCommande = :idCommande");
        $req->bindParam('idCommande', $idCommande);
        $req->execute();

        $result = $req->fetchAll();
        $panier=array();
        foreach($result as $indice=>$value){
            $article=new Panier($idCommande,$value['idArticle']);
            array_push($panier,$article);
        }
        return $panier;
    }

    public function addPanier(int $idCommande,int $idArticle) {
            $sql = "INSERT INTO Panier(idCommande, idArticle,quantite) VALUES(:idC,:idA,1)";

            $req = $this->bdd->prepare($sql);
    
            $req->bindValue('idC', $idCommande);
            $req->bindValue('idA', $idArticle);
            $req->execute();
    }

    public function updatePanier(Panier $panier) {

        $sql = "UPDATE Panier SET quantite = :quantite WHERE idCommande = :idCommande and idArticle = :idArticle";

        $req = $this->bdd->prepare($sql);

        $req->bindValue('idCommande', $panier->getIdCommande());
        $req->bindValue('idArticle', $panier->getArticle()->getIdArticle());
        $req->bindValue('quantite', $panier->getQuantite());
        

        $req->execute();
    }

    public function deletePanier(int $idCommande,int $idArticle) {

        $sql = "DELETE FROM Panier  WHERE idCommande = :idCommande and idArticle = :idArticle";

        $req = $this->bdd->prepare($sql);
        $req->bindValue('idCommande', $idCommande);
        $req->bindValue('idArticle', $idArticle);

        $req->execute();

    }

    public function panierExist(int $idCommande,int $idArticle) : bool {

        $sql = "SELECT idCommande FROM Panier WHERE idArticle= :idA and idCommande = :idC";

        $req = $this->bdd->prepare($sql);

        $req->bindValue('idC', $idCommande);
        $req->bindValue('idA', $idArticle);
        $req->execute();

        $data = $req->fetch();

        return count($data) > 0;
    }

}


?>