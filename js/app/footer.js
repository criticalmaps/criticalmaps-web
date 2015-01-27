define( ['jquery'], function ($) {

  var footer = $( "#footer" );
  footer.hide();
  $( "#foldbutton" ).click( function () {
    var speed = 200;
    if ( footer.height() == 0 ) {
      footer.show();
      footer.animate( {
        height: "140px"
      }, speed );
    } else {
      footer.animate( {
        height: "0px"
      }, speed, function () {
        footer.hide();
      } );
    }
  } );

} );