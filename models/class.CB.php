<?php

class CB {
    
    private int $_idCB;
    private string $_numCB;
    private string $_nomCompletCB;
    private DateTime $_dateExpirationCB;
    private int $_cryptoCB;

    public function __construct(int $idCB) {

        try {
            
            $bdd = Model::getDatabase();
        
            $req = $bdd->prepare("SELECT * FROM cb WHERE idCB = :id");
            $req->bindParam('id', $idCB);
    
            $req->execute();
            
            $data = $req->fetch();
    
            if ($data !== false) {
                $this->_idCB = $idCB;
                $this->_numCB = $data["numCB"];
                $this->_dateExpirationCB = new DateTime($data["dateExpirationCB"]);
                $this->_cryptoCB = $data["cryptoCB"];
                $this->_nomCompletCB = $data["nomCompletCB"];
            } else {
                throw new Exception("Aucune CB n'existe avec cet identifiant");
            }

        } catch (Exception $e) {
            throw new Exception($e);
        }

    }

    public function getIdCB() {
        return $this->_idCB;
    }

    public function getNumCB() {
        return $this->_numCB;
    }

    public function getDateExpirationCB() {
        return $this->_dateExpirationCB;
    }

    public function getCryptoCB() {
        return $this->_cryptoCB;
    }

    public function getNomCompletCB() {
        return $this->_nomCompletCB;
    }

}


?>