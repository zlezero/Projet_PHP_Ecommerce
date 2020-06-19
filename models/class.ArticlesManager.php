<?php 
require_once('Model.php');
require_once('class.Article.php');

class ArticlesManager{

    private $bdd;

    public function __construct()
    {
        $this->bdd = Model::getDatabase();
    }

    public function getAllArticles(string $typeAffichage, bool $afficherQuantitePositive) {

        if($afficherQuantitePositive){
            $sql = "SELECT * FROM article WHERE quantite > 0";
        }else{
            $sql = "SELECT * FROM article";
        }

        switch ($typeAffichage) {
            case "nomCroissant":
                $sql .= " ORDER BY nomArticle";
                break;
            case "nomDecroissant":
                $sql .= " ORDER BY nomArticle DESC";
                break;
            case "prixCroissant":
                $sql .= " ORDER BY prix";
                break;
            case "prixDecroissant":
                $sql .= " ORDER BY prix DESC";
                break;
        }
    
        $req = $this->bdd->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function getArticlesInfos(string $typeAffichage){

        switch ($typeAffichage) {
            case "nomCroissant":
                $sql = " SELECT * FROM article ORDER BY nomArticle";
                break;
            case "nomDecroissant":
                $sql = " SELECT * FROM article ORDER BY nomArticle DESC";
                break;
            case "prixCroissant":
                $sql = " SELECT * FROM article ORDER BY prix";
                break;
            case "prixDecroissant":
                $sql = " SELECT * FROM article ORDER BY prix DESC";
                break;
        }
    
        $req = $this->bdd->prepare($sql);
        $req->execute();
        $data = $req->fetchAll();
        $resultat = array();
        foreach($data as $indice => $value){
            $article = new Article($value['idArticle']);
            array_push($resultat,$article);
        }
        return $resultat;
    }

    public function getArticle(int $id){
        $req = $this->bdd->prepare('SELECT * FROM article WHERE idArticle = :id');
        $req->bindValue(':id',$id);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function addArticle(string $nomArticle, string $descriptionArticle,string $urlPhoto, float $prix, int $quantite, Categorie $categorie){
        $req = $this->bdd->prepare('INSERT INTO article (nomArticle, descriptionArticle, urlPhoto, prix, quantite, idCategorie) VALUES (:nom, :descriptionArticle, :urlPhoto, :prix, :quantite, :idCat)');
        $req->bindValue(':nom',$nomArticle);
        $req->bindValue(':descriptionArticle',$descriptionArticle);
        $req->bindValue(':urlPhoto',$urlPhoto);
        $req->bindValue(':prix',$prix);
        $req->bindValue(':quantite',$quantite);
        $req->bindValue(':idCat',$categorie['idCategorie']);
        $req->execute();
        return new Article(intVal($this->bdd->lastInsertId()));
    }

    public function deleteArticle(int $id){
        $req = $this->bdd->prepare('DELETE FROM article WHERE idArticle = :id');
        $req->bindValue(':id',$id);
        $req->execute();
    }

    public function updateArticle(Article $article){
        $req = $this->bdd->prepare('UPDATE article SET nomArticle = :nom, descriptionArticle = :descriptionArticle, urlPhoto = :urlPhoto, prix = :prix, quantite = :quantite, idCategorie = :idCat WHERE idArticle = :id');
        $req->bindValue(':id',$article->getIdArticle());
        $req->bindValue(':nom',$article['nomArticle']);
        $req->bindValue(':descriptionArticle',$article['descriptionArticle']);
        $req->bindValue(':urlPhoto',$article['urlPhoto']);
        $req->bindValue(':prix',$article['prix']);
        $req->bindValue(':quantite',$article['quantite']);
        $req->bindValue(':idCat',$article['categorie']['idCategorie']);
        $req->execute();
    }

    public function checkArticleExists(int $id){
        return $this->getArticle($id) !== false;
    }
}
?>