$(function() {
    var href ="",
		password = $( "#password" ),
		password2 = $( "#password2" ),
		allFields = $( [] ).add( password ).add( password2 ),
		tips = $( ".validateTips" );
	
	$( "#mdpchange" )
      .ready(function() {
		href=$(this).attr("id");
        $("#dialog-form3" ).dialog( "open" );
      });
	
	function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
	 
	function checkLength( p, min, max ) {
      if ( p.val().length > max || p.val().length < min ) {
        p.addClass( "ui-state-error" );
        updateTips( "Mot de passe doit etre entre " +
          min + " et " + max + " caratères." );
        return false;
      } else {
        return true;
      }
    }
	
	function checkEquality( p,p2 ) {
      if ( p.val()!= p2.val() ) {
        p.addClass( "ui-state-error" );
        updateTips("Les deux mots de passe sont différents.");
        return false;
      } else {
        return true;
      }
    }
	
	$( "#dialog-form3" ).dialog({ 
      autoOpen: false,
      height: 300,
      width: 300,
      modal: true,
      buttons: {
        "Modifier": function() {
		  var bValid = true;
          allFields.removeClass( "ui-state-error" );

          bValid = bValid && checkLength( password, 6, 20 );
          bValid = bValid && checkEquality( password, password2);
		  
		  if ( bValid ) {
			  $("#form_mp").submit();
			  $( this ).dialog( "close" );
		 }
        }
      },
      close: function() {
        
      } 
    });
  }); 