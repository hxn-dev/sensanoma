function makePolygon(map) {
    document.querySelector('#area').style.display = "block";

    var map;

    map = new google.maps.Map(document.getElementById('area'), {
        center: {lat: 50.85451938, lng: 4.35601451},
        zoom: 18
    });

    marker = new google.maps.Marker({
        map: map,
        icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
    });;

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            marker.setPosition(pos);
            map.setCenter(pos);
        }, function() {
            handleLocationError(true, marker, map.getCenter());
        }); } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, marker, map.getCenter());
            }

        function handleLocationError(marker, pos) {
            marker.setPosition(pos);
            marker.open(map);
        }

    var drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: google.maps.drawing.OverlayType.POLYGON,
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: ['polygon'],
        }
    });

    drawingManager.setMap(map);

    google.maps.event.addListener(drawingManager, 'overlaycomplete', function (polygon) {
        var coordinatesArray = polygon.overlay.getPath().getArray();

        var myCoords = "[";
        for (var i = 0; i < coordinatesArray.length; i++) {
            myCoords += '{"lat":' + coordinatesArray[i].lat() + ', "lng":' + coordinatesArray[i].lng() + '}';
            if (i < coordinatesArray.length - 1)
                myCoords += ", ";
        }
        myCoords += "]";

        document.querySelector('#coordinates').value = myCoords;
    });
}
