<nav class="navbar navbar-expand-lg navbar-dark warna1 font-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" width="70" height="70" class="d-inline-block align-text-top">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item me-4">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="{{ url('/produk') }}">Products</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="{{ url('/tentang-kami') }}">About Us</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                    @auth
                <li class="nav-item me-4">
                        <a class="nav-link" href="{{ url('/user') }}">
                            User
                        </a>
                    @else
                        <a class="nav-link" href="{{ url('/login') }}">
                            Login
                        </a>
                    @endauth
                </li>

                @auth
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
