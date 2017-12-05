@section('js')

    @if(!empty($zone->coordinates[0]->lat))
        <script>

            function DrawMapWithPolygon(myCoords) {
                var map = new google.maps.Map(document.getElementById('area'), {
                    mapTypeId: 'roadmap'
                });

                var bounds = new google.maps.LatLngBounds();

                var myCoords = [
                    @foreach($zone->coordinates as $coordinate)
                    new google.maps.LatLng( {{ $coordinate->lat }}, {{ $coordinate->lng }} ),
                    @endforeach
                ];

                for (var i = 0; i < myCoords.length; i++) {
                    bounds.extend(myCoords[i]);
                }

                map.setCenter({'lat': bounds.getCenter().lat(), 'lng': bounds.getCenter().lng() });
                map.fitBounds(bounds);

                // Construct the polygon.
                var polygon = new google.maps.Polygon({
                    paths: myCoords,
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35,
                    editable:true,
                    draggable:true
                });

                polygon.setMap(map);

                google.maps.event.addListener(polygon.getPath(), 'set_at', newPolyCoords);
                google.maps.event.addListener(polygon.getPath(), 'insert_at', newPolyCoords);


                function newPolyCoords() {

                    var coordinatesArray = polygon.getPath().getArray();

                    var myCoords = "[";
                    for (var i = 0; i < coordinatesArray.length; i++) {
                        myCoords += '{"lat":' + coordinatesArray[i].lat() + ', "lng":' + coordinatesArray[i].lng() + '}';
                        if (i < coordinatesArray.length - 1)
                            myCoords += ", ";
                    }
                    myCoords += "]";

                    document.querySelector('#coordinates').value = myCoords;

                };
            }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key= {{ env('GOOGLE_API_KEY') }} &libraries=drawing&callback=DrawMapWithPolygon"
                async defer></script>
    @endif


    @if(!empty($area->coordinates[0]->lat))
        <script>


            function DrawMapWithPolygon(myCoords) {
                var map = new google.maps.Map(document.getElementById('area'), {
                    mapTypeId: 'roadmap'
                });

                var bounds = new google.maps.LatLngBounds();

                var myCoords = [
                    @foreach($area->coordinates as $coordinate)
                    new google.maps.LatLng( {{ $coordinate->lat }}, {{ $coordinate->lng }} ),
                    @endforeach
                ];

                for (var i = 0; i < myCoords.length; i++) {
                    bounds.extend(myCoords[i]);
                }

                map.setCenter({'lat': bounds.getCenter().lat(), 'lng': bounds.getCenter().lng() });
                map.fitBounds(bounds);

                // Construct the polygon.
                var polygon = new google.maps.Polygon({
                    paths: myCoords,
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35,
                    editable:true,
                    draggable:true
                });

                polygon.setMap(map);

                google.maps.event.addListener(polygon.getPath(), 'set_at', newPolyCoords);
                google.maps.event.addListener(polygon.getPath(), 'insert_at', newPolyCoords);


                function newPolyCoords() {

                    console.log('Bounds changed.');

                    var coordinatesArray = polygon.getPath().getArray();

                    console.log(coordinatesArray);

                    var myCoords = "[";
                    for (var i = 0; i < coordinatesArray.length; i++) {
                        myCoords += '{"lat":' + coordinatesArray[i].lat() + ', "lng":' + coordinatesArray[i].lng() + '}';
                        if (i < coordinatesArray.length - 1)
                            myCoords += ", ";
                    }
                    myCoords += "]";

                    document.querySelector('#coordinates').value = myCoords;

                };
            }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key= {{ env('GOOGLE_API_KEY') }} &libraries=drawing&callback=DrawMapWithPolygon"
                async defer></script>
    @endif

@stop