$(document).ready(function(){
    $('form').submit(function(e){
        e.preventDefault();
        const valueSelected = $('#ordreSelect').val();
        $.get(
            'index.php?controller=articles&action=defineDefaultOrder',
            {value:valueSelected}
        ).done(function(response){
            if(response !== false){
                $("#modalSuccesOrdreDefaut").show();
            } else{

            }
            
        });
    })
}
)