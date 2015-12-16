criticalMapsUtils = {

   convertCoordinateFormat : function ( oldFormat ) {
    var chars = oldFormat.split( '' );
    chars.splice( -6, 0, '.' );
    return chars.join( '' );
  }

}
