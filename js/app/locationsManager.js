require( ["jquery", "app/map"], function ( $, map ) {

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
        }
      }

      map.setNewLocations( locationsModel );
    } );
  }
  setInterval( function () { refreshLocationsFromServer() }, 5000 );
  refreshLocationsFromServer()
} )
;