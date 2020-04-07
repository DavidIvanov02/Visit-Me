<?php
include "map/map_php/init.php";
include 'dbconnect.php';
if(!isset($userRow['userName'])){
    header("Location: ".Base_url()."index.php");
}

$zabelejitelnosti = $db->getAllSights();
?>
    <!DOCTYPE html>
    <html>
    <head>
        <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
        <meta charset="UTF-8" />
        <title>Посети ме!</title>
        <link rel="shortcut icon" type="image/png" href="images/logo_title.png"/>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeRrOffHBETJb81Cf1XLx9gKf8FweGv7E">
        </script>
        <script>

            var mapObject, last_infowindow, interval_id;

            var json_string = '<?php echo str_replace(array('\n','\r'),'',json_encode($zabelejitelnosti)) ?>';
            var json = JSON.parse(json_string);


            function deg2rad(deg) {
                return deg * (Math.PI/180)
            }


            function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
                var R = 6371; // Radius of the earth in km
                var dLat = deg2rad(lat2-lat1);  // deg2rad below
                var dLon = deg2rad(lon2-lon1);
                var a =
                        Math.sin(dLat/2) * Math.sin(dLat/2) +
                        Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
                        Math.sin(dLon/2) * Math.sin(dLon/2)
                    ;
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
                var d = R * c; // Distance in km
                return d;
            }

            function locToLocDistance(loc1, loc2){
                return getDistanceFromLatLonInKm(loc1.lat(), loc1.lng(), loc2.lat(), loc2.lng());
            }

            function createMarker(location, text, title){
                var marker = new google.maps.Marker({
                    position: location,
                    map: mapObject,
                    title: title
                });

                var infowindow = new google.maps.InfoWindow({
                    content: text
                });

                marker.addListener('click', function() {
                    if(last_infowindow != null){
                        last_infowindow.close();
                    }
                    infowindow.open(mapObject, marker);
                    last_infowindow = infowindow;
                });

                return marker;
            }

            function writeAddressName(latLng) {
                var geocoder = new google.maps.Geocoder();
                var data = {
                    "location": latLng
                };

                geocoder.geocode(data, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        document.getElementById("address").innerHTML = results[0].formatted_address;
                    } else {
                        document.getElementById("error").innerHTML += "Не можем да намерим адреса." + "<br />";
                    }
                });
            }

            function geolocationSuccess(position) {
                var userLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

                writeAddressName(userLatLng);

                var myOptions = {
                    zoom : 16,
                    center : userLatLng,
                    mapTypeId : google.maps.MapTypeId.ROADMAP
                };

                // Чертае картата
                mapObject = new google.maps.Map(document.getElementById("map"), myOptions);

                //  Маркера се слага на местоположението
                createMarker(userLatLng, "Вие сте тук", "Вие сте тук");

                //Кръговете се начертават на API картата около user-a
                var circle = new google.maps.Circle({
                    center: userLatLng,
                    radius: 5000,
                    map: mapObject,
                    fillColor: '#db5a35',
                    fillOpacity: 0.4,
                    strokeColor: '#db5a35',
                    strokeOpacity: 5.0
                });

                mapObject.fitBounds(circle.getBounds());

                //ottuk nadolu proverqvame sichkite zabelejitelnosti dali sa dostatuchno blizki i ako nqkoi e dostatuchno blizak go pokazwame
                var i = 0;
                interval_id = setInterval(function(){
                    if(i >= json.length){
                        clearInterval(interval_id);
                    }else{
                        var currentZabPos = new google.maps.LatLng(json[i]['s_lat'], json[i]['s_lng']);
                        if(locToLocDistance(currentZabPos, userLatLng) <= 5){
                            var html = "<div>";
                            html += "<h3>"+json[i]['s_name']+"</h3>";
                            html += "<img style='width:200px;height:200px;' src='images/map_images/"+json[i]['s_filename']+"' title='"+json[i]['s_name']+"'/>";
                            html += "</div>";

                            createMarker(currentZabPos, html, json[i]['s_name']);
                        }
                    }
                    i++;
                }, 10);
            }

            function geolocationError(positionError) {
                document.getElementById("error").innerHTML += "Error: " + positionError.message + "<br />";
            }

            function geolocateUser() {
                if(navigator.geolocation){
                    var positionOptions = {
                        enableHighAccuracy: true,
                        timeout: 10 * 1000
                    };

                    navigator.geolocation.getCurrentPosition(geolocationSuccess, geolocationError, positionOptions);
                }else{
                    document.getElementById("error").innerHTML += "Твоят браузър не поддържа услугата за местоположение.";
                }
            }

            window.onload = geolocateUser;
            // $('#radius_in').on
        </script>
        <style type="text/css">
            #map{
                width: 90%;
                height: 500px;
                background: #999;
                margin-left: 5%;
            }
        </style>
    </head>
    <body id="top">
    <?php
    // include 'dbconnect.php';
    include('includes/header.php');
    ?>

    <center><h1>В близост до мен</h1></center>
    <!-- <input type="number" id="radius_in"> -->
    <div id="map"></div>

    <center><p><b>Адрес на потребителя*</b>: <span id="address"></span></p></center>
    <center><p><i>*Адресът може да не е напълно точен, защото геолокацията работи по IP и съответно получаваме местоположението на най-близкия рутер на интернет доставчика!</i></p></center>

    <p id="error"></p>
    </body>
    </html>
<?php
include 'includes/footer.php';
?>