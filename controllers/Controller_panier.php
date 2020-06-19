<?php

require_once("Controller.php");
require_once("models/class.PanierManager.php");
require_once("models/class.Panier.php");
class Controller_panier extends Controller {

	public function action_default() {
		$this->render('index');
    }

    public function action_addPanier(){
        if(isset($_POST['idCommande']) && isset($_POST['idArticle']) ){
            $panierManager = new PanierManager();
            if(!$panierManager->panierExist($_POST['idCommande'],$_POST['idArticle'])){
                $panierManager->addPanier($_POST['idCommande'],$_POST['idArticle']);
            }else{
                $panier=new Panier($_POST['idCommande'],$_POST['idArticle']);
                $panier->setQuantite($panier->getQuantite()+1);
                $panierManager->updatePanier($panier);
            }
        }
    }

    public function action_remove1Panier(){
        if(isset($_POST['idCommande']) && isset($_POST['idArticle']) ){
            $panierManager = new PanierManager();
            if(!$panierManager->panierExist($_POST['idCommande'],$_POST['idArticle'])){
                throw new Exception("L'article n'appartient pas au panier");
            }else{
                $panier=new Panier($_POST['idCommande'],$_POST['idArticle']);
                if($panier->getQuantite()==1){
                    $panierManager->deletePanier($_POST['idCommande'],$_POST['idArticle']);
                }else{
                    $panier->setQuantite($panier->getQuantite()-1);
                    $panierManager->updatePanier($panier);
                }
            }
        }
    }

    public function action_deletePanier(){
        if(isset($_POST['idCommande']) && isset($_POST['idArticle']) ){
            $panierManager = new PanierManager();
            if(!$panierManager->panierExist($_POST['idCommande'],$_POST['idArticle'])){
                throw new Exception("L'article n'appartient pas au panier");
            }else{
                $panierManager->deletePanier($_POST['idCommande'],$_POST['idArticle']);
            }
        }
    }

}