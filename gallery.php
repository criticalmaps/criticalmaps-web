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

    .popupimage {
        width: 100px;
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>

<div id="gallerymap">

</div>

<script type="text/javascript">
    $().ready( function () {
        var cameraIcon = L.icon( {
            iconUrl: '/img/map_marker_camera.png',
            iconSize: [31, 49],
            iconAnchor: [16, 49]
        } );

        var zoom = 3;
        var map = L.map( 'gallerymap', { zoomControl: false } ).setView( [52.468209, 13.425995], zoom );

        L.tileLayer( 'http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        } ).addTo( map );

        new L.Control.Zoom( { position: 'bottomleft' } ).addTo( map );

        var hash = new L.Hash( map );

        var saveHashToParent = function(){
            if ( parent.criticalMapsMain && typeof parent.criticalMapsMain.saveMapState == 'function' ) {
                parent.criticalMapsMain.saveMapState( location.hash );
            }
        }

        map.on( "moveend", function () {
            saveHashToParent()
        }, this );

        map.on( "zoomend", function () {
            saveHashToParent()
        }, this );

        $.get( "http://api.criticalmaps.net/gallery/get.php",
            function ( jsonString ) {
                var jsonObject = jQuery.parseJSON( jsonString );
                for ( var key in jsonObject ) {
                    if ( jsonObject.hasOwnProperty( key ) ) {
                        var currentImageObject = jsonObject[key];
                        L.marker( [
                                criticalMapsUtils.convertCoordinateFormat( currentImageObject.latitude ),
                                criticalMapsUtils.convertCoordinateFormat( currentImageObject.longitude )],
                            { icon: cameraIcon}
                        )
                            .addTo( map )
                            .bindPopup(
                                '<a class="image-popup-fit-width" href="http://api.criticalmaps.net/gallery/images/' + currentImageObject.imageId + '.jpg">' +
                                '<img class="popupimage" src="http://api.criticalmaps.net/gallery/images/' + currentImageObject.imageId + '_thumb.jpg">' +
                                '</a>' );
                    }
                }
            } );

        $('.popuplink').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
//            mainClass: 'mfp-img-mobile',
            image: {
                verticalFit: true
            }

        });

    } );
</script>

<?php
require("partials/wrapper_footer.php");
?>
