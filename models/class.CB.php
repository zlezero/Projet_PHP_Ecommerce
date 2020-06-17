<?php

class CB {
    
    private int $_idCB;
    private int $_numCB;
    private DateTime $_dateExpirationCB;
    private int $_cryptoCB;

    private $bdd;

    public function __construct(int $idCB) {

        try {
        
            $this->bdd = Model::getDatabase();
        
            $req = $this->bdd->prepare("SELECT * FROM cb WHERE idCB = :id");
            $req->bindParam('id', $idCB);
    
            $req->execute();
            
            $data = $req->fetch();
    
            if (count($data) > 0) {        
                $this->_idCB = $idCB;
                $this->_numCB = $data["numCB"];
                $this->_dateExpirationCB = new DateTime($data["dateExpirationCB"]);
                $this->_cryptoCB = $data["cryptoCB"];
            } else {
                throw new Exception("Aucune CB n'existe avec cet identifiant");
            }

        } catch (Exception $e) {
            throw new Exception($e);
        }

    }

}


?>