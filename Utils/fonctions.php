<?php
function afficherSucces(string $message, bool $hide, string $id) { //Affiche une alerte de succès
    ?>

    <div class="alert alert-success alert-dismissible fade <?php echo ($hide)? 'collapse':'show';  ?>" role="alert" id="<?= $id ?>">
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