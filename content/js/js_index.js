function addPanier(idA,idC) {

    var url = 'index.php?controller=panier&action=addPanier';

    var myData = { idCommande:idC, idArticle:idA };
    var result = $.ajax({
        url: url,
        data:myData,
        type: "POST",
        success: function (data) {
            alert("Un exemplaire de l'article a été ajouté au panier");
        },
        error: function (response) {
            alert(response.responseText);
        },
        failure: function (response) {
            alert(response.responseText);
        }
    });
}
