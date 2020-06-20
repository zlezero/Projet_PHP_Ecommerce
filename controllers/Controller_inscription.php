<?php

require_once("Controller.php");
require_once("models/class.UserManager.php");

class Controller_inscription extends Controller {

    public function action_default() {
        
        if (!$this->getSessionManager()->isConnected()) {
            $this->render("inscription");
        } else {
            redirect("index.php");
        }

    }

    public function action_register() {

        if (checkParameter(["email", "prenom", "nom", "mdp", "mdpConfirmation"])) {

            $userManager = new UserManager();
            
            if ($_POST["mdp"] == $_POST["mdpConfirmation"]) {

                if ($userManager->addUser(htmlspecialchars($_POST["nom"]), htmlspecialchars($_POST["prenom"]), htmlspecialchars($_POST["email"]), htmlspecialchars($_POST["mdp"]), new Role(1)) !== false) {
                    $_SESSION["succes"] = sha1("inscriptionSucces");
                    redirect("index.php");
                } else {
                    $_SESSION["erreur"] = sha1("inscriptionErreurSurvenue");
                }

            } else {
                $_SESSION["erreur"] = sha1("inscriptionMdpNonCorrespondants");
            }

        } else {
            $_SESSION["erreur"] = sha1("inscriptionParametresInvalides");
        }

        redirect("index.php?controller=inscription");

    }


}


?>