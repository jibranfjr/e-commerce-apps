<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Toko Permata Puri Bali</title>
    <!-- Favicon default -->
<link rel="icon" href="{{ asset('image/logo.png') }}" type="image/png">

<!-- Untuk browser yang minta .ico -->
<link rel="shortcut icon" href="{{ asset('image/logo.ico') }}" type="image/x-icon">

<!-- Untuk Apple/Android -->
<link rel="apple-touch-icon" href="{{ asset('image/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-v2.css') }}">
</head>
<body>

    {{-- Tempat isi konten --}}
    <div>
        @yield('content')
    </div>

    @include('partials.footer')

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
</body>
</html>