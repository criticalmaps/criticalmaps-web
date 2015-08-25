<?php
require("partials/wrapper_head.php");
?>

<style type="text/css">
    #map, html, body {
        padding: 0px;
        margin: 0px;
        width: 100%;
        height: 100%;
        background-color: #333333;
        left: 0;
        top: 0;
    }
</style>

<div id="map">

</div>

<script type="text/javascript">
    $().ready( function () {
        var currentMarkers = [];

        var greenIcon = L.icon( {
            iconUrl: '/img/bike.png',
            iconSize: [20, 20],
            iconAnchor: [10, 10]
        } );

        var zoom = 3;
        var map = L.map( 'map', { zoomControl: false } );

        map.setView( [52.468209, 13.425995], zoom );

        L.tileLayer( 'http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        } ).addTo( map );

        new L.Control.Zoom( { position: 'bottomleft' } ).addTo( map );

        var hash = new L.Hash( map );

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

        function setNewLocations( locationsArray ) {

            //remove old markers
            currentMarkers.forEach( function ( marker ) {
                map.removeLayer( marker )
            } );

            //add new markes
            locationsArray.forEach( function ( coordinate ) {
                var marker = L.marker( [coordinate.latitude, coordinate.longitude], {icon: greenIcon} ).addTo( map );
                currentMarkers.push( marker );

            } );
        }

        var refreshLocationsFromServer = function () {
            $.getJSON( "//api.criticalmaps.net/postv2", function ( data ) {

                locationsArray = [];

                var locations = data.locations;

                for ( var key in locations ) {
                    if ( locations.hasOwnProperty( key ) ) {
                        var currentLocation = locations[key];
                        var coordinate = {
                            latitude: criticalMapsUtils.convertCoordinateFormat( currentLocation.latitude ),
                            longitude: criticalMapsUtils.convertCoordinateFormat( currentLocation.longitude )
                        }
                        locationsArray.push( coordinate );
                        console.log( "new coords: " + JSON.stringify( coordinate ) + " " + new Date().toString() );
                    }
                }

                setNewLocations( locationsArray );
            } );
        }
        setInterval( function () { refreshLocationsFromServer() }, 20000 );

        refreshLocationsFromServer();

        $( "body" ).keypress( function ( event ) {
            setInterval( function () { refreshLocationsFromServer() }, 1000 );
            alert( "ab geht die post!" );
        } );
    } );

</script>

<?php
require("partials/wrapper_footer.php");
?>
