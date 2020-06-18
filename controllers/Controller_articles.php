<?php

require_once("Controller.php");
require_once("models/class.ConfigArticles.php");

class Controller_articles extends Controller {

	public function action_default() {
		$this->render('admin');
    }

    public function action_defineDefaultOrder(){
        
        // Check si admin est connecté
        $defaultOrd = $_GET['value'] ?? false;
        if($defaultOrd){
            $config = new ConfigArticles();
            $config->updateDefaultOrder($defaultOrd);
        }
        echo json_encode($defaultOrd);
    }

    public function action_addArticle(){

        // Check si admin est connecté
    }

    public function action_updateArticle(){
        
        // Check si admin est connecté
        if(!empty($_POST)){
            $articlesOfManager = new ArticlesManager();

            $newId = $_POST['idArticle'] ?? false;
            $newName = $_POST['nomArticle'] ?? false;
            $newDescription = $_POST['descriptionArticle'] ?? false;
            $newUrl = $_POST['urlPhoto'] ?? false;
            $newPrice = $_POST['prix'] ?? false;
            $newQuantity = $_POST['quantite'] ?? false;
            $newIdCategorie = $_POST['idCategorie'] ?? false;

            if($newId && $newName && $newDescription && $newUrl && $newPrice && $newQuantity && $newIdCategorie){

            } else{
                $erreur = "Tous les champs ne sont pas remplis.";
            }
        }
        $this->render('manager', [
            'err' => $erreur ?? false
        ]);
    }

	public function action_deleteArticle(){

        // Check si admin est connecté
        if(!empty($_POST)){
            $articlesOfManager = new ArticlesManager();

            $idArticle = $_POST['idArticle'] ?? false;

            if($idArticle){
                if($articlesOfManager->checkArticleExists($idArticle)){
                    $articlesOfManager->deleteArticle($idArticle);
                } else{
                    $erreur = "L'article que vous désirez supprimer n'existe pas";
                }
            }else{
                $erreur = "Fournissez l'id de l'article que vous désirez supprimer.";
            }
        }
        $this->render('manager', [
            'err' => $erreur ?? false
        ]);
    }

}