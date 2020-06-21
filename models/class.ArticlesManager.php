<?php 
require_once('Model.php');
require_once('class.Article.php');

class ArticlesManager{

    private $bdd;
    public $prevlink;
    public $nextlink;
    public $page;
    public $pages;

    public function __construct()
    {
        $this->bdd = Model::getDatabase();
    }

    public function getAllArticles(string $typeAffichage, bool $afficherQuantitePositive, int $categorie, $parCategorieUniquement, int $min, int $max){

        if($afficherQuantitePositive){
            $sql = "SELECT * FROM article WHERE quantite > 0";
        }else{
            $sql = "SELECT * FROM article";
        }

        if($parCategorieUniquement && $categorie != -1)
        { 
            $sql .= " and idCategorie = ".$categorie;
        }

        if($min && $max){
            $sql.= " and (prix between ".$min." and ".$max.")";
        }

        switch ($typeAffichage) {
            case "nomCroissant":
                $sql .= " ORDER BY nomArticle";
                break;
            case "nomDecroissant":
                $sql .= " ORDER BY nomArticle DESC";
                break;
            case "prixCroissant":
                $sql .= " ORDER BY prix";
                break;
            case "prixDecroissant":
                $sql .= " ORDER BY prix DESC";
                break;
        }

        $total = $this->bdd->query($sql)->rowCount();
        $limit = 10;
    
        $this->pages = ceil($total / $limit);
    
        $this->page = min($this->pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
            'options' => array(
                'default'   => 1,
                'min_range' => 1,
            ),
        )));
    
        if($this->page > 0)
        {
            $offset = ($this->page - 1)  * $limit;
            $start = $offset + 1;
            $end = min(($offset + $limit), $total);
        }else
        {
            $offset = 0;
            $start = $offset + 1;
            $end = min(($offset + $limit), $total);
        }

        $this->prevlink = ($this->page > 1) ? '<a class="page-link" href="?page=1" title="First page">&laquo;</a></li> <li class="page-item"><a class="page-link" href="?page=' . ($this->page - 1) . '" title="Previous page">&lsaquo;</a>' : '<a class="page-link" href="#" aria-label="Previous"><span class="disabled">&laquo;</span></a></li> <li class="page-item"><a class="page-link" href="#" aria-label="First Page"><span class="disabled">&lsaquo;</span></a>';
        $this->nextlink = ($this->page < $this->pages) ? '<a class="page-link" href="?page=' . ($this->page + 1) . '" title="Next page">&rsaquo;</a></li> <li class="page-item"><a class="page-link" href="?page=' . $this->pages . '" title="Last page">&raquo;</a>' : '<a class="page-link" href="#" aria-label="Next"><span class="disabled">&rsaquo;</span></a></li> <li class="page-item"><a class="page-link" href="#" aria-label="Last Page"><span class="disabled">&raquo;</span></a>';
    
        $sql .=" LIMIT :limit OFFSET :offset";
        $req = $this->bdd->prepare($sql);
        $req->bindValue(':limit', $limit, PDO::PARAM_INT);
        $req->bindValue(':offset', $offset, PDO::PARAM_INT);
        $req->execute();

        return $req->fetchAll();

    }

    public function getArticlesInfos(string $typeAffichage){

        switch ($typeAffichage) {
            case "nomCroissant":
                $sql = " SELECT * FROM article ORDER BY nomArticle";
                break;
            case "nomDecroissant":
                $sql = " SELECT * FROM article ORDER BY nomArticle DESC";
                break;
            case "prixCroissant":
                $sql = " SELECT * FROM article ORDER BY prix";
                break;
            case "prixDecroissant":
                $sql = " SELECT * FROM article ORDER BY prix DESC";
                break;
        }
    
        $req = $this->bdd->prepare($sql);
        $req->execute();
        $data = $req->fetchAll();
        $resultat = array();
        foreach($data as $indice => $value){
            $article = new Article($value['idArticle']);
            array_push($resultat,$article);
        }
        return $resultat;
    }

    public function getAllArticlesAvecPagination(){
        try {
            $total = $this->bdd->query('
                SELECT
                    COUNT(*)
                FROM
                    article
            ')->fetchColumn();
        
            $limit = 10;
        
            $this->pages = ceil($total / $limit);
        
            $this->page = min($this->pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
                'options' => array(
                    'default'   => 1,
                    'min_range' => 1,
                ),
            )));
        
            $offset = ($this->page - 1)  * $limit;
            $start = $offset + 1;
            $end = min(($offset + $limit), $total);

            if($this->page > 0) {
                $offset = ($this->page - 1)  * $limit;
                $start = $offset + 1;
                $end = min(($offset + $limit), $total);
            } else {
                $offset = 0;
                $start = $offset + 1;
                $end = min(($offset + $limit), $total);
            }

            $this->prevlink = ($this->page > 1) ? '<a class="page-link" href="?page=1" title="First page">&laquo;</a></li> <li class="page-item"><a class="page-link" href="?page=' . ($this->page - 1) . '" title="Previous page">&lsaquo;</a>' : '<a class="page-link" href="#" aria-label="Previous"><span class="disabled">&laquo;</span></a></li> <li class="page-item"><a class="page-link" href="#" aria-label="First Page"><span class="disabled">&lsaquo;</span></a>';
            $this->nextlink = ($this->page < $this->pages) ? '<a class="page-link" href="?page=' . ($this->page + 1) . '" title="Next page">&rsaquo;</a></li> <li class="page-item"><a class="page-link" href="?page=' . $this->pages . '" title="Last page">&raquo;</a>' : '<a class="page-link" href="#" aria-label="Next"><span class="disabled">&rsaquo;</span></a></li> <li class="page-item"><a class="page-link" href="#" aria-label="Last Page"><span class="disabled">&raquo;</span></a>';
        
            $stmt = $this->bdd->prepare('
                SELECT *  
                FROM article
                ORDER BY  idArticle
                LIMIT :limit
                OFFSET :offset
            ');
            
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

        return $stmt->fetchAll();

        } catch (Exception $e) {
            echo '<p>', $e->getMessage(), '</p>';
        }
        
    }

    public function getArticle(int $id){
        $req = $this->bdd->prepare('SELECT * FROM article WHERE idArticle = :id');
        $req->bindValue(':id',$id);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function addArticle(string $nomArticle, string $descriptionArticle,string $urlPhoto, float $prix, int $quantite, Categorie $categorie){
        $req = $this->bdd->prepare('INSERT INTO article (nomArticle, descriptionArticle, urlPhoto, prix, quantite, idCategorie) VALUES (:nom, :descriptionArticle, :urlPhoto, :prix, :quantite, :idCat)');
        $req->bindValue(':nom',$nomArticle);
        $req->bindValue(':descriptionArticle',$descriptionArticle);
        $req->bindValue(':urlPhoto',$urlPhoto);
        $req->bindValue(':prix',$prix);
        $req->bindValue(':quantite',$quantite);
        $req->bindValue(':idCat',$categorie->getIdCategorie());
        $req->execute();
        return new Article(intVal($this->bdd->lastInsertId()));
    }

    public function deleteArticle(int $id){
        $req = $this->bdd->prepare('DELETE FROM article WHERE idArticle = :id');
        $req->bindValue(':id',$id);
        $req->execute();
    }

    public function updateArticle(Article $article){
        $req = $this->bdd->prepare('UPDATE article SET nomArticle = :nom, descriptionArticle = :descriptionArticle, urlPhoto = :urlPhoto, prix = :prix, quantite = :quantite, idCategorie = :idCat WHERE idArticle = :id');
        $req->bindValue(':id',$article->getIdArticle());
        $req->bindValue(':nom',$article->getNomArticle());
        $req->bindValue(':descriptionArticle',$article->getDescriptionArticle());
        $req->bindValue(':urlPhoto',$article->getUrlPhotoArticle());
        $req->bindValue(':prix',$article->getPrixArticle());
        $req->bindValue(':quantite',$article->getQuantiteArticle());
        $req->bindValue(':idCat',$article->getCategorieArticle()->getIdCategorie());
        $req->execute();
    }

    public function checkArticleExists(int $id){
        return $this->getArticle($id) !== false;
    }
}
?>