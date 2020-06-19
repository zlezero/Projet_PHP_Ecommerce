<?php

require_once("Model.php");
require_once("class.StatutCommande.php");
require_once("class.User.php");
require_once("class.PanierManager.php");

class Commande {

    private ?User $_user;
    private int $_idCommande;
    private StatutCommande $_statutCommande;
    private array $_articles;
    private PDO $bdd;
    public function __construct(int $idCommande) {

        try {
        
            $this->bdd = Model::getDatabase();
        
            $req = $this->bdd->prepare("SELECT * FROM Commande WHERE idCommande = :idCommande");
            $req->bindParam('idCommande', $idCommande);
    
            $req->execute();
            
            $data = $req->fetch();
    
            if (count($data) > 0) {
                $panierManager = new PanierManager();
                $this->_idCommande = $idCommande;
                $this->_user =$data["idUtilisateur"]? new User($data["idUtilisateur"]) : null;
                $this->_statutCommande = new StatutCommande($data["idStatutCommande"]);
                $this->_articles=$panierManager->getAll($idCommande);
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

    public function getStatutCommande() {
        return $this->_statutCommande;
    }
    
    public function setUser(User $user) {
        $this->_user = $user;
    }

    public function setStatutCommande(StatutCommande $statutCommande) {
        $this->_statutCommande = $statutCommande;
    }
    
}

?>