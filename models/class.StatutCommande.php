<?php

require_once("Model.php");

class StatutCommande {

    private int $_idStatutCommande;
    private string  $_nomStatutCommande;
    private PDO $bdd;

    public function __construct(int $id) {

        try {
        
            $this->bdd = Model::getDatabase();
        
            $req = $this->bdd->prepare("SELECT * FROM StatutCommande WHERE idStatutCommande = :id");
            $req->bindParam('id', $id);
    
            $req->execute();
            
            $data = $req->fetch();
    
            if (count($data) > 0) {

                $this->_idStatutCommande = $id;
                $this->_nomStatutCommande = $data["nomStatutCommande"];

            } else {
                throw new Exception("Aucun statut de commande n'existe avec cet identifiant");
            }

        } catch (Exception $e) {
            throw new Exception($e);
        }

    }

    public function getidStatutCommande() {
        return $this->_idStatutCommande;
    }

    public function getNomStatutCommande() {
        return $this->_nomStatutCommande;
    }


    public function setNomStatutCommande(string $nomStatutCommande) {
        $this->_nomStatutCommande = $nomStatutCommande;
    }

}

?>