/*
define( ["jquery", "app/map"], function ( $, map ) {

  var locationsModel = [];

  var convertCoordinateFormat = function ( oldFormat ) {
    var chars = oldFormat.split( '' );
    chars.splice( -6, 0, '.' );
    return chars.join( '' );
  }


  refreshLocationsFromServer()

  return {
    startFasterLocationRetrieval: function () {
      setInterval( function () { refreshLocationsFromServer() }, 2000 );
    }
  };

} );
*/