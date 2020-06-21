<?php
require_once('Model.php');
require_once('class.Categorie.php');

class Article {

    private  $idArticle;
    private  $nomArticle;
    private  $descriptionArticle;
    private  $urlPhoto;
    private  $prix;
    private  $quantite;
    private  $categorie;

    private $bdd;

    public function __construct(int $id){

        try{

            $this->bdd = Model::getDatabase();
            $req = $this->bdd->prepare('SELECT * FROM article WHERE idArticle = :id');
            $req->bindValue(':id',$id);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);

            if(count($data)>0){
                $this->idArticle = $data['idArticle'];
                $this->nomArticle = $data['nomArticle'];
                $this->descriptionArticle = $data['descriptionArticle'];
                $this->urlPhoto = $data['urlPhoto'];
                $this->prix = $data['prix'];
                $this->quantite = $data['quantite'];
                $this->categorie = new Categorie($data['idCategorie']);
            } else {
                throw new Exception("Aucun article n'existe avec cet identifiant.");
            }
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

  
    public function getIdArticle(){
        return $this->idArticle;
    }

    public function getNomArticle(){
        return $this->nomArticle;
    }

    public function getDescriptionArticle(){
        return $this->descriptionArticle;
    }

    public function getUrlPhotoArticle(){
        return $this->urlPhoto;
    }

    public function getPrixArticle(){
        return $this->prix;
    }

    public function getQuantiteArticle(){
        return $this->quantite;
    }

    public function getCategorieArticle(){
        return $this->categorie;
    }

    public function setNomArticle(string $nom){
        $this->nomArticle = $nom;
    }

    public function setDescriptionArticle(string $description){
        $this->descriptionArticle = $description;
    }

    public function setUrlPhotoArticle(string $url){
        $this->urlPhoto = $url;
    }

    public function setPrixArticle(float $prix){
        $this->prix = $prix;
    }

    public function setQuantiteArticle(int $quantite){
        $this->quantite = $quantite;
    }

    public function setCategorieArticle(Categorie $categorie){
        $this->categorie = $categorie;
    }


}

?>