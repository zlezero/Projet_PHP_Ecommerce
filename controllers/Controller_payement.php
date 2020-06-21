<?php

require_once("Controller_commande.php");
require_once("models/class.UserManager.php");
require_once("models/class.CBManager.php");

class Controller_payement extends Controller {

    public function action_default()
    {
        if (!$this->getSessionManager()->isAdmin() && $this->getSessionManager()->isConnected()) {
            $this->render("payement");
        } else {
            $_SESSION["erreur"] = sha1("errorPayementNonLogged");
            redirect("index.php");
        }

    }

    public function action_payer() {

        if (!$this->getSessionManager()->isAdmin() && $this->getSessionManager()->isConnected()) {
            
            if (checkParameter(["cardNumber", "username", "expirationMois", "expirationAnnee", "CVV"])) {

                if (is_numeric($_POST["cardNumber"])) {
    
                    if (is_numeric($_POST["expirationMois"]) && is_numeric($_POST["expirationAnnee"])) {
    
                        if (isset($_POST["registerBankCard"])) {
                            $userManager = new UserManager();
                            $cbManager = new CBManager();

                            $CB = $cbManager->addCB(htmlspecialchars($_POST["cardNumber"]), htmlspecialchars($_POST["username"]), new DateTime(htmlspecialchars("01-".htmlspecialchars($_POST["expirationMois"])."-".htmlspecialchars($_POST["expirationAnnee"]))), $_POST["CVV"]);

                            if ($CB !== false) {
                                $this->getSessionManager()->getUser()->setCB($CB);
                            }
                            
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