$(document).ready(function(){
    // on sélectionne tous les div avec la classe zoneTexteAfficherMasquer et on les parcourt
    $("div.zoneTexteAfficherMasquer").each(function(i){
        // find permet d appliquer un sélecteur sur un ensemble selectionné
        $(this).find("div.TexteAAfficher").attr("id","TexteAAfficher"+(i+1)).hide();
        $(this).find("span.inviteClic").attr("id","inviteClic"+(i+1)).html("<img src='../web/bundles/parcpuffinsbag/images/plus.png' class='icone'/>Ajouter Donnees PNPC").attr("statut","1").click(
        function(){
            $("#TexteAAfficher"+(i+1)).slideToggle("slow");
            // selon le statut on renomme le texte
            if ($("#inviteClic"+(i+1)).attr("statut")=="1"){
                $("#inviteClic"+(i+1)).html("<img src='../web/bundles/parcpuffinsbag/images/moins.png' class='icone'/>(cliquez pour fermer)").attr("statut","0");
            }
            else{
                $("#inviteClic"+(i+1)).html("<img src='../web/bundles/parcpuffinsbag/images/plus.png' class='icone'/>Ajouter Donnees PNPC").attr("statut","1");
            };
        })
    }); 
});