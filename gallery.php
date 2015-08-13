<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
</head>
<body>

<div id="gallerymap">

</div>

<script src="js/vendor/leaflet-src.js"/>
<script src="js/vendor/jquery.js"/>

<script type="text/javascript">
        var currentMarkers = [];

        var greenIcon = L.icon( {
            iconUrl: '/img/bike.png',
            iconSize: [20, 20],
            iconAnchor: [10, 10]
        } );

        var zoom = 3;
        var map = L.map( 'gallerymap', { zoomControl: false } );

        map.setView( [52.468209, 13.425995], zoom );

        L.tileLayer( 'http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        } ).addTo( map );

        new L.Control.Zoom( { position: 'bottomleft' } ).addTo( map );

</script>


</body>
</html>