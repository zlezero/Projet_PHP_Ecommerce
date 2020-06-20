    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3">

                <h1 class="my-4">Catégories</h1>
                <form action ="?controller=index&action=orderBy" method="POST">
                    <div class="list-group">
                        <?php foreach($data['categories'] as $indice => $value){
                        ?>
                        <button type="submit" class="list-group-item list-group-item-light" name="idCategory" value="<?= $value['idCategorie'] ?>"><?=$value['nomCategorie']?></button>
                        <?php } ?>
                        <div class="list-group-item list-group-item-light">
                            <div class="row">
                                <div class="col-6">
                                    <label for="min">Min</label>
                                    <input type="text" class="form-control" name="min" placeholder="1">
                                </div>
                                <div class="col-6">
                                    <label for="max" >Max</label>
                                    <input type="text" class="form-control" name="max" placeholder="100">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary list-group-item list-group-item-light" type="submit">Réinitialiser tous les filtres</button>
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
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <div class="view">
                                <img class="d-block img-fluid" src="https://www.leguidedugamer.fr/wp-content/uploads/2018/06/pc-gamer-ou-console.jpg" alt="First slide">
                                <div class="mask rgba-black-light"></div>
                            </div>
                            <div class="carousel-caption">
                                <h3 class="h3-responsive">Découvrer les nouveaux jeux vidéos</h3>
                                <p>Commandez dès maintenant !</p>
                            </div>
                        </div>
                        <div class="carousel-item ">
                            <div class="view">
                                <img class="d-block img-fluid" src="https://www.posca.com/wp-content/uploads/2018/07/communautcs-loisirs-crcatifs-1-1920x1080-c-default.jpg" alt="First slide">
                                <div class="mask rgba-black-light"></div>
                            </div>
                            <div class="carousel-caption">
                                <h3 class="h3-responsive">Besoin de s'évader ?</h3>
                                <p>Laissez parler votre créativité !</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="view">
                                <img class="d-block img-fluid" src="https://s3.amazonaws.com/rose.vero/wp-content/uploads/2019/06/12155509/Jeux-de-socie%CC%81te%CC%81-en-famille.jpg" alt="Second slide">
                                <div class="mask rgba-black-strong"></div>
                            </div>
                            <div class="carousel-caption">
                                <h3 class="h3-responsive">Jeux pour toute la famille</h3>
                                <p>Partagez vos passions  !</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="view">
                                <img class="d-block img-fluid" src="https://images.frandroid.com/wp-content/uploads/2020/06/sony-ps5-conference_2020-06-11_23-12-30.jpg" alt="Third slide">
                                <div class="mask rgba-black-slight"></div>
                            </div>
                            <div class="carousel-caption">
                                <h3 class="h3-responsive">Evénement</h3>
                                <p>Précommande des jeux annoncés bientôt disponible</p>
                            </div>
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

                <?php if (isset($_SESSION["erreur"])) { afficherErreur(getErrorMessage($_SESSION["erreur"]), false, "affichageErreur"); } ?>
                <?php if (isset($_SESSION["succes"])) { afficherSucces(getSuccessMessage($_SESSION["succes"]), false, "affichageSucces"); } ?>

                <form action ="?controller=index&action=orderBy" method="POST" class="form-inline">
                    <div class="form-group">
                        <label for="Ordonnancement" class="mr-3"> Ordonner par:</label>
                        <select class="form-control" id="ordreSelect" name="ordreSelect">
                        <option value="nomCroissant" <?= ($data['typeAffichage'] == 'nomCroissant') ? 'selected' : '' ?> >Nom Croissant</option>
                        <option value="nomDecroissant" <?= ($data['typeAffichage'] == 'nomDecroissant') ? 'selected' : '' ?> >Nom Décroissant</option>
                        <option value="prixCroissant" <?= ($data['typeAffichage'] == 'prixCroissant') ? 'selected' : '' ?> >Prix Croissant</option>
                        <option value="prixDecroissant" <?= ($data['typeAffichage'] == 'prixDecroissant') ? 'selected' : '' ?> >Prix Décroissant</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary ml-3" value="tri">Trier</button>
                </form>
                </br>
                <nav aria-label="Page navigation example" id="paging">
                    <ul class="pagination">
                        <li class="page-item"><?php echo  $data['prevlink']; ?></li>
                        <?php for($i=1; $i<=$data['pages'];$i++){ ?>
                            <?php if($data['page']==$i){ ?>
                                <li class="page-item active"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
                            <?php }else{ ?>
                                <li class="page-item"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
                            <?php } ?> 
                        <?php
                            }
                        ?>
                        <li class="page-item"><?php echo  $data['nextlink']; ?></li>
                    </ul>
                </nav>

                <div class="row">
                    <?php if(count($data['articles'])==0){ ?> <p>Nous ne disposons pas d'articles dans les filtres choisis.</p> <?php } ?>

                    <?php foreach($data['articles'] as $indice => $value){
                        ?>   
                        <div class="col-lg-6 col-md-6 mb-4">
                            <div class="card h-100 w-100">
                                <a href="#" ><center><img class="card-img-top" src="<?=$value['urlPhoto'];?>" alt=""></center></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#"><?=$value['nomArticle']?></a>
                                    </h4>
                                    <h5><?=$value['prix']?>‎€</h5>
                                    <p class="card-text overflow-auto"><?=$value['descriptionArticle']?></p>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-light rounded-circle" data-toggle="button" aria-pressed="false" autocomplete="off">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <a href="#" onclick="addPanier(<?=$value['idArticle'].','.$_SESSION['idCommande']?>)" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                </div>
        
                <!-- /.row -->

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->