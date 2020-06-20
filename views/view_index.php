    <!-- Page Content -->
    <?php
        require_once('models\Model.php');
        $bdd = Model::getDatabase();
        $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
        $page= ($page < 1) ? $page=1 : $page;
        $uri = explode('?',$_SERVER['REQUEST_URI'])[0];
        $querry = (empty($_SERVER['REQUEST_URI'])) ? explode('?',$_SERVER['REQUEST_URI'])[1] : "page=1";
        if(!empty($querry)){
            $uri = $uri. '?' . $querry;
        }
        //header('Location: ' . $uri);
        $limite = 10;

    $debut = ($page - 1) * $limite;
    $query = 'SELECT * FROM `article` LIMIT :limite OFFSET :debut';
    $query = $bdd->prepare($query);
    $query->bindValue('debut', $debut, PDO::PARAM_INT);
    $query->bindValue('limite', $limite, PDO::PARAM_INT);
    $query->execute();
    ?>
    <div class="container">

        <div class="row">
            <div class="col-lg-3">
                <h1 class="my-4">Shop Name</h1>
                <form action ="?controller=index&action=orderBy" method="POST">
                   <div class="list-group">
                       <button type="submit" class="btn btn-primary mb-2"  name="category" value="1" onclick="document.getElementById('categorie1').style.display='block';">Category 1</button>
                       <button type="submit" class="btn btn-primary mb-2" name="category" value="2" onclick="document.getElementById('categorie2').style.display='block';">Category 2</button>
                       <button type="submit" class="btn btn-primary mb-2" name="category" value="3" onclick="document.getElementById('categorie3').style.display='block';">Category 3</button>
                       <label for="min">Min</label>
                       <input type="text" name="min" placeholder="1">
                       <label for="max" >Max</label>
                       <input type="text" name="max" placeholder="100">
                       <button type="submit">Filtrer</button>
                     </div>
               </form>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

                <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div id="categorie1"hidden>Categorie1</div>
                <div id="categorie2"hidden>Categorie2</div>
                <div id="categorie3"hidden>Categorie3</div>

                <form action ="?controller=index&action=orderBy" method="POST">
                    <label for="Ordonnancement">Ordonner par</label>
                    <select class="form-control" id="ordreSelect" name="ordreSelect">
                        <option value="nomCroissant">Nom Croissant</option>
                        <option value="nomDecroissant">Nom Décroissant</option>
                        <option value="prixCroissant">Prix Croissant</option>
                        <option value="prixDecroissant">Prix Décroissant</option>
                    </select>
                    <button type="submit" class="btn btn-primary mb-2" value="tri">Trier</button>
                </form>
                </br>

                <button><<a href="?page=<?php echo $page - 1;?>">Page précédente</a></button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button><a href="?page=<?php echo $page + 1; ?>">Page suivante</a>></button>
                <br><br>
                <div class="row">
                    <?php foreach($data['articles'] as $indice => $value){
                        /*if(isset($value['idCategorie'])){
                            require_once('models\Model.php');                        
                            require_once('models\class.Categorie.php');
                            $cat = new Categorie($value['idCategorie']);
                            $categorie = $cat->getNomCategorie();
                       }*/
                        ?>   
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <a href="#"><img class="card-img-top" src="<?=$value['urlPhoto'];?>" alt=""></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#"><?=$value['nomArticle']?></a>
                                    </h4>
                                    <h5><?=$value['prix']?></h5>
                                    <p class="card-text"><?=$value['descriptionArticle']?></p>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                    <a href="#" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                   </div>
                   <button><<a href="?page=<?php echo $page - 1;?>">Page précédente</a></button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button><a href="?page=<?php echo $page + 1; ?>">Page suivante</a>></button>
                <br><br>

                
                <!-- /.row -->

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->