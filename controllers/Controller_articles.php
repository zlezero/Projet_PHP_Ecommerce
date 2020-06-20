<?php

require_once("Controller.php");
require_once("models/class.ConfigArticles.php");
require_once("models/class.ArticlesManager.php");
require_once("models/class.CategorieManager.php");

class Controller_articles extends Controller {

	public function action_default() {
		$this->action_admin();
    }

    public function action_admin(){
        if ($this->checkAdmin()) { 
            $articlesManager = new ArticlesManager();
            $categoriesManager = new CategorieManager();
            $configOrder = new ConfigArticles();
            $defaultValue = $configOrder->getDefaultOrder();
            $allArticles = $articlesManager->getArticlesInfos($defaultValue);
            $categories = $categoriesManager->getAllCategories();
            $this->render('admin',[
                'articles' => $allArticles,
                'categories'=> $categories,
                'typeAffichage'=> $defaultValue
            ]);
        }
    }

    public function action_defineDefaultOrder(){
        
        if ($this->checkAdmin()) {
            $defaultOrd = $_GET['value'] ?? false;
            if($defaultOrd){
                $config = new ConfigArticles();
                $config->updateDefaultOrder($defaultOrd);
            }

        }
        echo json_encode($defaultOrd);
    }

    public function action_fetchArticle(){

        $article = false;
        if(!empty($_GET)){
            $articlesOfManager = new ArticlesManager();
            $idArticle = $_GET['value'] ?? false;
            if($idArticle){
                if($articlesOfManager->checkArticleExists($idArticle)){
                    $article = $articlesOfManager->getArticle($idArticle);
                } 
            }
        }
        echo json_encode($article);

    }

    public function action_addArticle(){

        #TO DO Check si admin est connecté
        if(!empty($_POST)){
            
            $articlesOfManager = new ArticlesManager();

            $articleName = $_POST['nomArticle'] ?? false;
            $articleDescription = $_POST['descriptionArticle'] ?? false;
            $articleUrl = $_POST['urlPhoto'] ?? false;
            $articlePrice = $_POST['prix'] ?? false;
            $articleQuantity = $_POST['quantite'] ?? false;
            $idCategorie = $_POST['idCategorie'] ?? false;
            $articleCategorie = new Categorie(intval($idCategorie));
            
            if($articleName && $articleDescription && $articleUrl && $articlePrice && $articleQuantity && $articleCategorie){
                if(is_numeric($articlePrice) && is_numeric($articleQuantity)){
                    $articlesOfManager->addArticle($articleName,$articleDescription,$articleUrl,floatval($articlePrice),intval($articleQuantity),$articleCategorie);
                    $message = "L'article a bien été ajouté.";
                } else{
                    $message = "La quantité et le prix doivent être positifs.";
                }
            } else{
                $message = "Tous les champs ne sont pas remplis.";
            }
        }
        echo json_encode($message);
    }

    public function action_updateArticle(){
        
        #TO DO Check si admin est connecté
        if(!empty($_POST)){
            $articlesOfManager = new ArticlesManager();

            $idArticle = $_POST['idArticle'] ?? false;
            $newName = $_POST['nomArticle'] ?? false;
            $newDescription = $_POST['descriptionArticle'] ?? false;
            $newUrl = $_POST['urlPhoto'] ?? false;
            $newPrice = $_POST['prix'] ?? false;
            $newQuantity = $_POST['quantite'] ?? false;
            $newIdCategorie = $_POST['idCategorie'] ?? false;
            $newArticleCategorie = new Categorie(intval($newIdCategorie));

            if($idArticle && $newName && $newDescription && $newUrl && $newPrice && $newQuantity && $newArticleCategorie){
                $article = new Article($idArticle);
                $article->setNomArticle($newName);
                $article->setDescriptionArticle($newDescription);
                $article->setUrlPhotoArticle($newUrl);
                $article->setPrixArticle($newPrice);
                $article->setQuantiteArticle($newQuantity);
                $article->setCategorieArticle($newArticleCategorie);
                $articlesOfManager->updateArticle($article);
                $message="La mise à jour de l'article s'est bien passé.";
            } else{
                $message = "Tous les champs ne sont pas remplis.";
            }
        }
        echo json_encode($message);

    }

	public function action_deleteArticle() {

        #TO DO Check si admin est connecté
        if(!empty($_GET)){
            $articlesOfManager = new ArticlesManager();

            $idArticle = $_GET['value'] ?? false;

            if($idArticle){
                if($articlesOfManager->checkArticleExists($idArticle)){
                    #TO DO check if article not in commande
                    $articlesOfManager->deleteArticle($idArticle);
                    $message= "L'article a bien été supprimé.";
                } else{
                    $message = "L'article que vous désirez supprimer n'existe pas.";
                }
            }else{
                $message = "Fournissez l'id de l'article que vous désirez supprimer.";
            }
        }
        echo json_encode($message);
    }

    private function checkAdmin() {

        if (isset($_SESSION['sessionManager'])) {
            if ($this->getSessionManager()->isAdmin()) {
                return true;
            }
        }

        redirect("index.php");

    }

}