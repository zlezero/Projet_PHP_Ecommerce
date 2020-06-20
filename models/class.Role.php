<?php

require_once("Model.php");

class Role {

    private int $_idRole;
    private string $_nomRole;

    public function __construct(int $idRole) {

        try {
        
            $bdd = Model::getDatabase();
        
            $req = $bdd->prepare("SELECT * FROM role WHERE idRole = :id");
            $req->bindParam('id', $idRole);
    
            $req->execute();
            
            $data = $req->fetch();
    
            if ($data !== false) {
                $this->_idRole = $idRole;
                $this->_nomRole = $data["nomRole"];
            } else {
                throw new Exception("Aucun rôle n'existe avec cet identifiant");
            }

        } catch (Exception $e) {
            throw new Exception($e);
        }

    }

    public function getIdRole() {
        return $this->_idRole;
    }

    public function getNomRole() {
        return $this->_nomRole;
    }
    
    public function setNomRole(string $nomRole) {
        $this->_nomRole = $nomRole;
    }

}

?>