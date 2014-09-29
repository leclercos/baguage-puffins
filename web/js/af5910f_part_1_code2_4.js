
$(document).ready(function(){
    // on sélectionne tous les div avec la classe zoneTexteAfficherMasquer et on les parcourt
    $("div.zoneTexte").each(function(i){
        // find permet d appliquer un sélecteur sur un ensemble selectionné
        $(this).find("div.Texte").attr("class","Texte"+(i+1)).hide();
        $(this).find("span.inviteClick").attr("class","inviteClick"+(i+1)).html("<img src='../bundles/parcpuffinsbag/images/plus.png' class='icone'/> Ajouter").attr("statut","1").click(
        function(){
            $(".Texte"+(i+1)).slideToggle("slow");
            // selon le statut on renomme le texte
            if ($(".inviteClick"+(i+1)).attr("statut")=="1"){
                $(".inviteClick"+(i+1)).html("<img src='../bundles/parcpuffinsbag/images/moins.png' class='icone'/>(cliquez pour fermer)").attr("statut","0");
            }
            else{
                $(".inviteClick"+(i+1)).html("<img src='../bundles/parcpuffinsbag/images/plus.png' class='icone'/> Ajouter").attr("statut","1");
            };
        })
    });
}); 

$(document).ready(function(){
    // on sélectionne tous les div avec la classe zoneTexteAfficherMasquer et on les parcourt
    $("div.zoneTexte1").each(function(i){
        // find permet d appliquer un sélecteur sur un ensemble selectionné
        $(this).find("div.Texte1").attr("class","Texte1"+(i+1)).hide();
        $(this).find("span.inviteClick1").attr("class","inviteClick1"+(i+1)).html("<img src='../../../bundles/parcpuffinsbag/images/plus.png' class='icone'/> Ajouter").attr("statut","1").click(
        function(){
            $(".Texte1"+(i+1)).slideToggle("slow");
            // selon le statut on renomme le texte
            if ($(".inviteClick1"+(i+1)).attr("statut")=="1"){
                $(".inviteClick1"+(i+1)).html("<img src='../../../bundles/parcpuffinsbag/images/moins.png' class='icone'/>(cliquez pour fermer)").attr("statut","0");
            }
            else{
                $(".inviteClick1"+(i+1)).html("<img src='../../../bundles/parcpuffinsbag/images/plus.png' class='icone'/> Ajouter").attr("statut","1");
            };
        })
    });
});