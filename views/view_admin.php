    <!-- Page Content -->
    <div class="container">

        <?php afficherSucces("L'ordre par défaut a bien été défini", true, "modalSuccesOrdreDefaut"); ?>
        <?php afficherErreur("Une erreur est survenue lors de la définition de l'ordre par défaut", true, "modalErrorOrdreDefaut"); ?>
        <?php afficherSucces("L'article a bien été supprimé",true,"modalSuccessDeleteArticle"); ?>
        <?php afficherErreur("Une erreur a été detectée lors de la supression de l'article", true,"modalErrorDeleteArticle"); ?>
        <?php afficherSucces("L'article a bien été ajouté",true,"modalSuccessAddArticle"); ?>
        <?php afficherErreur("Une erreur a été detectée lors de l'ajout de l'article", true,"modalErrorAddArticle"); ?>
        <?php afficherSucces("L'article a bien été modifié",true,"modalSuccessModifyArticle"); ?>
        <?php afficherErreur("Une erreur a été detectée lors de la modification de l'article", true,"modalErrorModifyArticle"); ?>
        
        
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Gérer les articles</h2>
                    </div>
                    <div class="col-sm-6 buttons">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalChooseDefaultOrder">Définir l'ordre par défaut d'affichage des articles</button>
                        <a href="#" data-target="#ajouterArticleModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> Ajouter un article</a>					
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">idArticle</th>
                        <th scope="col">Nom Article</th>
                        <th scope="col">Description Article</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Nom Categorie</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['articles'] as $indice => $value){
                    ?>
                    <tr>
                        <th scope="row"><?=$value->getIdArticle()?></th>
                        <td><?=$value->getNomArticle()?></td>
                        <td><?=$value->getDescriptionArticle()?></td>
                        <td><?=$value->getPrixArticle()?></td>
                        <td><?=$value->getQuantiteArticle()?></td>
                        <td><?=$value->getCategorieArticle()->getNomCategorie()?></td>
                        <td><img style="width:56px;height:56px;" src="<?=$value->getUrlPhotoArticle();?>" alt=""></td>
                        <td>
                            <a href="#" data-target="#modifierArticleModal" class="edit" data-toggle="modal" data-idart="<?=$value->getIdArticle()?>"><i class="material-icons" data-toggle="tooltip" title="Modifier">&#xE254;</i></a>
                            <a href="#" data-target="#supprimerArticleModal" class="delete" data-toggle="modal" data-id="<?=$value->getIdArticle()?>" ><i class="material-icons" data-toggle="tooltip" title="Supprimer">&#xE872;</i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

          <!-- Define Default Order Modal  -->
        <div class="modal fade" id="modalChooseDefaultOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Définir ordre par défaut</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formChooseDefaultOrder">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Entrez votre choix:</label>
                                <select class="form-control" id="ordreSelect" name="ordreSelect">
                                    <option value="nomCroissant">Nom Croissant</option>
                                    <option value="nomDecroissant">Nom Décroissant</option>
                                    <option value="prixCroissant">Prix Croissant</option>
                                    <option value="prixDecroissant">Prix Décroissant</option>
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Confirmez votre choix</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ajouter Article Modal HTML -->
        <div id="ajouterArticleModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formAjouterArticle">
                        <div class="modal-header">						
                            <h4 class="modal-title">Ajouter Article</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">					
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" name="nomArticle" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="descriptionArticle" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>UrlPhoto</label>
                                <input type="text" name="urlPhoto" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Prix</label>
                                <input type = "number" name="prix" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Quantité</label>
                                <input type = "number" name="quantite" class="form-control" required>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button" id="addDropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Nom de la catégorie
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="addDropdownList">
                                <?php foreach($data['categories'] as $indice => $value){
                                ?>
                                    <a class="dropdown-item" href="#" name="<?=$value['idCategorie']?>"><?=$value['nomCategorie']?></a>
                                <?php } ?>
                                </div>
                            </div>     	  					
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Fermer">
                            <input type="submit" class="btn btn-success" value="Ajouter">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modifier Article Modal HTML -->
        <div id="modifierArticleModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formModifierArticle">
                        <div class="modal-header">						
                            <h4 class="modal-title">Modifier Article</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">					
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" name="nomArticle" id="nomArt" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="descriptionArticle"  id="descriptionArt" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>UrlPhoto</label>
                                <input type="text" name="urlPhoto" id="urlPhotoArt" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Prix</label>
                                <input type = "number" name="prix" id="prixArt" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Quantité</label>
                                <input type = "number" name="quantite" id="quantiteArt" class="form-control" required>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button" id="modifyDropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Nom de la catégorie
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="modifyDropdownList">
                                <?php foreach($data['categories'] as $indice => $value){
                                ?>
                                    <a class="dropdown-item" href="#" name="<?=$value['idCategorie']?>"><?=$value['nomCategorie']?></a>
                                <?php } ?>
                                </div>
                            </div>     					
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Fermer">
                            <input type="submit" class="btn btn-info" value="Modifier">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Supprimer Article Modal HTML -->
        <div id="supprimerArticleModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formSupprimerArticle">
                        <div class="modal-header">						
                            <h4 class="modal-title">Supprimer Article</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">					
                            <p>Etes-vous sur de vouloir supprimer cet article ?</p>
                            <p class="text-warning"><small>Cette action est irréversible.</small></p>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Fermer">
                            <input type="submit" class="btn btn-danger" value="Supprimer">
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>
    <!-- /.container -->