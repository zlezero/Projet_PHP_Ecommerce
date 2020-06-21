<?php

require_once("Controller.php");
require_once("models/class.ConfigArticles.php");
require_once("models/class.ArticlesManager.php");
require_once("models/class.CategorieManager.php");
require_once("models/class.PanierManager.php");

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

        } else {
            redirect("index.php");
        }
    }

    public function action_defineDefaultOrder(){
        
        if ($this->checkAdmin()) {

            $defaultOrd = htmlspecialchars($_GET['value']) ?? false;
            if($defaultOrd){
                $config = new ConfigArticles();
                $config->updateDefaultOrder($defaultOrd);
            }

            echo json_encode($defaultOrd);

        } else {
            echo json_encode("NOK");
        }

    }

    public function action_fetchArticle(){

        if ($this->checkAdmin()) {

            $article = false;

            if(!empty($_GET)) {
                $articlesOfManager = new ArticlesManager();
                $idArticle = htmlspecialchars($_GET['value']) ?? false;
                if($idArticle){
                    if($articlesOfManager->checkArticleExists($idArticle)){
                        $article = $articlesOfManager->getArticle($idArticle);
                    } 
                }
            }

            echo json_encode($article);

        } else {
            echo json_encode("NOK");
        }

    }

    public function action_addArticle(){

        if ($this->checkAdmin()) {

            if(!empty($_POST)) {

                $articlesOfManager = new ArticlesManager();
    
                $articleName = htmlspecialchars($_POST['nomArticle']) ?? false;
                $articleDescription = htmlspecialchars($_POST['descriptionArticle']) ?? false;
                $articleUrl = htmlspecialchars($_POST['urlPhoto']) ?? false;
                $articlePrice = htmlspecialchars($_POST['prix']) ?? false;
                $articleQuantity = htmlspecialchars($_POST['quantite']) ?? false;
                $idCategorie = htmlspecialchars($_POST['idCategorie']) ?? false;
                $articleCategorie = new Categorie(intval($idCategorie));
                
                if($articleName && $articleDescription && $articleUrl && $articlePrice && $articleQuantity && $articleCategorie){
                    if(is_numeric($articlePrice) && is_numeric($articleQuantity)){
                        $articlesOfManager->addArticle($articleName,$articleDescription,$articleUrl,floatval($articlePrice),intval($articleQuantity),$articleCategorie);
                        $message = "L'article a bien été ajouté.";
                    } else {
                        $message = "La quantité et le prix doivent être positifs.";
                    }
                } else {
                    $message = "Tous les champs ne sont pas remplis.";
                }

            } else {
                $message = "Arguments invalides";
            }

        } else {
            $message = "NOK";
        }

        echo json_encode($message);

    }

    public function action_updateArticle(){
        
        if ($this->checkAdmin()) {

            if(!empty($_POST)) {

                $articlesOfManager = new ArticlesManager();
    
                $idArticle = htmlspecialchars($_POST['idArticle']) ?? false;
                $newName = htmlspecialchars($_POST['nomArticle']) ?? false;
                $newDescription = htmlspecialchars($_POST['descriptionArticle']) ?? false;
                $newUrl = htmlspecialchars($_POST['urlPhoto']) ?? false;
                $newPrice = htmlspecialchars($_POST['prix']) ?? false;
                $newQuantity = htmlspecialchars($_POST['quantite']) ?? false;
                $newIdCategorie = htmlspecialchars($_POST['idCategorie']) ?? false;
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
                } else {
                    $message = "Tous les champs ne sont pas remplis.";
                }
            } else {
                $message = "Arguments invalides";
            }

        } else {
            $message = "NOK";
        }

        echo json_encode($message);

    }

	public function action_deleteArticle() {

        if ($this->checkAdmin()) {

            if(!empty($_GET)){
                $articlesOfManager = new ArticlesManager();
    
                $idArticle = htmlspecialchars($_GET['value']) ?? false;
    
                if($idArticle){
                    if($articlesOfManager->checkArticleExists($idArticle)){
                        $panierManager = new PanierManager();
                        if($panierManager->checkIfArticleDansPanier($idArticle)){
                            $message = "Cet article ne peut pas être supprimé car il dans une commande en cours.";
                        } else{
                            $articlesOfManager->deleteArticle($idArticle);
                            $message= "L'article a bien été supprimé.";
                        }
                    } else{
                        $message = "L'article que vous désirez supprimer n'existe pas.";
                    }
                }else{
                    $message = "Fournissez l'id de l'article que vous désirez supprimer.";
                }
            } else {
                $message = "Arguments invalides";
            }

        } else {
            $message = "NOK";
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