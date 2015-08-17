define( ['jquery', "app/locationsManager"], function ( $, locationsManager ) {
  $( "body" ).keypress( function ( event ) {
    if ( event.which == 104 ) {
      $( "#navigation" ).hide();
      $( "#social" ).hide();
      $( "#footercontainer" ).hide();
      locationsManager.startFasterLocationRetrieval();
    }
  } );
} );