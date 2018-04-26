<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-EN">
	<head profile="http://gmpg.org/xfn/11">

		<title>Critical Maps | An Android and iPhone App for the Critical Mass</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<link rel="stylesheet" href="/assets/css/libs.css" type="text/css"/>
		<link rel="stylesheet" href="/assets/css/style.css" type="text/css"/>

		<script src="/assets/js/libs.js"></script>
		<script src="/assets/js/script.js"></script>

		<div id="map"></div>

		<script type="text/javascript">
		    $().ready( function () {
			    var currentMarkers = [];

			    var bikeIcon = L.icon( {
			        iconUrl: '/assets/images/marker-bike.png',
			        iconSize: [40, 40],
			        iconAnchor: [20, 20]
			    } );

			    var bikeMap = new L.map( 'map', { zoomControl: false } ).setView( [52.468209, 13.425995], 3 );

			    L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
			    } ).addTo( bikeMap );

			    new L.Control.Zoom( { position: 'bottomleft' } ).addTo( bikeMap );
			    new L.Hash( bikeMap );

			    function setNewLocations( locationsArray ) {

			        //remove old markers
			        currentMarkers.forEach( function ( marker ) {
			            bikeMap.removeLayer( marker )
			        } );

			        //add new markes
			        locationsArray.forEach( function ( coordinate ) {
			            var marker = L.marker( [coordinate.latitude, coordinate.longitude], {icon: bikeIcon} ).addTo( bikeMap );
			            currentMarkers.push( marker );

			        } );
			    }

			    var refreshLocationsFromServer = function () {
			        $.getJSON( "https://api.criticalmaps.net/postv2", function ( data ) {

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
			        if ( event.which == 104 ) {
			            setInterval( function () { refreshLocationsFromServer() }, 1000 );
			            alert( "ab geht die post!" );
			        }
			    } );
		    } );
		</script>

	</body>
</html>
