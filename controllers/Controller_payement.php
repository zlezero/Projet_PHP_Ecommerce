<?php

require_once("Controller_commande.php");

class Controller_payement extends Controller {

    public function action_default()
    {
        if (!$this->getSessionManager()->isAdmin() && $this->getSessionManager()->isConnected()) {
            $this->render("payement");
        } else {
            redirect("index.php");
        }

    }

    public function action_payer() {

        if (!$this->getSessionManager()->isAdmin() && $this->getSessionManager()->isConnected()) {
            
            if (checkParameter(["cardNumber", "username", "expirationMois", "expirationAnnee", "CVV"])) {

                if (is_numeric($_POST["cardNumber"])) {
    
                    if (is_numeric($_POST["expirationMois"]) && is_numeric($_POST["expirationAnnee"])) {
    
                        if (isset($_POST["registerBankCard"])) {
                            //$this->getSessionManager()->
                        }
    
                        $commandeManager = new CommandeManager();
    
                        if(empty($_SESSION["idCommande"])){
                            $_SESSION["cbErreurSurvenue"];
                            $this->render("payement");
                            exit;
                        }
    
                        $commande=new Commande($_SESSION["idCommande"]);
                        $commande->setStatutCommande(new StatutCommande(2));
                        $commandeManager->updateStatutCommande($commande);
                        
                        $_SESSION["succes"] = sha1("cbCommandeSucces");
    
                        redirect("index.php");
    
                    } else {
                        $_SESSION["erreur"] = sha1("cbDateExipirationInvalide");
                    }
    
                } else {
                    $_SESSION["erreur"] = sha1("cbCardNumberIncorrect");
                }
    
            } else {
                $_SESSION["erreur"] = sha1("cbArgInvalides");
            }
    
            $this->render("payement");

        } else {
            redirect("index.php");
        }

    }

}