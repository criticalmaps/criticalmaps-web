define( ["jquery", "app/map"], function ( $, map ) {

  var locationsModel = [];

  var convertCoordinateFormat = function ( oldFormat ) {
    var chars = oldFormat.split( '' );
    chars.splice( -6, 0, '.' );
    return chars.join( '' );
  }

  var refreshLocationsFromServer = function () {
    $.getJSON( "//api.criticalmaps.net/postv2", function ( data ) {

      locationsModel = [];

      var locations = data.locations;

      for ( var key in locations ) {
        if ( locations.hasOwnProperty( key ) ) {
          var currentLocation = locations[key];
          var coordinate = {
            latitude: convertCoordinateFormat( currentLocation.latitude ),
            longitude: convertCoordinateFormat( currentLocation.longitude )
          }
          locationsModel.push( coordinate );
          console.log( "new coords: " + JSON.stringify( coordinate ) + " " + new Date().toString() );
        }
      }

      map.setNewLocations( locationsModel );
    } );
  }
  setInterval( function () { refreshLocationsFromServer() }, 20000 );
  refreshLocationsFromServer()

  return {
    startFasterLocationRetrieval: function () {
      setInterval( function () { refreshLocationsFromServer() }, 2000 );
    }
  };

} );