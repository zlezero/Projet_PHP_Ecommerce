<?php
function afficherSucces($message) { //Affiche une alerte de succès
?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        <span class="text-success align-middle">
            <i class="fa fa-check"></i><strong> Succès :</strong> <?php echo $message; ?>
        </span>
    </div>

<?php
}
?>