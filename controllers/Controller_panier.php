<?php

require_once("Controller.php");
require_once("models/class.PanierManager.php");
require_once("models/class.Panier.php");

class Controller_panier extends Controller {

	public function action_default() {}

    public function action_addPanier(){
        
        if (!$this->getSessionManager()->isAdmin()) {

            if(isset($_POST['idCommande']) && isset($_POST['idArticle']) ){
                $panierManager = new PanierManager();
                if(!$panierManager->panierExist(htmlspecialchars($_POST['idCommande']),htmlspecialchars($_POST['idArticle']))){
                    $panierManager->addPanier(htmlspecialchars($_POST['idCommande']),htmlspecialchars($_POST['idArticle']));
                }else{
                    $panier=new Panier(htmlspecialchars($_POST['idCommande']),htmlspecialchars($_POST['idArticle']));
                    $panier->setQuantite($panier->getQuantite()+1);
                    $panierManager->updatePanier($panier);
                }
            }

        } else {
            redirect("index.php");
        }

    }

    public function action_remove1Panier() {

        if (!$this->getSessionManager()->isAdmin()) { 

            if(isset($_POST['idCommande']) && isset($_POST['idArticle']) ){
                $panierManager = new PanierManager();
                if(!$panierManager->panierExist(htmlspecialchars($_POST['idCommande']),htmlspecialchars($_POST['idArticle']))){
                    throw new Exception("L'article n'appartient pas au panier");
                }else{
                    $panier=new Panier(htmlspecialchars($_POST['idCommande']),htmlspecialchars($_POST['idArticle']));
                    if($panier->getQuantite()==1){
                        $panier=new Panier(htmlspecialchars($_POST['idCommande']),htmlspecialchars($_POST['idArticle']));
                        $panierManager->deletePanier($panier);
                    }else{
                        $panier->setQuantite($panier->getQuantite()-1);
                        $panierManager->updatePanier($panier);
                    }
                }
            }

        } else {
            redirect("index.php");
        }

    }

    public function action_deletePanier(){

        if (!$this->getSessionManager()->isAdmin()) {

            if(isset($_POST['idCommande']) && isset($_POST['idArticle']) ){
                $panierManager = new PanierManager();
                if(!$panierManager->panierExist(htmlspecialchars($_POST['idCommande']),htmlspecialchars($_POST['idArticle']))){
                    throw new Exception("L'article n'appartient pas au panier");
                }else{
                    $panier=new Panier(htmlspecialchars($_POST['idCommande']),htmlspecialchars($_POST['idArticle']));
                    $panierManager->deletePanier($panier);
                }
            }

        }  else {
            redirect("index.php");
        }

    }

}