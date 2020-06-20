    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <div class="col-lg-3">

                <h1 class="my-4">Catégories</h1>
                <div class="list-group">
                    <?php foreach($data['categories'] as $indice => $value){
                    ?>
                    <a href="#" class="list-group-item"><?=$value['nomCategorie']?></a>
                    <?php } ?>
                </div>

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


                <div class="row">
                    <?php foreach($data['articles'] as $indice => $value){
                        ?>    
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <a href="#"><img class="card-img-top" src="<?=$value['urlPhoto'];?>" alt=""></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#"><?=$value['nomArticle']?></a>
                                    </h4>
                                    <h5><?=$value['prix']?>‎€</h5>
                                    <p class="card-text"><?=$value['descriptionArticle']?></p>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <button type="button" class="btn btn-light rounded-circle" data-toggle="button" aria-pressed="false" autocomplete="off">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <a href="#" onclick="addPanier(<?=$value['idArticle'].','.$_SESSION['idCommande']?>)" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                        
                </div>
                <!-- /.row -->

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->