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
      height: 415,
      width: 515,
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
	  
	$( "#doc-add" )
		.button()
		.click(function() {
		//href=$(this).attr("id");
        $(".dialog-form2" ).dialog( "open" );
      });
	 	  
	$( ".dialog-form3" ).dialog({
      autoOpen: false,
      height: 150,
      width: 300,
      modal: true,
      buttons: {
        "Reinitialiser": function() {
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
	$( ".mdp_reinit" )
      .click(function() {
		href=$(this).attr("id");
        $( ".dialog-form3" ).dialog( "open" );
      });
	  
  });