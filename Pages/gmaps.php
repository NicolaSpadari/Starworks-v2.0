<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Location</title>
        <link href="../CSS/bootstrap.min.css" rel="stylesheet">
        <link href="../CSS/font-awesome.min.css" rel="stylesheet">
        <style>
            #map {
                position: fixed !important; top: 10%; right: 10%; left: 10%; bottom: 10%;
            }
            
            .fa{
                cursor: pointer;
            }
            
            #userLocation, #warnings-panel{
                display: none;
            }
        </style>
    </head>
    <body>
        <div class="container mt-3">
            <div class="row text-center">
                <div class="col-3">
                    <i class="px-2 fa fa-2x fa-map-marker" alt="Starworks Warehouse" aria-hidden="true" onclick="initMap()"></i>
                </div>
                <div class="col-3">
                    <i class="px-2 fa fa-2x fa-male" alt="Walking" aria-hidden="true" onclick="initMapTravel('WALKING')"></i>
                </div>
                <div class="col-3">
                    <i class="px-2 fa fa-2x fa-car" alt="Driving" aria-hidden="true" onclick="initMapTravel('DRIVING')"></i>
                </div>
                <div class="col-3">
                    <i class="px-2 fa fa-2x fa-train" alt="Public transport" aria-hidden="true" onclick="initMapTravel('TRANSIT')"></i>
                </div>
            </div>
        </div>
        
        <div id="userLocation">
            <span id="address"></span>
        </div>
        
        <div id="map"></div>
        &nbsp;
        <div id="warnings-panel"></div>
        
        <script src="../Javascript/jquery.min.js"></script>
        <script src="../Javascript/popper.min.js"></script>
        <script src="../Javascript/bootstrap.min.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVeJB7Zjz4G_0CiMRBq7t5hHS3UOJdtnI&callback=initMap"></script>
        <script>
            $(document).ready(function () {
                getLocation();
            });
           
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else { 
                    alert("Geolocation is not supported by this browser.");
                }
            }
            function showPosition(position) {
                        var geocoder;
                        initialize();
                        geocodeLatLng(position.coords.latitude, position.coords.longitude);
            }
            
            function initialize() {
                geocoder = new google.maps.Geocoder();
            }
            
            function geocodeLatLng(lat, lng) {
                var latlng = new google.maps.LatLng(lat, lng);
                geocoder.geocode({
                    'latLng': latlng
                }, function(results, status) {
                    $('#address').text(results[0].formatted_address);
                });
            }
            
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 15,
                  center: {lat: 52.5789771, lng: -2.1283869000000095}
                });
                var marker = new google.maps.Marker({
                    position: {lat: 52.5789771, lng: -2.1283869000000095},
                    map: map
                });
            }
            
            function initMapTravel(travelMode) {
            var markerArray = [];

            // Instantiate a directions service.
            var directionsService = new google.maps.DirectionsService;

            // Create a map and center it on Manhattan.
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 15,
              center: {lat: 52.5789771, lng: -2.1283869000000095}
            });

            // Create a renderer for directions and bind it to the map.
            var directionsDisplay = new google.maps.DirectionsRenderer({map: map});

            // Instantiate an info window to hold step text.
            var stepDisplay = new google.maps.InfoWindow;

            // Display the route between the initial start and end selections.
            calculateAndDisplayRoute(
                directionsDisplay, directionsService, markerArray, stepDisplay, map, travelMode);
          }

          function calculateAndDisplayRoute(directionsDisplay, directionsService,
              markerArray, stepDisplay, map, travelMode) {
            // First, remove any existing markers from the map.
            for (var i = 0; i < markerArray.length; i++) {
              markerArray[i].setMap(null);
            }

            // Retrieve the start and end locations and create a DirectionsRequest using
            // WALKING directions.
            directionsService.route({
              origin: document.getElementById('address').innerHTML,
              destination: "Starworks Warehouse Wolverhampton Frederick St, Wolverhampton WV2, UK",
              travelMode: travelMode
            }, function(response, status) {
              // Route the directions and pass the response to a function to create
              // markers for each step.
              if (status === 'OK') {
                document.getElementById('warnings-panel').innerHTML =
                    '<b>' + response.routes[0].warnings + '</b>';
                directionsDisplay.setDirections(response);
                showSteps(response, markerArray, stepDisplay, map);
              } else {
                window.alert('Directions request failed due to ' + status);
              }
            });
          }

          function showSteps(directionResult, markerArray, stepDisplay, map) {
            // For each step, place a marker, and add the text to the marker's infowindow.
            // Also attach the marker to an array so we can keep track of it and remove it
            // when calculating new routes.
            var myRoute = directionResult.routes[0].legs[0];
            for (var i = 0; i < myRoute.steps.length; i++) {
              var marker = markerArray[i] = markerArray[i] || new google.maps.Marker;
              marker.setMap(map);
              marker.setPosition(myRoute.steps[i].start_location);
              attachInstructionText(
                  stepDisplay, marker, myRoute.steps[i].instructions, map);
            }
          }

          function attachInstructionText(stepDisplay, marker, text, map) {
            google.maps.event.addListener(marker, 'click', function() {
              // Open an info window when the marker is clicked on, containing the text
              // of the step.
              stepDisplay.setContent(text);
              stepDisplay.open(map, marker);
            });
          }
            
        </script>   
    </body>
</html>
