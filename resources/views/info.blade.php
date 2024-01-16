<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>title</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzdc-a-YxEme5SCRx5tzf-eCFt-GxE-_w"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzdc-a-YxEme5SCRx5tzf-eCFt-GxE-_w&callback=initMap"></script>
  <script>
    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 2,
        center: {
          lat: 40,
          lng: 0
        },
        styles: [{
            "featureType": "road",
            "elementType": "geometry",
            "stylers": [{
              "color": "#ffffff"
            }]
          },
          {
            "featureType": "road.highway",
            "elementType": "geometry",
            "stylers": [{
              "color": "#dadada"
            }]
          },

          {
            "featureType": "road.local",
            "elementType": "labels.text.fill",
            "stylers": [{
              "color": "#9e9e9e"
            }]
          },






          {
            "elementType": "labels.text.fill",
            "stylers": [{
              "color": "#757575"
            }]
          },
          {
            "featureType": "transit.station",
            "elementType": "labels.text.fill",
            "stylers": [{
              "color": "#bdbdbd"
            }]
          },
          {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [{
              "color": "#c9c9c9"
            }]
          },
          {
            "featureType": "water",
            "elementType": "labels.text.fill",
            "stylers": [{
              "color": "#9e9e9e"
            }]
          }
        ]
      });

      var visitors = JSON.parse(document.getElementById('visitors').getAttribute('data-visitors'));

      for (var i = 0; i < visitors.length; i++) {
        var marker = new google.maps.Marker({
          position: {
            lat: parseFloat(visitors[i].lat),
            lng: parseFloat(visitors[i].lon)
          },
          map: map,
          title: visitors[i].ip,
          icon: {
            url: 'https://maps.google.com/mapfiles/kml/paddle/blu-blank.png',
            scaledSize: new google.maps.Size(30, 30)
          }
        });
      }
    }
  </script>

  <style>
    body {
      background-color: #014242;
    }

    #map {
      margin-top: 20px;
      height: 400px;
      width: 100%;
      margin-bottom: 20px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-bottom: 20px;
      font-size: 14px;
    }

    th,
    td {
      text-align: left;
      padding: 8px;
      border: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
      font-weight: bold;
    }

    tr:hover {
      background-color: #f5f5f5;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-success">
    <a class="navbar-brand" href="{{ route('dashboard') }}" style="margin-left: 10px; color:whitesmoke;">WebTe2</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <div id="visitors" data-visitors="{{ json_encode($visitors) }}"></div>

  <div class="container mt-5">
    <div class="card">
      <div class="card-header d-flex bg-success justify-content-between">
        <h5 style="color:whitesmoke">Visitor Information</h5>
        <a role="button" class="btn btn-danger" href="{{route('dashboard')}}">Back</a>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div id="map"></div>
          </div>
          <div class="col-md-6">
            <h5 class="h5 text-center">Visitors</h5>
            <table>
              <thead>
                <tr>
                  <th>Flag</th>
                  <th>Country</th>
                  <th>NO. Visitors</th>
                </tr>
              </thead>
              <tbody>
                @foreach($visitorsByCountry as $visitor)
                <tr>
                  <td><img src="{{ $visitor->flag }}" alt="{{ $visitor->country_name }}" width="32" height="32"></td>
                  <td><a href="{{ route('visitorsByCity', ['country_code' => $visitor->country_code]) }}">{{ $visitor->country_name }}</a></td>
                  <td>{{ $visitor->total }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <hr>
            <h5 class="h5 text-center">Visitors Time Zone</h5>
            <table>
              <thead>
                <tr>
                  <th>Time Zone</th>
                  <th>Visits</th>
                </tr>
              </thead>
              <tbody>
                @foreach($visitsByTimeZone as $timeZone => $visits)
                <tr>
                  <td>{{ $timeZone }}</td>
                  <td>{{ $visits }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer d-flex justify-content-center align-items-end" style="margin-top: 5%;">
    <span class="text-muted">Copyright © 2023 Hikmatullah Samady.
    </span>
  </footer>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>