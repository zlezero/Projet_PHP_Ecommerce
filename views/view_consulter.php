<div class="container">
    <div>
        <h1>Votre commande : (<?=$data['commande']->getStatutCommande()->getNomStatutCommande()?>)</h1>
    </div><br/>
    <?php if (count($data['commande']->getArticles()) > 0) { ?>
        <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Panier <i class="fa fa-shopping-basket" aria-hidden="true"></i></h2>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" style="text-align: left;">Produit</th>
                    <th scope="col" style="text-align: center;">Prix Unitaire</th>
                    <th scope="col" style="text-align: center;">Editer</th>
                    <th scope="col" style="text-align: center;">Totaux</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $panier = $data['commande']->getArticles();
            $prixTotal = 0;
            foreach ($panier as $var) {
                $prixTotal += $var->getArticle()->getPrixArticle() * $var->getQuantite();
            ?>
            <tr id="article_<?= $var->getArticle()->getIdArticle() ?>">
                <td class="text-center">
                    <img style="width:200px;height:200px" src="<?= $var->getArticle()->getUrlPhotoArticle() ?>">
                    <label><?= $var->getArticle()->getNomArticle() ?></label>
                </td>
                <td class="text-center">
                    <label id="prixUnit_<?= $var->getArticle()->getIdArticle() ?>" ><?= $var->getArticle()->getPrixArticle() ?></label><label>€</label>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-light" <?=$data['commande']->getStatutCommande()->getIdStatutCommande()==1 ? "":"disabled"?> onclick="updPanier(<?= $var->getArticle()->getIdArticle() ?>,<?= $var->getIdCommande() ?>,'remove1')">-</button>
                    <input disabled id="qte_<?= $var->getArticle()->getIdArticle() ?>" style="width: 40px;" value='<?= $var->getQuantite() ?>' />
                    <button type="button" class="btn btn-light" onclick="updPanier(<?= $var->getArticle()->getIdArticle() ?>,<?= $var->getIdCommande() ?>,'add')">+</button>
                    </br>
                    <button type="button" class="btn btn-danger delete" value="Remove" onclick="updPanier(<?= $var->getArticle()->getIdArticle() ?>,<?= $var->getIdCommande() ?>,'delete')" ><i class="material-icons" aria-hidden="true">&#xE872;</i></button> Retirer 
                </td>
                <td class="text-center">
                    <label id="prix_<?= $var->getArticle()->getIdArticle() ?>"><?= $var->getQuantite() * $var->getArticle()->getPrixArticle() ?></label>
                    <label>€</label>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div style="box-sizing: border-box;">
        <p class="total">Total de la commande: <label id="prixTotal"><?= $prixTotal ?></label>€</p>
        <div  class="text-right mb-3">
            <a class="btn btn-success confirm" href="index.php?controller=commande&action=valider" >Valider la commande</a>
        </div>
    </div>
    
        <?php
        if($_SESSION['sessionManager']!=null){
            if($data['commande']->getStatutCommande()->getIdStatutCommande()==1){

                ?>
            <a class="btn btn-success" href="index.php?controller=commande&action=valider" style="float:right">Valider la commande</a>
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