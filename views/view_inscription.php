
        <div id="container" class="container mt-5">

            <div class="row mt-2">
                <div class="col-md-3"></div>

                <div class="col-md-6">
                    <h1>S'inscrire</h1>
                    <hr>
                    <?php if (isset($_SESSION["erreur"])) { afficherErreur(getErrorMessage($_SESSION["erreur"]), false, "affichageErreur"); } ?>
                </div>

            </div>

            <form class="form-group" action="index.php?controller=inscription&action=register" method="post">

                <div class="row">

                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <label for="email">Email :</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>

                </div>

                <div class="row mt-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <label for="prenom">Prénom :</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label for="login">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
                        </div>
                </div>
              
                <div class="row mt-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <label for="mdp">Mot de passe :</label>
                        <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe" required>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <label for="pwdConfirmation">Confirmez le mot de passe :</label>
                        <input type="password" class="form-control" id="mdpConfirmation" name="mdpConfirmation" placeholder="Confirmation du mot de passe" required>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-sign-in"></i> S'inscrire</button>
                        <a href="index.php" class="btn btn-primary">Retourner à l'accueil</a>
                    </div>
                </div>

            </form>

        </div>
    
    </body>

</html>