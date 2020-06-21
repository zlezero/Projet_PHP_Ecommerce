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

    public function getAllArticles(string $typeAffichage,bool $afficherQuantitePositive,$categorie,$parCategorieUniquement,$min,$max){
        if($afficherQuantitePositive){
            $sql = "SELECT * FROM article WHERE quantite > 0";
        }else{
            $sql = "SELECT * FROM article";
        }
        if($parCategorieUniquement)
        { 
            $sql .= " and idCategorie =";
        }
        switch ($categorie) {
            case "1":
                $sql .= "1";
                break;
            case "2":
                $sql .= "2";
                break;
            case "3":
                $sql .= "3";
                break;
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
        if($min && $max){
                    $sql.= " and (prix between ".$min." and ".$max.")";
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
    
        $offset = ($this->page - 1)  * $limit;
        $start = $offset + 1;
        $end = min(($offset + $limit), $total);

        $this->prevlink = ($this->page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($this->page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
        $this->nextlink = ($this->page < $this->pages) ? '<a href="?page=' . ($this->page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $this->pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
        $sql .=" LIMIT :limit OFFSET :offset";
        $req = $this->bdd->prepare($sql);
        $req->bindParam(':limit', $limit, PDO::PARAM_INT);
        $req->bindParam(':offset', $offset, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
        
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

            $this->prevlink = ($this->page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($this->page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
            $this->nextlink = ($this->page < $this->pages) ? '<a href="?page=' . ($this->page + 1) . '" title="Next page">&nbsp;&rsaquo;</a> <a href="?page=' . $this->pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
        
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
        $req->bindValue(':idCat',$categorie['idCategorie']);
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
        $req->bindValue(':nom',$article['nomArticle']);
        $req->bindValue(':descriptionArticle',$article['descriptionArticle']);
        $req->bindValue(':urlPhoto',$article['urlPhoto']);
        $req->bindValue(':prix',$article['prix']);
        $req->bindValue(':quantite',$article['quantite']);
        $req->bindValue(':idCat',$article['categorie']['idCategorie']);
        $req->execute();
    }

    public function checkArticleExists(int $id){
        return $this->getArticle($id) !== false;
    }
}
?>