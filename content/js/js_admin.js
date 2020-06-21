$(document).ready( function() {

    $('#formChooseDefaultOrder').submit(function(e) {

        e.preventDefault();

        const valueSelected = $('#ordreSelect').val();

        $.get(
            'index.php?controller=articles&action=defineDefaultOrder',
            {value:valueSelected}
        ).done(function(response) {

            if(response !== false) {
                $("#modalSuccesOrdreDefaut").show();
            } else {
                $("#modalErrorOrdreDefaut").show();
            }

            $('#modalChooseDefaultOrder').modal('hide');
            
        })
    });
    
    $('#supprimerArticleModal').on('show.bs.modal', function(e) { 

        let id = $(e.relatedTarget).data('id');
        
        $('#formSupprimerArticle').submit(function(e) {

            e.preventDefault();
    
            const idArticle = id;
            
            $.get(
                'index.php?controller=articles&action=deleteArticle',
                {value:idArticle}
            ).done(function(response) {
    
                if(response !== false) {
                    $("#modalSuccessDeleteArticle").show();
                } else {
                    $("#modalErrorDeleteArticle").show();
                }
    
                $('#supprimerArticleModal').modal('hide');
                
            })
        });
    });

    $('#addDropdownList').find("a").click(function(){
        $('#addDropdownMenuButton').html($(this).html()).append("    <span class='caret'></span>");
        $idCategorie = $(this).attr('name');
    });

    $('#formAjouterArticle').submit(function(e){

        e.preventDefault();  
        $.ajax({
            type: "POST",
            url: 'index.php?controller=articles&action=addArticle',
            cache:false,
            data: $('#formAjouterArticle').serialize() + '&' + 'idCategorie=' + $idCategorie,
            success: function(response){
                $("#modalSuccessAddArticle").show();
            },
            error: function(response){
                $("#modalErrorAddArticle").show();
            }
        })

        $('#ajouterArticleModal').modal('hide');
    });
    
    $('#modifyDropdownList').find("a").click(function(){
        $('#modifyDropdownMenuButton').html($(this).html()).append("    <span class='caret'></span>");
        $idCat = $(this).attr('name');
    });

    $('#modifierArticleModal').on('show.bs.modal', function(e){
        
        let idArt = $(e.relatedTarget).data('idart');
        $.getJSON(
            'index.php?controller=articles&action=fetchArticle',
            {value:idArt}
        ).done(function(response){
            if(response != false){
                $('#nomArt').val(response.nomArticle);
                $('#descriptionArt').val(response.descriptionArticle);
                $('#urlPhotoArt').val(response.urlPhoto);
                $('#prixArt').val(response.prix);
                $('#quantiteArt').val(response.quantite);
              

                $('#formModifierArticle').submit(function(e){

                    e.preventDefault();
                    
                    const idArti = idArt; 
                    $.ajax({
                        type: "POST",
                        url: 'index.php?controller=articles&action=updateArticle',
                        cache:false,
                        data: $('#formModifierArticle').serialize() + '&' + 'idCategorie=' + $idCat + '&idArticle=' + idArti,
                        success: function(response){
                            $("#modalSuccessModifyArticle").show();
                            $('#modifierArticleModal').modal('hide');
                        },
                        error: function(response){
                            $("#modalErrorModifyArticle").show();
                            $('#modifierArticleModal').modal('hide');
                        }
                    })
            
                })
                
            } else{
                $message = "Erreur lors du préremplissage des champs";
                $("#modalErrorModifyArticle").show(); 
            }


        });

    });


});