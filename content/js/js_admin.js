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
            
        });

    });

});