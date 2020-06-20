<?php

function afficherSucces(string $message, bool $hide, string $id) { //Affiche une alerte de succès
    ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert" id="<?= $id ?>" <?php echo ($hide) ? 'style="display:none"': ''; ?> >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        <span class="text-success align-middle">
            <div id="<?php echo $id."Text"?>"><i class="fa fa-check"></i><strong> Succès :</strong> <?php echo $message; ?></div>
        </span>
    </div>
<?php
}

function afficherErreur(string $message, bool $hide, string $id) { //Affiche une alerte de succès
    ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="<?= $id ?>" <?php echo ($hide) ? 'style="display:none"': ''; ?> >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        <span class="text-danger align-middle">
            <div id="<?php echo $id."Text"?>"><i class="fa fa-close"></i><strong> Erreur :</strong> <?php echo $message; ?></div>
        </span>
    </div>
<?php
}

function redirect(string $url, string $arg = null) {

    if (is_null($arg)) {
        header('Location: '. $url);
        exit;
    } else {
        header('Location: '. $url & "?=");
        exit;
    }

}

function checkParameter(array $parameters) : bool {

    foreach($parameters as $parametre) {
        if (!isset($_POST[$parametre]) || empty($_POST[$parametre])) {
            return false;
        }
    }

    return true;

}

function getErrorMessage(string $hash) {

    switch ($hash) {
        case sha1("loginIncorrect"):
            return "<strong>Identifiant</strong> ou <strong>mot de passe</strong> incorrect !";
        case sha1("inscriptionParametresInvalides"):
            return "Les arguments envoyés sont invalides.";
        case sha1("inscriptionErreurSurvenue"):
            return "Une erreur est survenue lors de l'inscription";
        case sha1("inscriptionMdpNonCorrespondants"):
            return "Les deux mots de passe ne correspondent pas";
        default:
            return "Message inconnu";
    }

}

function getSuccessMessage(string $hash) {
    switch ($hash) {
        case sha1("loginIncorrect"):
            return "<strong>Identifiant</strong> ou <strong>mot de passe</strong> incorrect !";
        default:
            return "Message inconnu";
    }
}

?>