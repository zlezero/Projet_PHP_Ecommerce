function addPanier(idA,idC) {

    var url = 'index.php?controller=panier&action=addPanier';

    //var token = $('input[name="__RequestVerificationToken"]', $('#monForm')).val();
    var myData = { idCommande:idC, idArticle:idA };
    //var dataWithAntiforgeryToken = $.extend(myData, { '__RequestVerificationToken': token });
    var result = $.ajax({
        url: url,
        //data: dataWithAntiforgeryToken,
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
