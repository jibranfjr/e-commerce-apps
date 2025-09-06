<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-v2.css') }}">
    <style>
        .summary-kategori { background-color: #526D82; border-radius: 10px }
        .summary-produk { background-color: #526D82; border-radius: 10px }
        .summary-transaksi { background-color: #526D82; border-radius: 10px }
        .summary-users { background-color: #526D82; border-radius: 10px}
        .no-decoration { text-decoration: none; }
    </style>
</head>
<body>

    <div class="container">
        @yield('content')
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
</body>
</html>
