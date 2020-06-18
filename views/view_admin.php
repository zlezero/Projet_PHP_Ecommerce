    
    <!-- Page Content -->
    <div class="container">
        <?php afficherSucces("L'ordre par défaut a bien été défini",true,"modalSuccesOrdreDefaut") ?>
        <div class="row">

            <div class="col-lg-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Définir l'ordre par défaut d'affichage des articles</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Définir ordre par défaut</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                    </div>
            </div>   

        </div>

    </div>
    <!-- /.container -->