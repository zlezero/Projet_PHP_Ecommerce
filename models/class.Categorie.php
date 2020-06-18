<?php
require_once('Model.Php');

class Categorie {

    private int $idCategorie;
    private string $nomCategorie;

    private $bdd;

    public function __construct(int $idCat){
        try {
        
            $this->bdd = Model::getDatabase();
        
            $req = $this->bdd->prepare("SELECT * FROM categorie WHERE idCategorie = :id");
            $req->bindParam('id', $idCat);
    
            $req->execute();
            
            $data = $req->fetch();
    
            if (count($data) > 0) {
                $this->idCategorie = $idCat;
                $this->nomCategorie = $data['nomCategorie'];
            } else {
                throw new Exception("Aucune catégorie n'existe avec cet identifiant");
            }

        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function getIdCategorie(){
        return $this->idCategorie;
    }

    public function getNomCategorie(){
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nom){
        $this->nomCategorie = $nom;
    }

    
}

?>
