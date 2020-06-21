<?php

require_once("Controller.php");

class Controller_user extends Controller {

    public function action_default() {}

    public function action_login() {

        $message = "";

        if (isset($_POST['email']) && isset($_POST['mdp']) && !empty($_POST['email']) && !empty($_POST['mdp'])) {
            
            if (!is_null($this->getSessionManager())) {
                
                if ($this->getSessionManager()->login(htmlspecialchars($_POST['email']), htmlspecialchars($_POST['mdp']))) {

                    if ($this->getSessionManager()->isAdmin()) {
                        $message = "ADMIN";
                    }

                    $message = "OK";

                } else {
                    $message = "L'identifiant ou le mot de passe est invalide";
                }

            } else {
                $message = "Session non initialisée";
            }


        } else {
            $message = "Les paramètres envoyés sont invalides";
        }

        echo json_encode($message);

    }

    public function action_disconnect() {

        if (!is_null($this->getSessionManager())) {
            $this->getSessionManager()->disconnect();
            $message = "OK";
        } else {
            $message = "Session non initialisée";
        }

        echo json_encode($message);

    }

}


?>