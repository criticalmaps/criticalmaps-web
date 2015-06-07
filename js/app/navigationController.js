require( ["jquery"], function ( $ ) {

  $( "#navigation ul li a" ).click(
    function ( event ) {
      var selectedItem = event.target.text;

      $( "#navigation ul li a" ).removeClass( "active" );
      $( "#navigation ul li a:contains(" + selectedItem + ")" ).addClass( "active" );

      $( ".mainframe" ).css( "z-index", "-2" );
      $( ".mainframe#" + selectedItem ).css( "z-index", "-1" )
    } );

} );