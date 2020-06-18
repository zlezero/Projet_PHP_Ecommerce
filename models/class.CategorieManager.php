<?php

require_once('Model.php');

class CategorieManager{

    private $bdd;

    public function __construct() {
        $this->bdd = Model::getDatabase();
    }

    public function getAllCategories(){
        $req = $this->bdd->prepare('SELECT * FROM categorie');
        $req->execute();
        return $req->fetchAll();
    }

    public function getCategorie(int $id){
        $req = $this->bdd->prepare('SELECT * FROM categorie WHERE idCategorie = :id');
        $req->bindValue(':id',$id);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function addCategorie($nomCat){
        $req = $this->bdd->prepare('INSERT INTO categorie (nomCategorie) VALUES (:nom)');
        $req->bindValue(':nom',$nomCat);
        $req->execute();
        return new Categorie((intVal($this->bdd->lastInsertId())));
    }

    public function updateCategorie(Categorie $categorie){
        $req = $this->bdd->prepare('UPDATE categorie SET nomCategorie = :nom WHERE idCategorie = :id');
        $req->bindValue(':nom',$categorie->getNomCategorie());
        $req->bindValue(':id',$categorie->getIdCategorie());
        $req->execute();
    }

    public function deleteCategorie(int $idCat){
        $req = $this->bdd->prepare('DELETE FROM categorie WHERE idCategorie = :id');
        $req->bindValue(':id',$idCat);
        $req->execute();
    }
    
}

?>