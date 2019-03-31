<?php $title = "Live Map | Critical Maps"; ?>

<?php require("wrapper_head.php"); ?>

<div id="page-id" class="map"></div>

<div id="map-share">
	<p>Embed this map on your website:</p>
	<pre><code>&lt;iframe width=&quot;1280&quot; height=&quot;720&quot; src=&quot;https://criticalmaps.net/map-embed&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;</code></pre>
</div>

<div id="map"></div>

<script type="text/javascript">
    $().ready( function () {
	    var currentMarkers = [];

	    var bikeIcon = L.icon( {
	        iconUrl: '/assets/images/marker-bike.png',
	        iconSize: [48, 48],
	        iconAnchor: [24, 24],
					className: 'map-marker-bike',
	    } );

	    var bikeMap = new L.map( 'map', { zoomControl: false } ).setView( [52.468209, 13.425995], 3 );

	    L.tileLayer( 'https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}.png', {
	        attribution: '<a href="https://foundation.wikimedia.org/wiki/Maps_Terms_of_Use">Wikimedia maps</a> | &copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
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

<?php require("wrapper_footer.php"); ?>
