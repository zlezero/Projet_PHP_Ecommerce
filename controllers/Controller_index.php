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

		if (!$this->getSessionManager()->isAdmin()) {

			$articlesManager = new ArticlesManager();
			$categoriesManager = new CategorieManager();
			$configOrder = new ConfigArticles();
			$defaultValue = $configOrder->getDefaultOrder();
			$defaultCategorie= -1;
			$articles = $articlesManager->getAllArticles($defaultValue,true, $defaultCategorie,false, 1, 10000);
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

		} else {
			redirect("index.php?controller=articles");
		}

	}


	public function action_orderBy() {

		$articlesManager = new ArticlesManager();
		$configOrder = new ConfigArticles();
		$categoriesManager = new CategorieManager();

		$defaultValue = $configOrder->getDefaultOrder();
		$defaultCategorie = -1;
		$categories = $categoriesManager->getAllCategories();

		if(!empty($_GET)){

			if (isset($_GET["tri"])) {
				$typeAffichage = $_GET["tri"];
			} else {
				$typeAffichage = $_GET['ordreSelect'] ?? false;
			}

			$category = $_GET['idCategory'] ?? false;

			$min = $_GET['min'] ?? false;
			$max = $_GET['max'] ?? false;

			if(is_numeric($category)){
				$category = intval($category);
			}else{
				$category = -1;
			}

			if (is_numeric($min))
				$min = intval($min);
			else
				$min = 0;
			

			if (is_numeric($max))
				$max = intval($max);
			else
				$max = 10000000;

			if($typeAffichage) {

				if($category>0) {
					$articles = $articlesManager->getAllArticles($typeAffichage, true, $category, true, $min,$max);
				} else {
					$articles = $articlesManager->getAllArticles($typeAffichage, true, $defaultCategorie, false, $min,$max);
				}
				
			} else if($category>0) {
				$articles = $articlesManager->getAllArticles($defaultValue, true, $category, true,$min,$max);
			} else {
				$articles = $articlesManager->getAllArticles($defaultValue, true, $defaultCategorie, false, $min, $max);
			}

		} else{
			$articles = $articlesManager->getAllArticles($defaultValue, true, $defaultCategorie, false, 0, 10000000);
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