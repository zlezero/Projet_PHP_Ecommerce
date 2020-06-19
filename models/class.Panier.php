<?php

require_once("Model.php");
require_once("class.Commande.php");
require_once("class.Article.php");

class Panier {

    private int $_idCommande;
    private Article $_article;
    private int $_quantite;
    private PDO $bdd;

    public function __construct(int $idCommande, int $idArticle) {

        try {
        
            $this->bdd = Model::getDatabase();
        
            $req = $this->bdd->prepare("SELECT * FROM Panier WHERE idArticle = :idArticle and idCommande = :idCommande");
            $req->bindParam('idCommande', $idCommande);
            $req->bindParam('idArticle', $idArticle);
    
            $req->execute();
            
            $data = $req->fetch();
    
            if (count($data) > 0) {

                $this->_quantite = $data["quantite"];
                $this->_article = new Article($idArticle);
                $this->_idCommande = $idCommande;
        
            } else {
                throw new Exception("Cette article n'appartient pas à cette commande où celle-ci n'existe pas");
            }

        } catch (Exception $e) {
            throw new Exception($e);
        }

    }

    public function getIdCommande() {
        return $this->_idCommande;
    }

    public function getArticle() {
        return $this->_article;
    }

    public function getQuantite() {
        return $this->_quantite;
    }

    public function setIdCommande(Commande $idCommande) {
        $this->_idCommande = $idCommande;
    }

    public function setArticle(Article $article) {
        $this->_article = $article;
    }

    public function setQuantite(int $quantite) {
        $this->_quantite = $quantite;
    }
    
}

?>