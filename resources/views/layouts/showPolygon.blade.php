@section('js')

    @if(!empty($zone->coordinates[0]->lat))
        <script>

                function DrawMapWithPolygon(myCoords) {
                    var map = new google.maps.Map(document.getElementById('area'), {
                        zoom: 10,
                        mapTypeId: 'roadmap'
                    });

                    var bounds = new google.maps.LatLngBounds();

                    var myCoords = [
                        @foreach($zone->coordinates as $coordinate)
                        new google.maps.LatLng( {{ $coordinate->lat }}, {{ $coordinate->lng }} ),
                        @endforeach
                    ];

                    for (i = 0; i < myCoords.length; i++) {
                        bounds.extend(myCoords[i]);
                    }

                    map.setCenter({lat: bounds.getCenter().lat(), lng: bounds.getCenter().lng() })
                    map.fitBounds(bounds);

                    // Construct the polygon.
                    var bermudaTriangle = new google.maps.Polygon({
                        paths: myCoords,
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: '#FF0000',
                        fillOpacity: 0.35
                    });

                    bermudaTriangle.setMap(map);

                    // Construct the thumbnail.

                    var latcenter = bounds.getCenter().lat();
                    var lngcenter = bounds.getCenter().lng();

                    var mapcoords = [];

                    @foreach($zone->coordinates as $coordinate)

                         var coordlat = {{ $coordinate->lat }};
                         var coordlng = {{ $coordinate->lng }};

                         var coords = "|" + coordlat + "," + coordlng ;

                        mapcoords.push(coords);

                    @endforeach

                    var result =  mapcoords.join('');

                    var iconmap = document.getElementById('iconmap');

                    iconmap.src="http://maps.googleapis.com/maps/api/staticmap?center=" + latcenter +","+ lngcenter +
                        "&zoom=" + bounds +
                        "&size=90x90" +
                        "&maptype=satellite" +
                        "&path=color:0x00000000|weight:5|fillcolor:red|fillcolor:red" +
                        result

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
            var bermudaTriangle = new google.maps.Polygon({
                paths: myCoords,
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35,
            });

            bermudaTriangle.setMap(map);

            // Construct the thumbnail

            var latcenter = bounds.getCenter().lat();
            var lngcenter = bounds.getCenter().lng();

            var mapcoords = [];

            @foreach($area->coordinates as $coordinate)

                var coordlat = {{ $coordinate->lat }};
                var coordlng = {{ $coordinate->lng }};

                var coords = "|" + coordlat + "," + coordlng ;

                mapcoords.push(coords);

            @endforeach

            var result =  mapcoords.join('');

            var iconmap = document.getElementById('iconmap');

            iconmap.src="http://maps.googleapis.com/maps/api/staticmap?center=" + latcenter +","+ lngcenter +
                "&zoom=" + bounds +
                "&size=90x90" +
                "&maptype=satellite" +
                "&path=color:0x00000000|weight:5|fillcolor:red|fillcolor:red" +
                result
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key= {{ env('GOOGLE_API_KEY') }} &libraries=drawing&callback=DrawMapWithPolygon"
            async defer></script>
@endif

@stop