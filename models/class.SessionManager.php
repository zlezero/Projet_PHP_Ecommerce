<?php

require_once("Model.php");
require_once("class.User.php");

class SessionManager {
    
    private ?User $_User;

    public function __construct()
    {
        $this->_User = null;
    }

    public function login(string $email, string $mdp) : bool {

        $bdd = Model::getDatabase();
        
        $sql = "SELECT idUtilisateur, mdp FROM Utilisateur WHERE email = :email";

        $req = $bdd->prepare($sql);

        $req->bindValue('email', $email);
        $req->execute();

        $data = $req->fetch();

        if ($data !== false) {
            
            if (password_verify($mdp, $data["mdp"])) {
                
                $this->_User = new User($data["idUtilisateur"]);
                return true;

            } else {
                return false;
            }

        } else {
            return false;
        }

    }

    public function isConnected() : bool {
        return !is_null($this->_User);
    }

    public function isAdmin() : bool {
        return $this->isConnected() && $this->_User->getRole()->getNomRole() == "Administrateur";
    }

    public function disconnect() : bool {

        if ($this->isConnected()) {
            $this->_User = NULL;
            return true;
        } else {
            return false;
        }

    }

    public function getUser() : User {
        return $this->_User;
    }

}

?>