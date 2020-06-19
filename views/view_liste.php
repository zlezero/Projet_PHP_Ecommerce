<div>
    <div>
        <h1>Vos commandes :</h1>
    </div><br />
    <?php if (count($data['liste']) > 0) { ?>
        <?php
        $liste = $data['liste'];
        foreach ($liste as $var) {
            $prixTotal = 0;
            $qte = 0;
            $panier = $var->getArticles();
            foreach ($panier as $article) {
                $prixTotal += $article->getArticle()->getPrixArticle();
                $qte+=1;
            }
        ?>
        <div>
            <h4>Le <?=$var->getDateCommande()->format("d-M-Y")?> :</h4>
            <label>Statut : <?=$var->getStatutCommande()->getNomStatutCommande()?></label>
            <br/>
            <label>Nombre d'articles : <?=$qte?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total : <?=$prixTotal?>€</label>
        </div>
            <br />

        <?php
        } ?>
        <?php
    } else {
        ?>
        <h2>Vous n'avez aucun article dans votre panier</h2>
    <?php
    }
    ?>

</div>