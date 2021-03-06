<?php

require_once("Model.php");

class UserManager {

    private PDO $bdd;

    public function __construct() {
        $this->bdd = Model::getDatabase();
    }

    public function addUser(string $nom, string $prenom, string $email, string $mdp, Role $role, CB $cb = null) {

        if (!$this->userExist($email)) {

            $sql = "INSERT INTO Utilisateur(nom, prenom, email, mdp, idRole, idCB) VALUES(:nom, :prenom, :email, :mdp, :idRole, :idCB)";

            $req = $this->bdd->prepare($sql);
    
            $req->bindValue('nom', $nom);
            $req->bindValue('prenom', $prenom);
            $req->bindValue('email', $email);
            $req->bindValue('mdp', password_hash($mdp, PASSWORD_DEFAULT));
            $req->bindValue('idRole', $role->getIdRole());

            if (!is_null($cb)) {
                $req->bindValue('idCB', $cb->getIdCB());
            } else {
                $req->bindValue('idCB', NULL);
            }
    
            $req->execute();
    
            return new User((intVal($this->bdd->lastInsertId())));

        } else {
            return false;
        }

    }

    public function updateUser(User $user) {

        $sql = "UPDATE Utilisateur SET nom = :nom, prenom = :prenom, email = :email, idRole = :idRole, idCB = :idCB WHERE idUtilisateur = :idUtilisateur";

        $req = $this->bdd->prepare($sql);

        $req->bindValue('nom', $user->getNom());
        $req->bindValue('prenom', $user->getPrenom());
        $req->bindValue('email', $user->getEmail());
        $req->bindValue('idRole', $user->getRole()->getIdRole());
        $req->bindValue('idCB', $user->getCB()->getIdCB());
        $req->bindValue('idUtilisateur', $user->getIdUtilisateur());

        $req->execute();

    }

    public function updateMdp(int $idUtilisateur, string $mdp) {

        $sql = "UPDATE Utilisateur SET mdp = :mdp WHERE idUtilisateur = :idUtilisateur";

        $req = $this->bdd->prepare($sql);

        $req->bindValue('mdp', password_hash($mdp, PASSWORD_DEFAULT));
        $req->bindValue('idUtilisateur', $idUtilisateur);

        $req->execute();

    }

    public function deleteUser(int $idUtilisateur) {

        $sql = "DELETE FROM Utilisateur WHERE idUtilisateur = :idUtilisateur";

        $req = $this->bdd->prepare($sql);
        $req->bindValue('idUtilisateur', $idUtilisateur);

        $req->execute();

    }

    public function userExist(string $email) : bool {

        $sql = "SELECT idUtilisateur FROM Utilisateur WHERE email = :email";

        $req = $this->bdd->prepare($sql);

        $req->bindValue('email', $email);
        $req->execute();

        $data = $req->fetch();

        return $data !== false;

    }

}


?>