<?php

require_once("Model.php");
require_once("class.Role.php");
require_once("class.CB.php");

class User {

    private int $_idUtilisateur;
    private string $_nom;
    private string $_prenom;
    private string $_email;
    private Role $_role;
    private CB $_CB;

    private PDO $bdd;

    public function __construct(int $idUser) {

        try {
        
            $this->bdd = Model::getDatabase();
        
            $req = $this->bdd->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = :id");
            $req->bindParam('id', $idUser);
    
            $req->execute();
            
            $data = $req->fetch();
    
            if (count($data) > 0) {

                $this->_idUtilisateur = $idUser;
                $this->_nom = $data["nom"];
                $this->_prenom = $data["prenom"];
                $this->_email = $data["email"];
                $this->_role = new Role($data["idRole"]);
                $this->_idCB = new CB($data["idCB"]);
        
            } else {
                throw new Exception("Aucun utilisateur n'existe avec cet identifiant");
            }

        } catch (Exception $e) {
            throw new Exception($e);
        }

    }

    public function getIdUtilisateur() {
        return $this->_idUtilisateur;
    }

    public function getNom() {
        return $this->_nom;
    }

    public function getPrenom() {
        return $this->_prenom;
    }

    public function getEmail() {
        return $this->_email;
    }

    public function getRole() {
        return $this->_role;
    }

    public function getCB() {
        return $this->_CB;
    }

    public function setNom(string $nom) {
        $this->_nom = $nom;
    }

    public function setPrenom(string $prenom) {
        $this->_prenom = $prenom;
    }

    public function setEmail(string $email) {
        $this->_email = $email;
    }

    public function setRole(Role $role) {
        $this->_role = $role;
    }

    public function setCB(CB $CB) {
        $this->_CB = $CB;
    }
    
}

?>