function quantite(val, compteur, prix) {
    document.getElementById(compteur).value = val;
    document.getElementById('total').value = parseInt(document.getElementById('total').value) + parseInt(val) * parseInt(prix);
}

function commander() {
    $.ajax
    (
    {
        type:"get",
        url:'../PHP/commander.php',
        data:"numCde="+$('input[id="numCde"]').val()+"&numCli="+$('select[name="client"]').val()+"&numLiv="+$('select[name="livreur"]').val(),
        success:function(data)
            {
                alert("Commande envoyé avec succée");
            },
            error:function()
            {
                alert("erreur sur la récup");
            }
    });
}