<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=SENSITIVE_INFO&callback=initMap&libraries=&v=weekly"
        defer
    ></script>
    <?php

    $longitud = session('longitud');
    $latitud = session('latitud');

    ?>
    <style type="text/css">
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <script>
        let map;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: <?php echo $latitud ?>, lng: <?php echo $longitud ?> },
                zoom: 15,
            });

            var marker = new google.maps.Marker({
                position: { lat: <?php echo $latitud ?>, lng: <?php echo $longitud ?> },
                title:"Aquí está tu paquete!"
            });

            marker.setMap(map);
        }
    </script>
</head>
<body>
<div id="map"></div>
</body>
</html>
