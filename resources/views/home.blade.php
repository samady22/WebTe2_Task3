<?php
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzdc-a-YxEme5SCRx5tzf-eCFt-GxE-_w"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #014242;
        }

        .map-size {
            width: 100%;
            height: 400px;
        }

        .bg_color {
            background: rgb(255, 251, 251);
            background: linear-gradient(90deg, rgba(255, 251, 251, 1) 100%, rgba(107, 16, 36, 1) 100%);
        }
    </style>
    <script>
        let address = "{{ isset($location) ? $location : 'Bratislava' }}";

        function initMap() {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'address': address
            }, function(results, status) {
                if (status === 'OK') {
                    var lat = results[0].geometry.location.lat();
                    var lng = results[0].geometry.location.lng();
                    document.getElementById('lat').innerHTML = lat;
                    document.getElementById('lng').innerHTML = lng;
                    document.getElementById('coords').innerHTML = '(' + lat + ', ' + lng + ')';
                    var country = '';
                    console.log(results)
                    for (var i = 0; i < results[0].address_components.length; i++) {
                        var component = results[0].address_components[i];
                        if (component.types.includes('country')) {
                            country = component.long_name;
                            break;
                        }
                    }
                    document.getElementById('country').innerHTML = country;
                    var countryName = country;
                    var apiUrl = 'https://restcountries.com/v3.1/name/' + countryName + '?fields=capital';
                    fetch(apiUrl)
                        .then(response => response.json())
                        .then(data => {
                            var capitalCity = data[0].capital;
                            document.getElementById('capital').innerHTML = capitalCity;
                        })
                        .catch(error => {
                            console.error('Error fetching data from API:', error);
                        });
                    var apiKey = '23e3da1f65d97ac00521118d2eea04a2';
                    var apiUrl = 'https://api.openweathermap.org/data/2.5/weather?lat=' + lat + '&lon=' + lng + '&units=metric&appid=' + apiKey;

                    $.getJSON(apiUrl, function(data) {
                        var currentDate = new Date().toLocaleDateString();
                        var currentDay = new Date().toLocaleDateString('en-US', {
                            weekday: 'long'
                        }); // get current day
                        var description = data.weather[0].description;
                        var temp = data.main.temp;
                        var temp_min = data.main.temp_min;
                        var temp_max = data.main.temp_max;
                        var humidity = data.main.humidity;
                        var windSpeed = data.wind.speed;
                        // var windDir = getWindDirection(data.wind.deg);
                        // var icon = 'https://openweathermap.org/img/w/' + data.weather[0].icon + '.png';
                        var icon = "{{ asset('/weather-icon.png') }}"



                        var weatherHtml = '<div >' +
                            '<div class="card  style=" box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);">' +
                            '<div class="card-header bg-success ">' +
                            '<h5 class="card-title font-weight-bold  mb-0" style="color :whitesmoke;">Weather Information</h5>' +
                            '</div>' +
                            '<div class="card-body">' +
                            '<img class="card-img-bottom" style="width: 100px; height: 100px; display: block; margin: 0 auto;"  src="' + icon + '" alt="' + description + '">' +
                            '<h6 class="card-title text-center mt-2">' + currentDay + ', ' + currentDate + '</h6>' +
                            '<hr>' +
                            '<div class="d-flex justify-content-between align-items-center mb-3">' +
                            '<h6 class="mb-0 card-subtitle">Temperature</h6>' +
                            '<p class="mb-0 card-text">' + temp + '°C</p>' +
                            '</div>' +
                            '<div class="d-flex justify-content-between align-items-center mb-3">' +
                            '<h6 class="mb-0 font-weight-bold">Description</h6>' +
                            '<p class="mb-0">' + description + '</p>' +
                            '</div>' +
                            '<div class="d-flex justify-content-between align-items-center mb-3">' +
                            '<h6 class="mb-0 font-weight-bold">Low</h6>' +
                            '<p class="mb-0">' + temp_min + ' °C</p>' +
                            '</div>' +
                            '<div class="d-flex justify-content-between align-items-center mb-3">' +
                            '<h6 class="mb-0 font-weight-bold">High</h6>' +
                            '<p class="mb-0">' + temp_max + ' °C</p>' +
                            '</div>' +
                            '<div class="d-flex justify-content-between align-items-center mb-3">' +
                            '<h6 class="mb-0 font-weight-bold">Humidity</h6>' +
                            '<p class="mb-0">' + humidity + '% <i class="fas fa-tint"></i></p>' +
                            '</div>' +
                            '<div class="d-flex justify-content-between align-items-center">' +
                            '<h6 class="mb-0 font-weight-bold">Wind Speed</h6>' +
                            '<p class="mb-0">' + windSpeed + ' m/s <i class="fas fa-wind"></i></p>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';

                        document.getElementById('weather').innerHTML = weatherHtml;
                    });

                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }

        initMap();
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <a class="navbar-brand" href="{{ route('dashboard') }}" style="margin-left: 10px; color:whitesmoke;">WebTe2</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <h2 class="h2 text-center text-uppercase" style="color:whitesmoke;">Track weather and visitors</h2>
    <div class="container">
        <div class="card ">
            <div class="card-header bg-success d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-2" style="color :whitesmoke;"><b>Country Information</b></h5>
                <div>
                    <a href="javascript:history.go(-1)" class="btn btn-danger mb-3 mr-2">Back to search</a>
                    <a role="button" class="btn btn-primary mb-3 ml-auto" href="{{ route('info') }}">Visitors</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h6 class="card-subtitle mb-2"><b>Country:</b></h6>
                        <p id="country" class="card-text"></p>
                    </div>
                    <div class="col-4">
                        <h6 class="card-subtitle mb-2"><b>Capital City:</b></h6>
                        <p id="capital" class="card-text"></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <h6 class="card-subtitle mb-2"><b>Latitude:</b></h6>
                        <p id="lat" class="card-text"></p>
                    </div>
                    <div class="col-4">
                        <h6 class="card-subtitle mb-2"><b>Longitude:</b></h6>
                        <p id="lng" class="card-text"></p>
                    </div>
                    <div class="col-4">
                        <h6 class="card-subtitle mb-2"><b>Coordinates:</b></h6>
                        <p id="coords" class="card-text"></p>
                    </div>
                </div>
            </div>
        </div>

        <div id="weather" class="mt-2"></div>
    </div>
    <footer class="footer d-flex justify-content-center align-items-end" style="margin-top: 5%;">
        <span class="text-muted">Copyright © 2023 Hikmatullah Samady.
        </span>
    </footer>
    </div>
</body>

</html>