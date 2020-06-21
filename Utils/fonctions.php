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

function redirect($url) {
    header('Location: '.$url);
    exit;
}

function checkParameter(array $parameters) : bool {

    foreach($parameters as $parametre) {
        if (!isset($_POST[$parametre]) || empty($_POST[$parametre])) {
            return false;
        }
    }

    return true;

}

?>