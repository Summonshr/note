<html>
    <head>
        <title>Mapper</title>
        <style>

        </style>
        </head>
        <body>
            {!! map(-25.363, 131.044)->zoom(8)->addMarker(-24.363,131.044,['html'=>'somerthing','title'=>'something']) !!}
        </body>       <script>
            function map(elem){
                if(elem.dataset && ( data = JSON.parse(elem.dataset.attributes))){
                   
                    var map = new google.maps.Map(elem, {
                        zoom: data.zoom || 4,
                        center: data.center || {lat: -25.363, lng: 131.044}
                    });

                    data.markers && data.markers.length > 0 && data.markers.map(function(marker){
                        var pin = new google.maps.Marker({
                            position: marker,
                            map: map,
                            title: marker.content && marker.content.title
                        });
                        if(marker.content){
                            var infowindow = new google.maps.InfoWindow({
                                content: marker.content.html
                            });

                            pin.addListener('click', function() {
                                infowindow.open(map, pin);
                            });
                        }
                    });

                    data.clusters && data.clusters.length > 0 && data.clusters.map(function(cluster){
                        console.log(cluster);
                    });
                }
            }
            function initMap(){
                var maps= document.getElementsByClassName("map");
                for (var i = 0; i < maps.length; i++) {
                   map(maps[i])
                }
            }
        </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQ_xaCYxLHL_ReW4DqxQK74sVZ7UoQR1Y&callback=initMap"></script>
</html>