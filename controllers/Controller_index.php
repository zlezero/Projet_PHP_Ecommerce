<?php

require_once("Controller.php");
require_once("models/class.ArticlesManager.php");

class Controller_index extends Controller {

	public function action_default() {
		$this->action_index();
	}

	public function action_index() {

		$articlesManager = new ArticlesManager();
		$articles = $articlesManager->getAllArticles("defaultvaLue",true);
		$this->render('index',[
			'articles' => $articles
		]);

	}

	public function action_orderBy(){
		$articlesManager = new ArticlesManager();
		if(!empty($_POST)){
			$typeAffichage = $_POST['ordreSelect'] ?? false;

			if($typeAffichage){
				$articles = $articlesManager->getAllArticles($typeAffichage,true);
			} else{
				$articles = $articlesManager->getAllArticles("defaultvaLue",true);	
			}	
		} else{
			$articles = $articlesManager->getAllArticles("defaultvaLue",true);
		}

		$this->render('index', [
			'err' => $erreur ?? false,
			'articles' => $articles
        ]);
	}
}