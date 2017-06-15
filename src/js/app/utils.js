criticalMapsUtils = {

   convertCoordinateFormat : function ( oldFormat ) {
    oldFormat = oldFormat.toString();
    var chars = oldFormat.split( '' );
    chars.splice( -6, 0, '.' );
    return chars.join( '' );
  }

}
