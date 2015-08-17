<?php
require("partials/wrapper_head.php");
?>

<style type="text/css">
    #gallerymap, html, body {
        padding: 0px;
        margin: 0px;
        width: 100%;
        height: 100%;
        background-color: #333333;
        left: 0;
        top: 0;
    }
</style>

<div id="gallerymap">

</div>

<script type="text/javascript">

    var convertCoordinateFormat = function ( oldFormat ) {
        var chars = oldFormat.split( '' );
        chars.splice( -6, 0, '.' );
        return chars.join( '' );
    }

    $().ready( function () {
//        var cameraIcon = L.icon( {
//            iconUrl: '/img/map_marker_camera.png',
//            iconSize: [31, 49],
//            iconAnchor: [16, 49]
//        } );
//
        var zoom = 3;
        var map = L.map( 'gallerymap', { zoomControl: false } ).setView( [52.468209, 13.425995], zoom );

        L.tileLayer( 'http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        } ).addTo( map );

//        new L.Control.Zoom( { position: 'bottomleft' } ).addTo( map );
//
//        var hash = new L.Hash( map );
//
//        $.get( "http://api.criticalmaps.net/gallery/get.php",
//            function ( jsonString ) {
//                var jsonObject = jQuery.parseJSON( jsonString );
//                for ( var key in jsonObject ) {
//                    if ( jsonObject.hasOwnProperty( key ) ) {
//                        var currentImageObject = jsonObject[key];
//                        console.log( currentImageObject );
//
//                        L.marker( [
//                                convertCoordinateFormat( currentImageObject.latitude ),
//                                convertCoordinateFormat( currentImageObject.longitude )],
//                            { icon: cameraIcon} )
//                            .addTo( map )
//                            .bindPopup( '<img class="popupimage" src="http://api.criticalmaps.net/gallery/images/' + currentImageObject.imageId + '.jpg"> ' );
//                    }
//                }
//            } );
    } );
</script>

<?php
require("partials/wrapper_footer.php");
?>
