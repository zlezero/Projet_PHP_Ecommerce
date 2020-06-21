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
		$articles = $articlesManager->getAllArticles($defaultValue,true, $defaultValue,false, 1, 10000);
		$articles = $articlesManager->getAllArticlesAvecPagination();
		$plink = $articlesManager->prevlink;
		$nlink = $articlesManager->nextlink;
		$page  = $articlesManager->page;
		$pages = $articlesManager->pages;
		$categories = $categoriesManager->getAllCategories();

		if(empty($_SESSION["idCommande"])){
            $commandeManager=new CommandeManager();
            $_SESSION["idCommande"]= $commandeManager->addCommande()->getidCommande();
		}
		
		$this->render('index',[
			'articles' => $articles,
			'prevlink' => $plink,
			'nextlink' => $nlink,
			'page'     => $page,
			'pages'    => $pages,
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
				
				$articles = $articlesManager->getAllArticles($typeAffichage, true, $defaultValue, false, $min,$max);

				if($category) {
					$articles = $articlesManager->getAllArticles($typeAffichage, true, $category, true, $min,$max);
				} else {
					$articles = $articlesManager->getAllArticles($typeAffichage, true, $defaultValue, false, $min,$max);
				}
				
			} else if($category) {
				$articles = $articlesManager->getAllArticles($defaultValue, true, $category,true,$min,$max);
			} else {
				$articles = $articlesManager->getAllArticles($defaultValue, true, $defaultValue,false,$min,$max);
			}

			if($min) {
				$articles = $articlesManager->getAllArticlesMinMax($min, $max);
			}

		} else{
			$articles = $articlesManager->getAllArticles($defaultValue, true, $defaultValue, false, $min, $max);
		}

		$plink = $articlesManager->prevlink;
		$nlink = $articlesManager->nextlink;
		$page  = $articlesManager->page;
		$pages = $articlesManager->pages;

		$this->render('index', [
			'err' => $erreur ?? false,
			'articles' => $articles,
			'prevlink' => $plink,
			'nextlink' => $nlink,
			'page'     => $page,
			'pages'    => $pages,
			'categories' => $categories,
			'typeAffichage' => $typeAffichage ?? $defaultValue
		]);
			
	}
}