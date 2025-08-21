<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-v2.css') }}">
    <style>
        .summary-kategori { background-color: #14995e; border-radius: 10px }
        .summary-produk { background-color: #0a516b; border-radius: 10px }
        .summary-transaksi { background-color: #B82132; border-radius: 10px }
        .summary-users { background-color: #415E72; border-radius: 10px}
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
