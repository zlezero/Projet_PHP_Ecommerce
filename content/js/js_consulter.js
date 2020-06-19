function updPanier(idA,idC,action) {
    
    var url = 'index.php?controller=panier&action='+action+'Panier';

    //var token = $('input[name="__RequestVerificationToken"]', $('#monForm')).val();
    var myData = { idCommande:idC, idArticle:idA };
    //var dataWithAntiforgeryToken = $.extend(myData, { '__RequestVerificationToken': token });
    var result = $.ajax({
        url: url,
        //data: dataWithAntiforgeryToken,
        data:myData,
        type: "POST",
        success: function (data) {
            var labelPrixTot=document.getElementById("prixTotal");
            var inp=document.getElementById("qte_"+idA);
            var prix=document.getElementById("prix_"+idA);
            var prixUnit =parseFloat(document.getElementById("prixUnit_"+idA).innerText);
            if(action=="add"){
                inp.value=parseInt(inp.value)+1;
                prix.innerText=Number((parseFloat(prix.innerText)+prixUnit).toFixed(2));
                labelPrixTot.innerText=Number((parseFloat(labelPrixTot.innerText)+prixUnit).toFixed(2));
            }else if(action=="remove1"&&parseInt(inp.value)>1){
                inp.value=parseInt(inp.value)-1;
                prix.innerText=Number((parseFloat(prix.innerText)-prixUnit).toFixed(2));
                labelPrixTot.innerText=Number((parseFloat(labelPrixTot.innerText)-prixUnit).toFixed(2));
            }else if(action="delete"||parseInt(inp.value)==1){
                var div = document.getElementById("article_"+idA);
                labelPrixTot.innerText=Number((parseFloat(labelPrixTot.innerText)-parseFloat(prix.innerText)).toFixed(2));
                div.style.display="none";
            }else{
                return;
            }
        },
        error: function (response) {
            console.log("ajax error");
            alert(response.responseText);
        },
        failure: function (response) {
            console.log("ajax failure");
            alert(response.responseText);
        }
    });
}

