<?php

require_once("Controller_commande.php");
require_once("models/class.UserManager.php");
require_once("models/class.ArticlesManager.php");
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
        $commandeManager = new CommandeManager();
        $commande=new Commande($_SESSION["idCommande"]);
        $commande->setStatutCommande(new StatutCommande(2));
        $commandeManager->updateStatutCommande($commande);
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
    
                        
                        if(empty($_SESSION["idCommande"])){
                            $_SESSION["cbErreurSurvenue"];
                            $this->render("payement");
                            exit;
                        }
                        $commande->setStatutCommande(new StatutCommande(3));
                        $articleManager = new ArticlesManager();
                        $commandeManager->updateStatutCommande($commande);
                            foreach($commande->getArticles() as $article){
                                $article->getArticle()->setQuantiteArticle($article->getArticle()->getQuantiteArticle()-$article->getQuantite());
                                $articleManager->updateArticle($article->getArticle());
                            }
                        $commandeNew = $commandeManager->addCommande();
                        $_SESSION["idCommande"]=$commandeNew->getidCommande();
                        $commandeNew->setUser($this->getSessionManager()->getUser());
                        $commandeManager->updateUserCommande($commandeNew);
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