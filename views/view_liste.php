<div class="container">
    
<?php if (count($data['liste']) > 0) { ?>
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Liste des commandes <i class="fa fa-book" aria-hidden="true"></i></h2>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center;">Date de Commande</th>
                    <th scope="col" style="text-align: center;">Statut de la commande</th>
                    <th scope="col" style="text-align: center;">Nombre d'articles</th>
                    <th scope="col" style="text-align: center;">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $liste = $data['liste'];
                foreach ($liste as $var) {
                    $prixTotal = 0;
                    $qte = 0;
                    $panier = $var->getArticles();
                    foreach ($panier as $article) {
                        $prixTotal += $article->getArticle()->getPrixArticle() * $article->getQuantite();
                        $qte+= $article->getQuantite();
                    }
                ?>
                <tr>
                    <td class="text-center"><?=$var->getDateCommande()->format("d-M-Y")?></td>
                    <td class="text-center"><?=$var->getStatutCommande()->getNomStatutCommande()?></td>
                    <td class="text-center"> <?=$qte?></td>
                    <td class="text-center"><?=$prixTotal?>€</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

<?php
} else {
    ?>
    <h2>Vous n'avez aucun article dans votre panier.</h2>
<?php
}
?>

</div>