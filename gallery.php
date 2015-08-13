<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>

    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css"/>
    <style type="text/css">
        #gallerymap, html, body {
            padding: 0px;
            margin: 0px;
            width: 100%;
            height: 100%;
            background-color: #333333;
        }
    </style>
</head>
<body>

<div id="gallerymap">
    asdsadsa
</div>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>

<script type="text/javascript">

    var convertCoordinateFormat = function ( oldFormat ) {
        var chars = oldFormat.split( '' );
        chars.splice( -6, 0, '.' );
        return chars.join( '' );
    }

    $().ready( function () {


        var zoom = 3;
        var map = L.map( 'gallerymap', { zoomControl: false } ).setView( [52.468209, 13.425995], zoom );

        L.tileLayer( 'http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        } ).addTo( map );

        new L.Control.Zoom( { position: 'bottomleft' } ).addTo( map );


        $.get( "http://api.criticalmaps.net/gallery/get.php",
            function ( jsonString ) {
                var jsonObject = jQuery.parseJSON( jsonString );
                for ( var key in jsonObject ) {
                    if ( jsonObject.hasOwnProperty( key ) ) {
                        var currentImageObject = jsonObject[key];
                        console.log( currentImageObject );

                        L.marker( [
                            convertCoordinateFormat( currentImageObject.latitude ),
                            convertCoordinateFormat( currentImageObject.longitude )] )
                            .addTo( map )
                            .bindPopup( 'A pretty CSS3 popup.<br> Easily customizable.' )
                            .openPopup();
                    }
                }

            } );
    } );
</script>


</body>
</html>