<!DOCTYPE html>
<html>

<head>
    <title>Visitors by City</title>
    <!-- Add Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<style>
    body {
        background-color: #014242
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <a class="navbar-brand" href="{{ route('dashboard') }}" style="margin-left: 10px; color:whitesmoke;">WebTe2</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header bg-success d-flex justify-content-between align-items-center">
                <h5 class="h3" style="color:whitesmoke">Visitors across the country</h5>
                <a role="button" class="btn btn-danger" href="{{ route('info') }}">Go Back</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>City</th>
                            <th>Visits</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visitorsByCity as $visitor)
                        <tr>
                            <td>{{ $visitor->city }}</td>
                            <td>{{ $visitor->total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer class="footer d-flex justify-content-center align-items-end" style="margin-top: 5%;">
        <span class="text-muted">Copyright © 2023 Hikmatullah Samady.
        </span>
    </footer>
    <!-- Add Bootstrap JS and jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>