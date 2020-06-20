$(document).ready(() => {

    $('#formConnexion').submit((e) => {
        
        e.preventDefault();

        $.ajax({
            dataType: "json",
            method: 'POST',
            url: 'index.php?controller=user&action=login',
            data: { email: $('#emailInputConnexion').val(), mdp: $('#passwordInputConnexion').val()}
        }).done((data) => {
            
            if (data != 'OK' && data != 'ADMIN') {
                alert(data);
            } else {
                if (data == 'ADMIN') {
                    location.reload();
                } else {
                    window.location = "index.php?controller=articles";
                }
            }

        });

    });

    $('#disconnectButton').click((e) => {

        $.ajax({
            dataType: "json",
            method: 'POST',
            url: 'index.php?controller=user&action=disconnect'
        }).done((data) => {
        
            if (data != 'OK') {
                alert(data);
            } else {
                location.reload();
            }

        });

    });
    
});