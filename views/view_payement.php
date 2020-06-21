        <div id="container" class="container mt-5">

            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <div class="bg-white rounded-lg shadow-sm p-5">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
                            <li class="nav-item">
                                <a data-toggle="pill" href="#nav-tab-card" class="nav-link active rounded-pill">
                                    <i class="fa fa-credit-card"></i>
                                    Carte de crédit
                                </a>
                            </li>
                            <?php if (!is_null($this->getSessionManager()->getUser()->getCB())) { ?>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#nav-tab-registered-credit-card" class="nav-link rounded-pill">
                                    <i class="fa fa-credit-card"></i>
                                    Utiliser une carte enregistrée
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                        <!-- End -->

                        <!-- Credit card form content -->
                        <div class="tab-content">
                            <?php if (isset($_SESSION["erreur"])) { afficherErreur(getErrorMessage($_SESSION["erreur"]), false, "affichageErreur"); } ?>
                            <!-- credit card info-->
                            <div id="nav-tab-card" class="tab-pane fade show active">
                                <form role="form" id="formCarteNouvelle" method="POST" action="index.php?controller=payement&action=payer">
                                    <div class="form-group">
                                        <label for="username">Nom complet (sur la carte)</label>
                                        <input type="text" name="username" placeholder="Prénom Nom" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="cardNumber">Numéro de carte</label>
                                        <div class="input-group">
                                            <input type="text" name="cardNumber" placeholder="Votre numéro de carte" class="form-control" maxlength="16" minlength="16" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text text-muted">
                                                    <i class="fab fa-cc-visa mx-1"></i>
                                                    <i class="fab fa-cc-amex mx-1"></i>
                                                    <i class="fab fa-cc-mastercard mx-1"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label><span class="hidden-xs">Expiration</span></label>
                                                <div class="input-group">
                                                    <input type="number" placeholder="MM" name="expirationMois" class="form-control" min="1" max="12" required>
                                                    <input type="number" placeholder="AAAA" name="expirationAnnee" class="form-control" min="<?= date_create()->format("yy"); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-4">
                                                <label data-toggle="tooltip" title="Les trois-numéros à l'arrière de la carte">CVV
                                                    <i class="fa fa-question-circle"></i>
                                                </label>
                                                <input type="number" min="0" max="999" name="CVV" required class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="checkboxRegisterBankCard" value="registerBankCard" name="registerBankCard">
                                        <label class="form-check-label" for="checkboxRegisterBankCard">Enregistrer cette carte bancaire pour plus tard</label>
                                    </div>
                                    <button type="submit" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm" id="btnConfirmerPayerNouvelleCarte"> Confirmer et payer </button>
                                </form>
                            </div>
                            <!-- End -->

                            <?php if (!is_null($this->getSessionManager()->getUser()->getCB())) { ?>
                            <!-- Registered credit card info -->
                            <div id="nav-tab-registered-credit-card" class="tab-pane fade">
                                <!-- credit card info-->
                                <div id="nav-tab-card" class="tab-pane fade show active">
                                    <form role="form" id="formCarteExistante" method="POST" action="index.php?controller=payement&action=payer">
                                        <div class="form-group">
                                            <label for="username">Nom complet (sur la carte)</label>
                                            <input type="text" name="username" placeholder="Prénom Nom" required class="form-control" value="<?php echo $this->getSessionManager()->getUser()->getCB()->getNomCompletCB() ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="cardNumber">Numéro de carte</label>
                                            <div class="input-group">
                                                <input type="text" name="cardNumber" placeholder="Votre numéro de carte" class="form-control" value="<?php echo $this->getSessionManager()->getUser()->getCB()->getNumCB() ?>" required disabled>
                                                <div class="input-group-append">
                                                    <span class="input-group-text text-muted">
                                                        <i class="fab fa-cc-visa mx-1"></i>
                                                        <i class="fab fa-cc-amex mx-1"></i>
                                                        <i class="fab fa-cc-mastercard mx-1"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label><span class="hidden-xs">Expiration</span></label>
                                                    <div class="input-group">
                                                        <input type="number" placeholder="MM" name="expirationMois" class="form-control" value="<?= $this->getSessionManager()->getUser()->getCB()->getDateExpirationCB()->format("m") ?>" required disabled>
                                                        <input type="number" placeholder="AAAA" name="expirationAnnee" class="form-control" value="<?= $this->getSessionManager()->getUser()->getCB()->getDateExpirationCB()->format("yy") ?>" required disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group mb-4">
                                                    <label data-toggle="tooltip" title="Les trois-numéros à l'arrière de la carte">CVV
                                                        <i class="fa fa-question-circle"></i>
                                                    </label>
                                                    <input type="number" required class="form-control" name="CVV" value="<?php echo $this->getSessionManager()->getUser()->getCB()->getCryptoCB() ?>" disabled>
                                                </div>
                                            </div>

                                        </div>
                                        <button type="submit" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm" id="btnConfirmerPayerCarteExistante"> Confirmer et payer </button>
                                    </form>
                                </div>
                                <!-- End -->

                            </div>
                            <!-- End -->
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div id="confirmationPanierModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formSupprimerArticle">
                        <div class="modal-header">
                            <h4 class="modal-title">Valider commande</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Etes-vous sur de vouloir valider cette commande de <span id="prixCommandeModal"></span>€ ?</p>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Fermer">
                            <input type="submit" class="btn btn-primary" value="Valider" id="btnValiderCommande">
                        </div>
                    </form>
                </div>
            </div>
        </div>