{{-- resources/views/auth/login.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Toko Permata Puri Bali</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-v2.css') }}">
</head>
<body>

<div class="main d-flex flex-column justify-content-center align-items-center" style="height: 100vh">
    <div class="login-box p-4 shadow" style="width:500px; border-radius:10px">
        <div class="text-center mb-3">
            <img src="{{ asset('image/logo2.png') }}" alt="Logo" style="width: 100px;">
        </div>

        <form action="{{ route('login.custom') }}" method="post">
            @csrf
            <div class="mb-3">
                    <label><strong>LOGIN</strong></label>
                </div>
            <div class="mb-3">
                <label for="email">Email *</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="mb-3">
                <label for="password">Password *</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div>
                <button class="btn btn-success form-control mt-3" type="submit">Login</button>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <a class="nav-link p-0 text-success" href="{{ url('/register') }}">Register</a>
                <a class="nav-link p-0 text-success" href="{{ url('/') }}">Masuk tanpa login</a>
            </div>

            @if(session('error'))
                <div class="alert alert-warning mt-3">
                    {{ session('error') }}
                </div>
            @endif
        </form>
    </div>
</div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
</body>
</html>