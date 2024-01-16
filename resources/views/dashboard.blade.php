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
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <a class="navbar-brand" href="{{ route('dashboard') }}" style="margin-left: 10px; color:whitesmoke;">WebTe2</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <h2 class="h1 text-center mt-5 text-uppercase " style="color:whitesmoke;">Track weather and visitors</h2>
    <div class="container mt-5">
        <div id="search">
            <form action="/home" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" id="location" name="address" class="form-control" placeholder="Enter a city">
                            <div class="input-group-append">
                                <button class="btn btn-success" style="margin-left: 5px;" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <footer class="footer d-flex justify-content-center align-items-end" style="margin-top: 10%;">
            <span class="text-muted">Copyright © 2023 Hikmatullah Samady.
            </span>
        </footer>
    </div>

</body>

</html>