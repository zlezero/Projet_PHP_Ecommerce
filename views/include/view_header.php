<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>VintAIR</title>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link href="content/css/style_global.css" rel="stylesheet">
    <script src="content/js/js_global.js"></script>

    <?php 

        if (file_exists("content/css/style_$vue.css")) {
            ?> <link href="content/css/style_<?= $vue ?>.css" rel="stylesheet"> <?php
        }

        if (file_exists("content/js/js_$vue.js")) {
            ?> <script src="content/js/js_<?= $vue ?>.js"></script> <?php
        }

    ?>


</head>

<body>

    <?php if ($vue === "admin") {
        ?>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">

                <a class="navbar-brand" href="index.php?controller=articles#"><img alt="Logo" src="content/images/vintairLogoFull.png" width="32%"></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="nav navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php?controller=articles#">Accueil
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
                        <button class="btn btn-outline-secondary" data-toggle="modal" data-target=".bs-example-modal-sm">Se déconnecter</button>
                        <div class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                            <div class="modal-header"><h4>Se déconnecter <i class="fa fa-lock"></i></h4></div>
                            <div class="modal-body"><i class="fa fa-question-circle"></i> Etes-vous sur de vouloir vous déconnecter ? </div>
                            <div class="modal-footer"><a href="javascript:;" class="btn btn-primary btn-block">Se déconnecter</a></div>
                            </div>
                        </div>
                        </div>
                    </ul>

                </div>
            </div>

        </nav>
        <?php
    } else {
        ?>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">

                <a class="navbar-brand" href="index.php"><img alt="Logo" src="content/images/vintairLogoFull.png" width="32%"></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="nav navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Accueil
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item order-2 order-md-1"><a href="index.php?controller=commande&action=liste" class="nav-link" title="Historique des commandes">Commandes</a></li>
                    </ul>
                    <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
                        <!--TODO : critère si l'utilisateur est connecté TO DO -->
                        <li class="nav-item order-2 order-md-1"><a href="index.php?controller=commande&action=consulter" class="nav-link" title="Panier"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>


                        <li class="dropdown order-1">

                            <?php if ($this->getSessionManager()->isConnected()) { ?>

                                <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle">Mon compte <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right mt-2 justify-content-between">
                                    <li class="px-3 py-1">
                                        <?php echo("<div align='center'> Bonjour</div><div align='center'>". $this->getSessionManager()->getUser()->getPrenom() . " " . $this->getSessionManager()->getUser()->getNom().'</div>'); ?>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block btn-sm" id="disconnectButton">Se déconnecter</button>
                                        </div>
                                    </li>
                                </ul>

                            <?php } else { ?>

                                <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle">Se connecter <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right mt-2">
                                    <li class="px-3 py-2">
                                        <form class="form" role="form" id="formConnexion">
                                            <div class="form-group">
                                                <input id="emailInputConnexion" placeholder="Email" class="form-control form-control-sm" type="email" required>
                                            </div>
                                            <div class="form-group">
                                                <input id="passwordInputConnexion" placeholder="Mot de passe" class="form-control form-control-sm" type="password" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                                            </div>
                                            <div class="dropdown-divider"></div>
                                            <div class="form-group text-center">
                                                <small><a href="#" data-toggle="modal" data-target="#modalPassword">Pas de compte ? S'inscrire</a></small>
                                            </div>
                                        </form>
                                    </li>
                                </ul>

                            <?php } ?>

                        </li>

                    </ul>
                </div>

            </div>

        </nav>
        <?php
    }
