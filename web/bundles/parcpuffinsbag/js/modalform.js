$(function() {
    var href ="";
	
	$( ".dialog-form" ).dialog({
      autoOpen: false,
      height: 150,
      width: 300,
      modal: true,
      buttons: {
        "Supprimer": function() {
		  $("form").attr("action",href);
		  $("form").submit();
		  $( this ).dialog( "close" );
        },
        Annuler: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        
      }
    });
 
    $( ".supp_enr" )
      .click(function() {
		href=$(this).attr("id");
        $( ".dialog-form" ).dialog( "open" );
      });
	 
	$( ".dialog-form2" ).dialog({
      autoOpen: false,
      height: 280,
      width: 350,
      modal: true,
      buttons: {
        "Ajouter": function() {
		  //$("form").attr("action",href);
		  $("form").submit();
		  $( this ).dialog( "close" );
        },
        Annuler: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        
      } 
    });
 
    $( "#news-add" )
		.button()
		.click(function() {
		//href=$(this).attr("id");
        $(".dialog-form2" ).dialog( "open" );
      });
  });