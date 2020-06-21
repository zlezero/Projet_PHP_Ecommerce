/*$(document).ready(() => {
    
    $('#formCarteNouvelle, #formCarteExistante').submit((e) => {

        e.preventDefault();

        $("#confirmationPanierModal").modal("show");

    });

    $('#btnConfirmerPayerNouvelleCarte, #btnConfirmerPayerCarteExistante').click((e) => {
        e.preventDefault();

        $("#confirmationPanierModal").modal("show");

    });

    $('#confirmationPanierModal').on('show.bs.modal', function(e) { 
        $.ajax({
            dataType: "json",
            method: 'POST',
            url: 'index.php?controller=commande&action=getMontantTotal'
        }).done((data) => {
            $("#prixCommandeModal").text(data);
        });
        
    });

    $('#btnValiderCommande').click((e) => {
        $('#formCarteExistante').submit();
    })

}); */