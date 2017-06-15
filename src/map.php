<?php require("wrapper_head.php"); ?>

<div id="page-id" class="map"></div>

<div id="map-share">
	<p>Embed this map on your website:</p>
	<pre><code>&lt;iframe width=&quot;1280&quot; height=&quot;720&quot; src=&quot;http://criticalmaps.net/map-embed&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;</code></pre>
</div>

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

	    L.tileLayer( 'http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
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
	        $.getJSON( "https://criticalmaps-api.stephanlindauer.de/postv2", function ( data ) {

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

<?php require("wrapper_footer.php"); ?>
