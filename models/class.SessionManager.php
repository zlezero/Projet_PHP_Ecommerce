<?php

require_once("Model.php");

class SessionManager {
    
    private ?User $_User;

    private PDO $bdd;

    public function __construct()
    {
        $this->bdd = Model::getDatabase();
        $this->_User = null;
    }

    public function login(string $email, string $mdp) : bool {

        $sql = "SELECT idUtilisateur, mdp FROM Utilisateur WHERE email = :email";

        $req = $this->bdd->prepare($sql);

        $req->bindValue('email', $email);
        $req->execute();

        $data = $req->fetch();

        if (count($data) > 0) {
            
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

    public function disconnect() : bool {

        if ($this->isConnected()) {
            $this->_User = NULL;
            return true;
        } else {
            return false;
        }

    }

}

?>