<?php require("wrapper_head.php"); ?>

<div id="page-id" class="gallery"></div>

<div id="gallerymap"></div>

<script type="text/javascript">
    $().ready(function () {
        var cameraIcon = L.icon({
            iconUrl: '/assets/images/marker-photo.png',
            iconSize: [40, 40],
            iconAnchor: [20, 20]
        });

        var cameraMap = new L.map('gallerymap', {zoomControl: false}).setView([52.468209, 13.425995], 3);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(cameraMap);

        new L.Control.Zoom({position: 'bottomleft'}).addTo(cameraMap);
        new L.Hash(cameraMap);

        $.get("https://api.criticalmaps.net/gallery/",
            function (response) {
                console.log(response)
                for (var i = 0; i < response.length; i++) {
                    var currentImageObject = response[i]
                    console.log(currentImageObject);

                    L.marker([
                            criticalMapsUtils.convertCoordinateFormat(currentImageObject.latitude),
                            criticalMapsUtils.convertCoordinateFormat(currentImageObject.longitude)],
                        {icon: cameraIcon}
                    )
                        .addTo(cameraMap)
                        .bindPopup(
                            '<a class="popuplink" target="_blank" href="http://api.criticalmaps.net/gallery/image/' + currentImageObject.id + '">' +
                            '<img class="popupimage" src="http://api.criticalmaps.net/gallery/thumbnail/' + currentImageObject.id + '">' +
                            '</a>');
                }
            }
        );
    });
</script>

<?php require("wrapper_footer.php"); ?>
