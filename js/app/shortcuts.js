define( ['jquery'], function ( $ ) {
  $( "body" ).keypress( function ( event ) {
    if ( event.which == 104 ) {
      $( "#navigation" ).hide();
      $( "#social" ).hide();
      $( "#footercontainer" ).hide();
    }
  } );
} );