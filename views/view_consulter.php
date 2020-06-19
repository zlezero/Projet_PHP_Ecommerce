<div>
    <div>
        <h1>Votre commande : (<?=$data['commande']->getStatutCommande()->getNomStatutCommande()?>)</h1>
    </div><br />
    <?php if (count($data['commande']->getArticles()) > 0) { ?>
        <?php
        $panier = $data['commande']->getArticles();
        $prixTotal = 0;
        foreach ($panier as $var) {
            $prixTotal += $var->getArticle()->getPrixArticle() * $var->getQuantite();
        ?>
            <div id="article_<?= $var->getArticle()->getIdArticle() ?>" style="display:inline">
                <img style="width:200px;height:200px" src="<?= $var->getArticle()->getUrlPhotoArticle() ?>">
                <label><?= $var->getArticle()->getNomArticle() ?></label>
                <label id="prixUnit_<?= $var->getArticle()->getIdArticle() ?>" ><?= $var->getArticle()->getPrixArticle() ?></label><label>€</label>
                &nbsp;&nbsp;&nbsp;
                <button <?=$data['commande']->getStatutCommande()->getIdStatutCommande()==1 ? "":"disabled"?> onclick="updPanier(<?= $var->getArticle()->getIdArticle() ?>,<?= $var->getIdCommande() ?>,'remove1')">-</button>
                <input disabled id="qte_<?= $var->getArticle()->getIdArticle() ?>" style="width: 40px;" value='<?= $var->getQuantite() ?>' />
                <button onclick="updPanier(<?= $var->getArticle()->getIdArticle() ?>,<?= $var->getIdCommande() ?>,'add')">+</button> exemplaires
                
                &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;
                <label id="prix_<?= $var->getArticle()->getIdArticle() ?>"><?= $var->getQuantite() * $var->getArticle()->getPrixArticle() ?></label>
                <label>€</label>
                <button onclick="updPanier(<?= $var->getArticle()->getIdArticle() ?>,<?= $var->getIdCommande() ?>,'delete')" style="background-color:red;color:white"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </div>
            <br />

        <?php
        } ?>
        <hr>
        <h3>Prix Total : <label id="prixTotal"><?= $prixTotal ?></label>€</h3>
    <?php
    if($_SESSION['sessionManager']!=null){
        if($data['commande']->getStatutCommande()->getIdStatutCommande()==1){

            ?>
        <a href="index.php?controller=commande&action=valider">Valider la commande</a>
        <?php
    }
    }
    } else {
    ?>
        <h2>Vous n'avez aucun article dans votre panier</h2>
    <?php
    }
    ?>

</div>