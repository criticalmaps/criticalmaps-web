define( ['jquery'], function ( $ ) {
  $( "body" ).keypress( function ( event ) {
    if ( event.which == 104 ) {
      $( "#navigation" ).hide();
      $( "#social" ).hide();
      $( "#footercontainer" ).hide();
      $( ".mainframe" ).css( "z-index", "-2" );
      $( ".mainframe#map" ).css( "z-index", "-1" )
    }
  } );
} );