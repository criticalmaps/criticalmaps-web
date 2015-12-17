<?php require("wrapper_head.php"); ?>

<link rel="stylesheet" href="/assets/css/libs.css" type="text/css"/>
<link rel="stylesheet" href="/assets/css/style.css" type="text/css"/>

<div id="gallerymap"></div>

<script type="text/javascript">
    $().ready( function () {
        var cameraIcon = L.icon( {
            iconUrl: '/assets/images/marker-photo.png',
            iconSize: [24, 24],
            iconAnchor: [12, 12]
        } );

        var map = L.map( 'gallerymap', { zoomControl: false } ).setView( [52.468209, 13.425995], 3 );

        L.tileLayer( 'http://{s}.tile.osm.org/{z}/{x}/{y}.png', {            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'} ).addTo( map );
        new L.Control.Zoom( { position: 'bottomleft' } ).addTo( map );
        new L.Hash( map );

        var saveHashToParent = function () {
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
                                '<a class="popuplink" target="_blank" href="http://api.criticalmaps.net/gallery/images/' + currentImageObject.imageId + '.jpg">' +
                                '<img class="popupimage" src="http://api.criticalmaps.net/gallery/images/' + currentImageObject.imageId + '_thumb.jpg">' +
                                '</a>' );
                    }
                }
            }
        );
    } );
</script>

<?php require("wrapper_footer.php"); ?>