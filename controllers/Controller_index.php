<?php

require_once("Controller.php");
require_once("models/class.ArticlesManager.php");
require_once("models/class.CommandeManager.php");
require_once("models/class.ConfigArticles.php");

class Controller_index extends Controller {

	public function action_default() {
		$this->action_index();
	}

	public function action_index() {

		$articlesManager = new ArticlesManager();
		$configOrder = new ConfigArticles();
		$defaultValue = $configOrder->getDefaultOrder();
		$articles = $articlesManager->getAllArticles($defaultValue,true);
		if(empty($_SESSION["idCommande"])){
            $commandeManager=new CommandeManager();
            $_SESSION["idCommande"]= $commandeManager->addCommande()->getidCommande();
        }
		$this->render('index',[
			'articles' => $articles,
			'typeAffichage'=> $defaultValue
		]);
	}

	public function action_orderBy(){

		$articlesManager = new ArticlesManager();
		$configOrder = new ConfigArticles();
		$defaultValue = $configOrder->getDefaultOrder();

		if(!empty($_POST)){

			$typeAffichage = $_POST['ordreSelect'] ?? false;

			if($typeAffichage){
				$articles = $articlesManager->getAllArticles($typeAffichage,true);
			} else{
				$articles = $articlesManager->getAllArticles($defaultValue,true);	
			}	
		} else{
			$articles = $articlesManager->getAllArticles($defaultValue,true);	
		}

		$this->render('index', [
			'err' => $erreur ?? false,
			'articles' => $articles,
			'typeAffichage' => $typeAffichage ?? $defaultValue
        ]);
	}
}