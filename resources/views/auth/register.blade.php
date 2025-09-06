{{-- resources/views/auth/register.blade.php --}}
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
    <div class="main d-flex flex-column justify-content-center align-items-center mt-5" style="height: 100vh">
        <div class="register-box p-4 shadow" style="width:500px; border-radius:10px">
            <div class="text-center mb-3">
                <img src="{{ asset('image/logo2.png') }}" alt="Logo" style="width: 100px;">
            </div>
            
            <form action="{{ route('register.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label><strong>REGISTER</strong></label>
                </div>
                <div>
                    <label for="username">Username *</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}">
                    @error('username')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="email">Email *</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="password">Password *</label>
                    <input type="password" class="form-control" name="password" id="password">
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <button class="btn btn-success form-control mt-3" type="submit">Register</button>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <a class="nav-link p-0 text-success" href="{{ route('login') }}">Login</a>
                    <a class="nav-link p-0 text-success" href="{{ url('/') }}">Masuk tanpa register</a>
                </div>
            </form>
        </div>

        {{-- Alert sukses + kirim ulang verifikasi --}}
        @if(session('success'))
            <div class="alert alert-success mt-3" style="width: 500px;">
                {{ session('success') }}
            </div>
        @endif

        @auth
            @if(!Auth::user()->hasVerifiedEmail())
                <div class="alert alert-warning mt-3 mb-5" style="width: 500px;">
                    Email Anda belum terverifikasi.  
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                            Kirim ulang verifikasi
                        </button>
                    </form>
                </div>
            @endif
        @endauth
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
</body>
</html>
