<?php

require_once("Controller.php");
require_once("models/class.ArticlesManager.php");

class Controller_index extends Controller {

	public function action_default() {
		$this->action_index();
	}

	public function action_index() {

		$articlesManager = new ArticlesManager();
		$articles = $articlesManager->getAllArticles("defaultvaLue",true,"defaultvaLue",false);
		$this->render('index',[
			'articles' => $articles
		]);

	}

	public function action_orderBy(){
		$articlesManager = new ArticlesManager();
		if(!empty($_POST)){
			$typeAffichage = $_POST['ordreSelect'] ?? false;
			$category = $_POST['category'] ?? false;
			$min = $_POST['min'] ?? false;
			$max = $_POST['max'] ?? false;

			if($typeAffichage){
				if($category){
					$articles = $articlesManager->getAllArticles($typeAffichage,true,$category,true);
				} else{
					$articles = $articlesManager->getAllArticles($typeAffichage,true,"defaultvaLue",false);
				}
			} else if($category){
					$articles = $articlesManager->getAllArticles("defaultvaLue",true,$category,true);
				  }else{
					$articles = $articlesManager->getAllArticles("defaultvaLue",true,"defaultvaLue",false);

				}
				if($min){
					$articles = $articlesManager->getAllArticlesMinMax($min,$max);
				}
				$this->render('index', [
				'err' => $erreur ?? false,
				'articles' => $articles
        		]);
		}
	}
}