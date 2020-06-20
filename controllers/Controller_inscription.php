<?php

require_once("Controller.php");

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

        } else {
            
        }

    }


}


?>