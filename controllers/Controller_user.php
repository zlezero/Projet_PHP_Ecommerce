<?php

require_once("Controller.php");
require_once("models/class.Commande.php");
require_once("models/class.CommandeManager.php");
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
                    else{
                        $commande=new Commande($_SESSION["idCommande"]);
                        $commande->setUser($this->getSessionManager()->getUser());
                        $commandeManager =new CommandeManager();
                        $commandeManager->updateUserCommande($commande);
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
            $user = $this->getSessionManager()->getUser();
            $this->getSessionManager()->disconnect();
            $commandeManager=new CommandeManager();
            if($_SESSION["idCommande"]!=null){
                $commande=new Commande($_SESSION["idCommande"]);
                $commandeManager->deleteCommande($commande);
                $_SESSION["idCommande"]=null;
            }
            $_SESSION["idCommande"]=$commandeManager->addCommande()->getidCommande();
            $message = "OK";
        } else {
            $message = "Session non initialisée";
        }

        echo json_encode($message);

    }

}


?>