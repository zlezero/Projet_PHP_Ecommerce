<?php

require_once("Model.php");
require_once("class.StatutCommande.php");
require_once("class.User.php");
require_once("class.PanierManager.php");

class Commande {

    private ?User $_user;
    private int $_idCommande;
    private StatutCommande $_statutCommande;
    private DateTime $_dateCommande;
    private array $_articles;
    private PDO $bdd;
    private string $_cookieUtilisateur;
    
    public function __construct(int $idCommande) {

        try {
        
            $this->bdd = Model::getDatabase();
        
            $req = $this->bdd->prepare("SELECT * FROM Commande WHERE idCommande = :idCommande");
            $req->bindParam('idCommande', $idCommande);
    
            $req->execute();
            
            $data = $req->fetch();
    
            if ($data !== false) {
                $panierManager = new PanierManager();
                $this->_idCommande = $idCommande;
                $this->_user =$data["idUtilisateur"]? new User($data["idUtilisateur"]) : null;
                $this->_dateCommande=new DateTime($data["dateCommande"]);
                $this->_statutCommande = new StatutCommande($data["idStatutCommande"]);
                $this->_articles=$panierManager->getAll($idCommande);
                $this->_cookieUtilisateur = $data["cookieUtilisateur"];
            } else {
                throw new Exception("Aucune commande n'existe avec cet identifiant");
            }

        } catch (Exception $e) {
            throw new Exception($e);
        }

    }

    public function getidCommande() {
        return $this->_idCommande;
    }

    public function getUser() {
        return $this->_user;
    }
    public function getArticles() {
        return $this->_articles;
    }
    public function getDateCommande() {
        return $this->_dateCommande;
    }
    public function getStatutCommande() {
        return $this->_statutCommande;
    }
    
    public function setUser(User $user) {
        $this->_user = $user;
    }

    public function setStatutCommande(StatutCommande $statutCommande) {
        $this->_statutCommande = $statutCommande;
    }

    public function getCookieUtilisateur() {
        return $this->_cookieUtilisateur;
    }

    public function getMontantTotalPanier() : int {
        
        $montantTotal = 0;
        
        foreach($this->_articles as $article) {
            $montantTotal += $article->getArticle()->getPrixArticle();
        }

        return $montantTotal;

    }
    
}

?>