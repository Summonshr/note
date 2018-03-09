<html>
    <head>
        <title>Mapper</title>
        <style>

        </style>
        </head>
        <body>
            {!! map(-25.363, 131.044)->zoom(8)->drawLines(
                    [
                        [
                            'locations'=>[
                                [-12.044012922866312, -77.02470665341184],
                                [-12.05449279282314, -77.03024273281858],
                                [-12.055122327623378, -77.03039293652341],
                                [-12.075917129727586, -77.02764635449216],
                                [-12.07635776902266, -77.02792530422971],
                                [-12.076819390363665, -77.02893381481931],
                                [-12.088527520066453, -77.0241058385925],
                                [-12.090814532191756, -77.02271108990476]
                            ]
                        ],
                        [
                            'locations'=>[
                                [-12.044012922866312, -77.02470665341184],
                                [-12.05449279282314, -77.03024273281858],
                                [-12.055122327623378, -77.03039293652341],
                                [-12.075917129727586, -77.02764635449216],
                                [-12.07635776902266, -77.02792530422971],
                                [-12.076819390363665, -77.02893381481931],
                                [-12.088527520066453, -77.0241058385925],
                                [-12.090814532191756, -77.02271108990476]
                            ]
                        ]
                    ]
                 ) !!}
        </body>       
        <script>
            function map(elem){
                if(elem.dataset && ( data = JSON.parse(elem.dataset.attributes))){
                    var map = new google.maps.Map(elem, {
                        zoom: data.zoom || 4,
                        center: data.center || {lat: -25.363, lng: 131.044}
                    });

                    var pinMarker = function (marker, index){
                        var pin = new google.maps.Marker({
                            position: marker,
                            map: map,
                            label: String((marker.content && marker.content.label) || (index + 1)),
                            title: String((marker.content && marker.content.title) || (index + 1))
                        });
                        if(marker.content){
                            var infowindow = new google.maps.InfoWindow({
                                content: marker.content.html
                            });

                            pin.addListener('click', function() {
                                infowindow.open(map, pin);
                            });
                        }
                        return pin;
                    }

                    var pinLine = function(line, index){
                        var flightPath = new google.maps.Polyline(line);

                        flightPath.setMap(map);
                    }

                    var pinCluster = function(cluster){
                        return cluster.locations && cluster.locations.length > 0 && new MarkerClusterer(map, cluster.locations.map(pinMarker), {imagePath: cluster.image || 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
                    }

                    data.markers && data.markers.length > 0 && data.markers.map(pinMarker);
                    data.clusters && data.clusters.length > 0 && data.clusters.map(pinCluster);
                    data.lines && data.lines.length > 0 && data.lines.map(pinLine);
                }
            }
            function initMap(){
                var maps= document.getElementsByClassName("map");
                for (var i = 0; i < maps.length; i++) {
                   map(maps[i])
                }
            }
        </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/js-marker-clusterer/1.0.0/markerclusterer.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQ_xaCYxLHL_ReW4DqxQK74sVZ7UoQR1Y&callback=initMap"></script>
</html>