$(function() {
	$( document ).tooltip({
		track: true
	});
});

/*$(function() {
    $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
}); */

$(function() {
    $( "#tabs" ).tabs({
      collapsible: true
    });
}); 

$(function() {
    $( "#accordion" ).accordion();
});

$(function() {
    $( ".info" )
      .ready(function() {
		setTimeout( "jQuery('.info').hide('slide',1000);",5000 );
        //$(".flash").hide('slide',5000);
	});
});

$(function() {
	$( ".warning" )
      .ready(function() {
		setTimeout( "jQuery('.warning').hide('slide',5000);",10000 );
        //$(".flash").hide('slide',5000);
      });
});
