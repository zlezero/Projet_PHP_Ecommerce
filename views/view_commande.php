<div>
    <div>
        <h1>Votre commande :</h1>
    </div><br />
    <?php if ($data['commande']->getArticles() > 0) { ?>
        <h2><?= count($data['commande']->getArticles()) ?> articles sont présents dans votre panier.</h2><br />
        <?php
        $panier = $data['commande']->getArticles();
        foreach ($panier as $var) {
        ?>
            <img style="width:200px;height:200px" src="<?= $var->getArticle()->getUrlPhotoArticle() ?>">
            <?= $var->getArticle()->getNomArticle() ?>
            <button>-</button>
            <?= $var->getQuantite() ?>
            <button>+</button> exemplaires
            <button style="background-color:red;color:white"><i class="fa fa-trash" aria-hidden="true"></i></button>
            <?=$var->getQuantite()*$var->getArticle()->getPrixArticle()?>€
            <br />

        <?php
        }
    } else {
        ?>
        echo "<h2>Vous n'avez aucun article dans votre panier</h2>";
    <?php
    }
    ?>

</div>