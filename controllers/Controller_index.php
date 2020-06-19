<?php

require_once("Controller.php");
require_once("models/class.ArticlesManager.php");
require_once("models/class.CommandeManager.php");
require_once("models/class.CategorieManager.php");
require_once("models/class.ConfigArticles.php");

class Controller_index extends Controller {

	public function action_default() {
		$this->action_index();
	}

	public function action_index() {

		$articlesManager = new ArticlesManager();
		$categoriesManager = new CategorieManager();
		$configOrder = new ConfigArticles();
		$defaultValue = $configOrder->getDefaultOrder();
		$articles = $articlesManager->getAllArticles($defaultValue,true, $defaultValue,false);
		$categories = $categoriesManager->getAllCategories();

		if(empty($_SESSION["idCommande"])){
            $commandeManager=new CommandeManager();
            $_SESSION["idCommande"]= $commandeManager->addCommande()->getidCommande();
		}
		
		$this->render('index',[
			'articles' => $articles,
			'categories' => $categories,
			'typeAffichage'=> $defaultValue
		]);
	}

	public function action_orderBy() {

		$articlesManager = new ArticlesManager();
		$configOrder = new ConfigArticles();
		$categoriesManager = new CategorieManager();

		$defaultValue = $configOrder->getDefaultOrder();
		$categories = $categoriesManager->getAllCategories();

		if(!empty($_POST)){

			$typeAffichage = $_POST['ordreSelect'] ?? false;
			$category = $_POST['category'] ?? false;
			$min = $_POST['min'] ?? false;
			$max = $_POST['max'] ?? false;

			if($typeAffichage) {
				
				$articles = $articlesManager->getAllArticles($typeAffichage, true, $defaultValue, false);

				if($category) {
					$articles = $articlesManager->getAllArticles($typeAffichage, true, $category, true);
				} else {
					$articles = $articlesManager->getAllArticles($typeAffichage, true, $defaultValue, false);
				}
				
			} else if($category) {
				$articles = $articlesManager->getAllArticles($defaultValue, true, $category,true);
			} else {
				$articles = $articlesManager->getAllArticles($defaultValue, true, $defaultValue,false);
			}

			if($min) {
				$articles = $articlesManager->getAllArticlesMinMax($min, $max);
			}

		} else{
			$articles = $articlesManager->getAllArticles($defaultValue, true, $defaultValue, false);	
		}

		$this->render('index', [
			'err' => $erreur ?? false,
			'articles' => $articles,
			'categories' => $categories,
			'typeAffichage' => $typeAffichage ?? $defaultValue
		]);
			
	}
}